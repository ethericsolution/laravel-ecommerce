<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreRequest as OrderStoreRequest;
use App\Http\Requests\Order\UpdateRequest as OrderUpdateRequest;
use App\Enums\PaymentStatus;
use App\Enums\PaymentType;
use App\Enums\TaxType;
use App\Models\Address;
use App\Models\Order;
use App\Models\Payment;
use App\Models\State;
use App\Models\Tax;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;
use App\Notifications\OrderPlaced;
use App\Services\PaypalService;
use App\Services\PhonePeService;
use App\Services\RazorpayService;
use App\Settings\GeneralSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = cart();
        if ($cart->items->isEmpty()) {
            return redirect()->route('products.index')
                ->with('error', 'Your cart is empty.');
        }

        return view('orders.checkout');
    }

    public function getTaxes()
    {
        $addressId = request('address_id');

        $address = Address::find($addressId);

        $taxRate = config('usa_tax')[$address?->state?->iso2] ?? 0.0;

        // return if no tax rate is found
        if (!$taxRate) {
            return response()->json([
                'taxes' => [],
                'total_tax' => 0,
            ]);
        }

        $tax = Tax::where('rate', $taxRate)
            ->where('type', TaxType::VAT)
            ->first();

        if (!$tax) {
            $tax = Tax::create(
                [
                    'name' => "VAT " . $taxRate . "%",
                    'type' => TaxType::VAT,
                    'rate' => $taxRate,
                ]
            );
        }

        $taxSummary = [];


        foreach (cart()->items as $item) {
            $taxAmount = round(($item->total * $tax->rate) / 100, 2);

            if (!isset($taxSummary[$tax->id])) {
                $taxSummary[$tax->id] = [
                    'name' => $tax->name,
                    'rate' => $tax->rate,
                    'amount' => 0,
                ];
            }

            $taxSummary[$tax->id]['amount'] += $taxAmount;
            $taxSummary[$tax->id]['amount_display'] = get_currency_symbol() . " " . number_format($taxAmount, 2);
        }

        $taxes = array_values($taxSummary);
        $totalTax = collect($taxes)->sum('amount');

        return response()->json([
            'taxes' => $taxes,
            'total_tax' => $totalTax,
        ]);
    }

    public function store(OrderStoreRequest $request): RedirectResponse
    {

        $validated = $request->validated();

        $cart = cart();

        $user_id = Auth::check() ? auth()->id() : null;

        $address = Auth::check() ? auth()->user()->addresses()->find($validated['address_id']) : null;
        // User Create or find by email from address
        if (!Auth::check()) {
            $user = User::where('email', $validated['address']['email'])->first();
            if (!$user) {
                $user = User::create([
                    'first_name' => $validated['address']['contact_name'],
                    'email' => $validated['address']['email'],
                    'phone' => $validated['address']['phone'],
                    'password' => bcrypt(str()->random(10)),
                ]);
            }
            $address = $user->addresses()->create($validated['address']);

            $user_id = $user->id;
        }


        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'order_date' => now()->format('Y-m-d'),
            'user_id' => $user_id,
            'payment_method' => $validated['payment_method'],
            'sub_total' => $cart->total,
            'delivery_charge' => getDeliveryCharge(),
            'grand_total' => $cart->total + getDeliveryCharge(),
            'notes' => $validated['notes'],
            'ip_address' => $request->ip(),
        ]);

        $cartItems = $cart->items->map(function ($item) {
            return [
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->price,
                'total'      => $item->total,
                'tax_rate'   =>  18,
            ];
        });

        $order->items()->createMany($cartItems->toArray());

        $order->address()->create($address->replicate()->makeHidden(['id', 'addressable_id', 'addressable_type', 'is_default', 'created_at', 'updated_at'])->toArray());

        /**
         * Apply Taxes to Order Items
         */
        $order->items->each(function ($item) use ($address) {
            applyTaxesToObject($item, $item->total, $address->state);
        });

        $order->grand_total = $cart->total + getDeliveryCharge() + $order->total_tax_amount;
        $order->save();


        /**
         * Delete Cart and Cart Items
         */
        $cart->items()->delete();
        $cart->delete();

        /**
         * Notify Admins and User
         */
        $admin_emails = collect(explode(',', app(GeneralSetting::class)->admin_emails))
            ->map(fn($admin_emails) => trim($admin_emails))
            ->filter(fn($admin_emails) => filter_var($admin_emails, FILTER_VALIDATE_EMAIL));


        foreach ($admin_emails as $admin_email) {
            Notification::route('mail', $admin_email)
                ->notify(new OrderCreatedNotification($order));
        }

        /**
         * Notify User
         */
        $order->user->notify(new OrderPlaced($order));

        if ($order->payment_method == 'cod') {
            return redirect()->route('account.orders.thankYou', generateOrderAccessToken($order->order_number))
                ->with('success', 'Order placed successfully. Please pay cash on delivery.');
        }

        return redirect()->route('account.orders.pay', $order)
            ->with('success', 'Order placed successfully.');
    }

    public function pay(Order $order, PhonePeService $phonePe, PaypalService $paypal, RazorpayService $razorpay)
    {

        if ($order->payment_method == 'Paypal')
            $redirectURL = $paypal->initiatePayment([
                'order_id' => $order->order_number,
                'amount' => $order->grand_total,
                'currency' => app_country()->currency,
                // 'currency' => 'USD',
                'redirect_url' => route('account.orders.verifyPayment', $order),
            ]);

        if ($order->payment_method == 'Phonepe')
            $redirectURL = $phonePe->initiatePayment([
                'order_id' => $order->order_number,
                'amount' => $order->grand_total * 100, // ₹100 in paise
                'redirect_url' => route('account.orders.verifyPayment', $order),
            ]);

        if ($order->payment_method == 'Razorpay')
            $redirectURL = $razorpay->initiatePayment([
                'order_id' => $order->order_number,
                'amount' => $order->grand_total * 100,
                'currency' => app_country()->currency,
                'redirect_url' => route('account.orders.verifyPayment', $order),
            ]);

        return redirect($redirectURL);
    }

    public function verifyPayment(Request $request, Order $order, PhonePeService $phonePe, PaypalService $paypal, RazorpayService $razorpay)
    {
        try {
            if ($order->payment_method == 'Paypal') {
                $response = $paypal->captureOrder($request->token);

                if ($response && $response['status'] == 'COMPLETED') {
                    $order->payments()->create([
                        'payment_number' => Payment::generatePaymentNumber(),
                        'reference' =>  $response['id'],
                        'amount' =>  $order->grand_total,
                        'method' =>  'Paypal',
                    ]);

                    $order->increment('paid_amount', $order->grand_total);
                    $order->payment_status = PaymentStatus::PAID;

                    $order->save();
                }
            }

            if ($order->payment_method == 'Phonepe') {
                $response = $phonePe->checkStatus($order->order_number);

                if ($response && $response['state'] == 'COMPLETED') {
                    $order->payments()->create([
                        'payment_number' => Payment::generatePaymentNumber(),
                        'reference' =>  $response['orderId'],
                        'amount' =>  $order->grand_total,
                        'method' =>  'Phonepe',
                    ]);

                    $order->increment('paid_amount', $order->grand_total);
                    $order->payment_status = PaymentStatus::PAID;

                    $order->save();
                }
            }

            if ($order->payment_method == 'Razorpay') {

                $response = $razorpay->checkStatus($request->razorpay_payment_id);

                if ($response && $response['status'] == 'captured') {
                    $order->payments()->create([
                        'payment_number' => Payment::generatePaymentNumber(),
                        'reference' =>  $request->razorpay_payment_id,
                        'amount' =>  $order->grand_total,
                        'method' =>  'Razorpay',
                    ]);

                    $order->increment('paid_amount', $order->grand_total);
                    $order->payment_status = PaymentStatus::PAID;

                    $order->save();
                }
            }
            if ($order->payment_status == PaymentStatus::PAID) {
                return redirect()->route('account.orders.thankYou', generateOrderAccessToken($order->order_number))
                    ->with('success', 'Payment successful. Thank you for your order!');
            }
        } catch (\Exception $e) {
            return redirect()->route('account.orders.thankYou', generateOrderAccessToken($order->order_number))
                ->with('error', 'Payment failed.');
        }
    }

    public function thankYou($token): View
    {
        $orderNumber = Cache::get("order_link_token:{$token}");

        if (!$orderNumber) {
            abort(403, 'Invalid or expired link');
        }

        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        return view('orders.thank_you', compact('order'));
    }

    public function index(): View
    {
        $orders = auth()->user()->orders()->latest()->paginate(10)
            ->withQueryString();

        $rightSideView = 'orders.index';

        $pageTitle = 'Your Orders';

        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Your Account'],
                ['url' => '#', 'text' => $pageTitle]
            ],
            'title' => $pageTitle,
        ];

        return view('account.index', compact('rightSideView', 'pageTitle', 'breadcrumbs', 'orders'));
    }

    public function show(Order $order): View
    {
        $userOrder = auth()->user()->orders()->where('id', $order->id)->first();

        if (is_null($userOrder)) {
            abort(404);
        }

        $rightSideView = 'orders.show';

        $pageTitle = 'Order Detail';

        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Your Account'],
                ['url' => '#', 'text' => $pageTitle]
            ],
            'title' => $pageTitle,
        ];

        return view('account.index', compact('rightSideView', 'pageTitle', 'breadcrumbs', 'order'));
    }
}
