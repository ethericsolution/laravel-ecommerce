<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Your Account'],
                ['url' => '#', 'text' => 'Your Cart'],
            ],
            'title' => 'Your Cart',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <div class="bg-base-100 py-6 sm:py-10 lg:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="my-10 lg:grid lg:grid-cols-12 gap-6">
                @if ($cart->items->isEmpty())
                    <div class="lg:col-span-12">
                        <div class="overflow-hidden rounded-xl bg-white text-center p-10 flex justify-center">
                            <img class="w-1/4 h-auto"
                                src="https://assets.1mg.com/pwa-app/production/dweb/2.0.1/static/images/illustrations/empty-cart.svg"
                                alt="">
                        </div>
                        <div class="text-center flex justify-center">
                            <a href="{{ route('home') }}" type="submit" class="btn-primary !px-6">Continue
                                Shopping</a>
                        </div>
                    </div>
                @else
                    <div class="lg:col-span-8">
                        <form action="{{ route('account.updateCart') }}" method="POST">
                            @csrf
                            <div class="overflow-hidden rounded-xl bg-white shadow-xs border border-gray-200">
                                <div class="p-6 border-b border-gray-200">
                                    <h3 class="text-base-content text-lg font-medium">Your Cart</h3>
                                </div>
                                <div class="p-6">
                                    <div class="-mx-6 -my-6 overflow-x-auto">
                                        <div class="inline-block min-w-full align-middle">
                                            <table class="record-table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col">Product</th>
                                                        <th scope="col" class="!text-right">Price</th>
                                                        <th scope="col" class="!text-center">Quantity</th>
                                                        <th scope="col" class="!text-right">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse (cart()->items as $product)
                                                        <tr>
                                                            <td width="1%">
                                                                <a href="{{ route('account.removeFromCart', $product->product_id) }}"
                                                                    class="!text-red-600 hover:text-red-900">
                                                                    <i data-lucide="trash-2" class="size-4"></i>
                                                                </a>
                                                            </td>
                                                            <td width="50%">
                                                                <div class="flex items-center">
                                                                    <div class="shrink-0">
                                                                        <a
                                                                            href="{{ route('products.show', $product->product) }}">
                                                                            <img class="h-18 w-auto rounded-lg"
                                                                                src="{{ $product->product?->thumbnailURL('thumb') }}"
                                                                                alt="{{ $product->product->name }}"
                                                                                loading="lazy" />
                                                                        </a>
                                                                    </div>
                                                                    <div class="ml-4 max-w-104 text-wrap">
                                                                        <a href="{{ route('products.show', $product->product) }}"
                                                                            class="font-medium text-base/6 text-gray-900">{{ $product->product->name }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-right">@money($product->price)</td>
                                                            <td>
                                                                <div x-data="{ count: {{ $product->quantity }} }"
                                                                    class="mx-auto flex items-center justify-center">
                                                                    <button type="button"
                                                                        class="w-12 h-12 border border-gray-300 flex items-center justify-center text-2xl bg-white hover:bg-gray-100 transition rounded-l-lg"
                                                                        :disabled="count <= 1"
                                                                        @click="if(count > 1) count--">-</button>
                                                                    <div
                                                                        class="w-12 h-12 border-t border-b border-gray-300 flex items-center justify-center text-xl bg-white">
                                                                        <span x-text="count"></span>
                                                                        <input type="hidden"
                                                                            name="quantity[{{ $product->product_id }}]"
                                                                            x-bind:value="count" />
                                                                    </div>
                                                                    <button type="button" @click="count++"
                                                                        class="w-12 h-12 border border-gray-300 flex items-center justify-center text-2xl bg-white hover:bg-gray-100 transition rounded-r-lg">+</button>
                                                                </div>
                                                            </td>
                                                            <td class="text-right">@money($product->total)</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5" class="text-center">
                                                                {{ __('No Products in Cart!!!') }}
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @if (cart()->items->isNotEmpty())
                                    <div class="p-6 border-t border-gray-200">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <span class="sr-only">For Coupon Apply</span>
                                            </div>
                                            <button type="submit" class="btn-primary !px-6">Update
                                                Cart</button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="lg:col-span-4 mt-6 lg:mt-0">
                        <div class="overflow-hidden rounded-xl bg-white shadow-xs border border-gray-200">
                            <div class="p-6 border-b border-gray-200">
                                <h3 class="text-base-content text-lg font-medium">Cart Summary</h3>
                            </div>
                            @php
                                // $breakdown = getCartTaxBreakdown($cart);
                            @endphp
                            <div class="p-6">
                                <dl class="space-y-6">
                                    <div class="flex items-center justify-between">
                                        <dt class="text-base/6 text-gray-600">Sub Total</dt>
                                        <dd class="text-base/6 font-medium text-gray-900">@money($cart->total)</dd>
                                    </div>
                                    @foreach ($cart->tax_breakdown as $tax)
                                        <div class="flex items-center justify-between">
                                            <dt class="text-base/6 text-gray-600">{{ $tax['name'] }}</dt>
                                            <dd class="text-base/6 font-medium text-gray-900">@money($tax['total_amount'])
                                            </dd>
                                        </div>
                                    @endforeach
                                    <div class="flex items-center justify-between">
                                        <dt class="text-base/6 text-gray-600">Grand Total</dt>
                                        <dd class="text-base/6 font-bold text-gray-900">@money($cart->total + $cart->total_tax_amount)</dd>
                                    </div>
                                </dl>

                                <a href="{{ route('account.checkout') }}" class="btn-primary mt-8">Proceed to
                                    Checkout</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="bg-base-100 py-6 sm:py-10 lg:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Product Header -->
            <div
                class="mb-6 space-y-4 md:mb-8 lg:mb-10 flex flex-col md:flex-row justify-between items-start md:items-center">
                <h2 class="text-base-content text-2xl font-semibold md:text-3xl lg:text-4xl">Best Selling
                    Products</h2>
                <a href="{{ route('products.index') }}" class="btn btn-outline btn-primary">
                    <span>View All</span>
                    <span class="icon-[tabler--arrow-right] size-5"></span>
                </a>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                @each('components.products.card', $bestSellingProducts, 'product')
            </div>
        </div>
    </div>

</x-layouts.front>
