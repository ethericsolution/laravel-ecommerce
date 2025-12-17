<x-layouts.admin>

    <div class="max-w-7xl mx-auto space-y-6">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.orders.index'),
                    'text' => 'Orders',
                ],
                [
                    'text' => $order->id ? 'Show' : '',
                ],
            ];

            $title = 'Order # : ' . $order->order_number;

        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.orders.index')" />

        <div class="lg:grid lg:grid-cols-3 content-center gap-6">
            <div class="lg:col-span-2">
                <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">

                    <div class="p-6 border-b border-gray-200 flex justify-between items-center w-full">
                        <h3 class="text-base-content text-lg font-medium">Order Detail</h3>

                        <a target="_blank" href="{{ route('admin.orders.pdf', $order) }}"
                            class="btn-primary gap-2 flex item-center">
                            <i data-lucide="file-text" class="size-4"></i>
                            <span>PDF</span>
                        </a>
                    </div>
                    <div class="p-6">
                        <div class="-mx-6 -my-6 overflow-x-auto">
                            <div class="inline-block min-w-full align-middle">
                                <table class="record-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Products</th>
                                            <th scope="col" class="!text-right">Price</th>
                                            <th scope="col" class="!text-center">Qty</th>
                                            <th scope="col" class="!text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->items as $item)
                                            <tr>
                                                <td class="!font-semibold">{{ $item->product->name }}</td>
                                                <td class="text-right">@money($item->price)</td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-right">@money($item->total)</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th scope="row" colspan="3" class="!text-right !font-semibold">
                                                Subtotal</th>
                                            <td class="text-right">@money($order->sub_total)</td>
                                        </tr>
                                        @foreach ($order->tax_breakdown as $tax)
                                            <tr>
                                                <th scope="row" colspan="3" class="!text-right !font-semibold">
                                                    {{ $tax['name'] }}</th>
                                                <td class="text-right">@money($tax['total_amount'])</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th scope="row" colspan="3" class="!text-right !font-semibold">
                                                Delivery Charge</th>
                                            <td class="text-right">@money($order->delivery_charge)</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="3" class="!text-right !font-semibold">
                                                Grandtotal</th>
                                            <td class="text-right">@money($order->grand_total)</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-------- payment table ----------->

                @if ($order->payments->count() > 0)
                    <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-base-content text-lg font-medium">Payment Log</h3>
                        </div>
                        <div class="p-6">
                            <div class="-mx-6 -my-6 overflow-x-auto">
                                <div class="inline-block min-w-full align-middle">
                                    <table class="record-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Payment #</th>
                                                <th scope="col">Reference</th>
                                                <th scope="col">Method</th>
                                                <th scope="col" class="!text-right">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->payments as $paymentObj)
                                                <tr>
                                                    <td class="!font-semibold">{{ $paymentObj->payment_number }}</td>
                                                    <td>{{ $paymentObj->reference }}</td>
                                                    <td>{{ $paymentObj->method }}</td>
                                                    <td class="text-right">@money($paymentObj->amount)</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-------- payment form ----------->

                @includeUnless(
                    $order->payment_status === \App\Enums\PaymentStatus::PAID,
                    'admin.orders.payment_form')

            </div>

            <div>
                <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-base-content text-lg font-medium">Customer Detail</h3>
                    </div>

                    <div class="p-6">
                        <h2 class="sr-only">Summary</h2>
                        <dl class="flex flex-wrap space-y-4">
                            <div class="flex w-full flex-none gap-x-4">
                                <dt class="flex-none">
                                    <span class="sr-only">Client</span>
                                    <i data-lucide="circle-user-round" class="size-6 text-gray-400"></i>
                                </dt>
                                <dd class="text-base/6 font-medium text-gray-900">{{ $order->user->name }}</dd>
                            </div>

                            <div class="flex w-full flex-none gap-x-4">
                                <dt class="flex-none">
                                    <span class="sr-only">Total Orders</span>
                                    <i data-lucide="shopping-cart" class="size-6 text-gray-400"></i>
                                </dt>
                                <dd class="text-base/6 font-medium text-gray-900">
                                    {{ $order->user->orders->count() }} Orders</dd>
                            </div>
                            <div class="flex w-full flex-none gap-x-4">
                                <dt class="flex-none">
                                    <span class="sr-only">Due date</span>
                                    <i data-lucide="calendar-days" class="size-6 text-gray-400"></i>
                                </dt>
                                <dd class="text-sm/6 text-gray-900">

                                    <time
                                        datetime="2023-01-31">{{ $order->order_date->format(setting('general.date_format')) }}</time>
                                </dd>
                            </div>
                        </dl>

                        <div class="mt-5">
                            <h3 class="text-lg/6 font-semibold text-gray-800 mb-4">Contact Info</h3>
                            <p class="text-base/6 text-gray-700">Email : {{ $order->user->email }}</p>
                            <p class="text-base/6 text-gray-700">Mobile : {{ $order->user->phone }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg/6 font-semibold text-gray-800 mb-4">Shipping address</h3>

                        <p class="text-base/6 text-gray-700">
                            {{ $order->address?->contact_name }}<br>
                            {{ $order->address?->address_line_1 }} , {{ $order->address?->address_line_2 }}
                            {{ $order->address?->city }}
                            <br>{{ $order->address?->state?->name }},
                            {{ $order->address?->country?->iso2 }} -
                            {{ $order->address?->zip_code }}<br>
                            Phone Number : {{ $order->address?->phone }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-layouts.admin>
