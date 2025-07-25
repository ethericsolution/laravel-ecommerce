<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Enums\TaxType;
use App\Models\Country;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\State;
use App\Models\Tax;
use App\Models\User;
use App\Settings\CompanySetting;
use App\Settings\GeneralSetting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generalSetting = new GeneralSetting();

        $orders = Order::latest()
            ->with(['user'])
            ->search(request('query'))
            ->paginate()
            ->withQueryString();

        return view('admin.orders.index', compact('orders', 'generalSetting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $order = new Order();

        $users = User::all()->pluck('name', 'id');

        $products = Product::all(['id', 'name', 'regular_price']);

        $countries = Country::all('id', 'name')
            ->pluck('name', 'id');

        $taxes = Tax::all(['id', 'name', 'type', 'rate']);

        return view('admin.orders.form', compact('order', 'users', 'products', 'countries', 'taxes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_number'   => ['required', 'string', 'max:255', 'unique:' . Order::class],
            'order_date'     => ['required'],
            'status'         => ['nullable', 'string'],
            'payment_status' => ['nullable', 'string', 'default:pending'],
            'payment_method' => ['nullable', 'string', 'default:cash'],
            'user_id'        => ['required', 'exists:users,id'],

            'address.name'           => ['required', 'string', 'max:50'],
            'address.country_id'     => ['required'],
            'address.contact_name'   => ['required', 'string', 'max:60'],
            'address.phone'          => ['required'],
            'address.address_line_1' => ['required', 'string', 'max:50'],
            'address.address_line_2' => ['nullable', 'string', 'max:50'],
            'address.city'           => ['required', 'string', 'max:50'],
            'address.zip_code'       => ['required', 'string', 'max:10'],
            'address.state_id'       => ['required'],

            // 'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity'   => ['required', 'integer', 'min:1'],
            'items.*.price'      => ['required', 'numeric', 'min:0'],
            'items.*.tax_rate'   => ['required', 'numeric', 'min:0', 'max:100'],
            'items.*.total'      => ['required', 'numeric', 'min:0'],

            'sub_total'       => ['required', 'numeric', 'min:0'],
            'delivery_charge' => ['required', 'numeric', 'min:0'],
            'grand_total'     => ['required', 'numeric', 'min:0'],
            'notes'           => ['nullable']
        ]);

        $order = Order::create($validated);

        $order->address()->create($validated['address']);

        $order->items()->createMany($validated['items']);

        // Apply taxes to order items
        $customerState = State::find($validated['address']['state_id']);
        $order->items->each(function ($item) use ($customerState) {
            applyTaxesToObject($item, $item->total, $customerState);
        });

        // Recalculate grand total with taxes
        $order->grand_total = $order->sub_total + $order->delivery_charge + $order->total_tax_amount;
        $order->save();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', __('Order created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $generalSetting = new GeneralSetting();

        $payment = new Payment();

        return view('admin.orders.show', compact('order', 'generalSetting', 'payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $users = User::all()->pluck('name', 'id');

        $products = Product::all(['id', 'name', 'regular_price']);

        $countries = Country::all('id', 'name')
            ->pluck('name', 'id');

        $taxes = Tax::all(['id', 'name', 'type', 'rate']);
        $existingTaxes = $order->tax_breakdown ?? [];

        return view('admin.orders.form', compact('order', 'users', 'products', 'countries', 'taxes', 'existingTaxes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'order_number' => ['required', 'string', 'max:255', 'unique:' . Order::class . ',order_number,' . $order->id],
            'order_date'   => ['required'],
            'status'       => ['nullable', 'string'],
            'user_id'      => ['required', 'exists:users,id'],

            'address.name'           => ['required', 'string', 'max:50'],
            'address.country_id'     => ['required'],
            'address.contact_name'   => ['required', 'string', 'max:60'],
            'address.phone'          => ['required'],
            'address.address_line_1' => ['required', 'string', 'max:50'],
            'address.address_line_2' => ['nullable', 'string', 'max:50'],
            'address.city'           => ['required', 'string', 'max:50'],
            'address.zip_code'       => ['required', 'string', 'max:10'],
            'address.state_id'       => ['required'],

            // 'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity'   => ['required', 'integer', 'min:1'],
            'items.*.price'      => ['required', 'numeric', 'min:0'],
            'items.*.tax_rate'   => ['required', 'numeric', 'min:0', 'max:100'],
            'items.*.total'      => ['required', 'numeric', 'min:0'],

            'sub_total'          => ['required', 'numeric', 'min:0'],
            'delivery_charge'    => ['required', 'numeric', 'min:0'],
            'grand_total'        => ['required', 'numeric', 'min:0'],
            'notes'              => ['nullable']
        ]);

        $order->fill($validated);
        $order->save();

        $order->address()->update($validated['address']);

        $order->items()->delete();
        $order->items()->createMany($validated['items']);

        // Apply taxes to order items
        $customerState = State::find($validated['address']['state_id']);
        $order->items->each(function ($item) use ($customerState) {
            if ($item->tax_rate > 0) {
                applyTaxesToObject($item, $item->quantity * $item->price, $customerState);
            }
        });

        // Apply taxes to order items
        $customerState = State::find($validated['address']['state_id']);
        $order->items->each(function ($item) use ($customerState) {
            applyTaxesToObject($item, $item->total, $customerState);
        });

        // Recalculate grand total with taxes
        $order->grand_total = $order->sub_total + $order->delivery_charge + $order->total_tax_amount;
        $order->save();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', __('Order updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', __('Order deleted successfully.'));
    }


    /**
     * Get taxes for given state
     */
    public function getTaxes(Request $request)
    {
        $customerStateId = $request->input('state_id');
        $items = $request->input('items', []);

        $sellerStateId = app_state()?->id;
        $isInterState = $sellerStateId != $customerStateId;

        $taxBreakdown = [];
        $totalTax = 0;

        foreach ($items as $item) {
            if (isset($item['tax_rate']) && $item['tax_rate'] > 0) {
                $baseAmount = $item['quantity'] * $item['price'];
                $taxRate = $item['tax_rate'];

                if ($baseAmount <= 0 || $taxRate <= 0) {
                    continue;
                }

                if ($isInterState) {
                    $taxAmount = $baseAmount * ($taxRate / 100);
                    $key = 'IGST_' . $taxRate;

                    if (isset($taxBreakdown[$key])) {
                        $taxBreakdown[$key]['amount'] += $taxAmount;
                    } else {
                        $taxBreakdown[$key] = [
                            'type' => 'IGST',
                            'rate' => $taxRate,
                            'amount' => $taxAmount
                        ];
                    }
                    $totalTax += $taxAmount;
                } else {
                    $halfRate = $taxRate / 2;
                    $halfAmount = $baseAmount * ($halfRate / 100);

                    $cgstKey = 'CGST_' . $halfRate;
                    $sgstKey = 'SGST_' . $halfRate;

                    if (isset($taxBreakdown[$cgstKey])) {
                        $taxBreakdown[$cgstKey]['amount'] += $halfAmount;
                    } else {
                        $taxBreakdown[$cgstKey] = [
                            'type' => 'CGST',
                            'rate' => $halfRate,
                            'amount' => $halfAmount
                        ];
                    }

                    if (isset($taxBreakdown[$sgstKey])) {
                        $taxBreakdown[$sgstKey]['amount'] += $halfAmount;
                    } else {
                        $taxBreakdown[$sgstKey] = [
                            'type' => 'SGST',
                            'rate' => $halfRate,
                            'amount' => $halfAmount
                        ];
                    }

                    $totalTax += ($halfAmount * 2);
                }
            }
        }

        return response()->json([
            'taxes' => array_values($taxBreakdown),
            'total_tax' => $totalTax
        ]);
    }

    /**
     * generate PDF
     */
    public function pdf(Request $request, Order $order)
    {
        $companySetting = new CompanySetting();

        $country = Country::find($companySetting->country)?->name;

        $state = State::find($companySetting->state)?->name;

        $data = [
            'order'          => $order,
            'country'        => $country,
            'state'          => $state
        ];

        // return view('admin.orders.pdf', $data);

        $pdf = Pdf::loadView('admin.orders.pdf', $data);

        return $pdf->stream("$order->order_number.pdf");
    }
}
