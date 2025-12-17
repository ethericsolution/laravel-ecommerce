<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Your Account'],
                ['url' => route('account.orders.index'), 'text' => 'Orders'],
                ['url' => '#', 'text' => 'Thank you'],
            ],
            'title' => 'Thank you',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <div class="bg-base-100 py-6 sm:py-10 lg:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 gap-6">
                <div class="lg:col-span-8">
                    <div class="card card-border shadow-none">
                        <div class="card-header">
                            <h3 class="text-base-content text-lg font-medium">Order Detail</h3>
                        </div>
                        <div class="card-body border-t border-base-content/20 p-0">
                            <div class="overflow-x-auto">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product</th>
                                            <th scope="col" class="text-right">Price</th>
                                            <th scope="col" class="text-center">Quantity</th>
                                            <th scope="col" class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->items as $item)
                                            <tr>
                                                <td>
                                                    @php
                                                        $product = $item->product;
                                                    @endphp

                                                    <div class="flex items-start space-y-4 gap-3">
                                                        <div class="size-14 shrink-0">
                                                            <a href="{{ route('products.show', $product) }}">
                                                                <img class="rounded-box bg-contain w-full shrink-0 h-full"
                                                                    src="{{ $product->thumbnailURL('thumb') }}"
                                                                    alt="{{ $product->name }}" loading="lazy" />
                                                            </a>
                                                        </div>
                                                        <div class="inline-block w-full">
                                                            <a class="text-base-content font-medium line-clamp-1"
                                                                href="{{ route('products.show', $product) }}">{{ $product->name }}</a>

                                                            <div class="mt-2 flex justify-between">
                                                                <p
                                                                    class="text-base-content font-medium line-clamp-1/tight">
                                                                    Category:
                                                                    <a href="{{ route('products.byCategory', $product?->category) }}"
                                                                        <strong
                                                                        class="font-semibold">{{ $product?->category?->name }}</strong>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td class="text-right">@money($item->price)</td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-right">@money($item->total)</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4 mt-6 lg:mt-0 space-y-6">
                    <div class="card card-border shadow-none">
                        <div class="card-header">
                            <h3 class="text-base-content text-lg font-medium">Shipping Address</h3>
                        </div>
                        <div class="card-body">
                            <p>
                                {{ $order->address?->contact_name }}<br>
                                {{ $order->address?->address_line_1 }} , {{ $order->address?->address_line_2 }}
                                {{ $order->address?->city }}
                                <br>{{ $order->address?->state?->iso2 }},
                                {{ $order->address?->country?->iso2 }} -
                                {{ $order->address?->zip_code }}<br>
                                Phone # : {{ $order->address?->phone }}
                            </p>
                        </div>
                    </div>

                    <div class="card card-border shadow-none">
                        <div class="card-header">
                            <h3 class="text-base-content text-lg font-medium">Order Summary</h3>
                        </div>
                        <div class="card-body">
                            <dl class="space-y-6">
                                <div class="flex items-center justify-between">
                                    <dt class="text-base/6 text-gray-600">Sub Total</dt>
                                    <dd class="text-base/6 font-medium text-gray-900">@money($order->sub_total)</dd>
                                </div>
                                @foreach ($order->tax_breakdown as $tax)
                                    <div class="flex items-center justify-between">
                                        <dt class="text-base/6 text-gray-600">{{ $tax['name'] }}</dt>
                                        <dd class="text-base/6 font-medium text-gray-900">@money($tax['total_amount'])</dd>
                                    </div>
                                @endforeach
                                <div class="flex items-center justify-between">
                                    <dt class="text-base/6 text-gray-600">Delivery Charge</dt>
                                    <dd class="text-base/6 font-bold text-gray-900">@money($order->delivery_charge)</dd>
                                </div>
                                <div class="flex items-center justify-between">
                                    <dt class="text-base/6 text-gray-600">Grand Total</dt>
                                    <dd class="text-base/6 font-bold text-gray-900">@money($order->grand_total)</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.front>
