<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Your Account'],
                ['url' => '#', 'text' => 'Checkout'],
            ],
            'title' => 'Checkout',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <div class="bg-base-100 py-6 sm:py-10 lg:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <form action="{{ route('account.checkout.store') }}" method="POST">
                @csrf
                <div class="mt-6 lg:grid lg:grid-cols-12 gap-6" x-data="checkoutTax()" x-init="fetchTaxes()">
                    <div class="lg:col-span-8">
                        <div class="card card-border shadow-none">
                            <div class="card-body space-y-6">

                                <div class="flex w-full items-start gap-3 flex-wrap sm:flex-nowrap">
                                    @forelse (auth()?->user()?->addresses as $address)
                                        <label class="custom-option flex sm:w-1/2 flex-row items-start gap-3">
                                            <input type="radio" name="address_id" value="{{ $address->id }}"
                                                class="radio hidden" @checked($address->is_default) x-model="addressId"
                                                @change="fetchTaxes" />
                                            <span class="label-text w-full text-start">
                                                <span class="flex justify-between mb-1">
                                                    <span class="text-base font-medium">{{ $address->name }}</span>
                                                    @if ($address->is_default)
                                                        <span class="text-base-content/50 text-base">Default</span>
                                                    @endif
                                                </span>
                                                <span class="text-base-content/80">
                                                    {{ $address?->contact_name }} <br>
                                                    {{ $address?->address_line_1 }} ,
                                                    {{ $address?->address_line_2 }}<br>
                                                    {{ $address?->city }},<br>
                                                    {{ $address->state->name }}
                                                    {{ $address?->country?->iso2 }}
                                                    -
                                                    {{ $address?->zip_code }}<br>
                                                    Phone Number : {{ $address?->phone }}
                                                </span>
                                            </span>
                                        </label>
                                    @endforeach
                                </div>

                                <a href="{{ route('account.addresses.create') }}"
                                    class="btn btn-outline btn-primary w-1/2">
                                    <span class="icon-[tabler--circle-plus] size-4.5"></span>
                                    {{ __('Add Address') }}
                                </a>


                                @error('address_id')
                                    <p class="text-error">Please Select Address to continue order.</p>
                                @enderror

                                <div class="mt-10 border-t border-gray-200 pt-10">
                                    <h2 class="text-2xl font-semibold text-base-content">Payment</h2>

                                    <fieldset class="mt-4">
                                        <legend class="sr-only">Payment type</legend>
                                        <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                                            <input type="hidden" name="payment_method" value="cod" />

                                            @forelse (paymentGateways() as $paymentGateway)
                                                <div class="flex items-center gap-1">
                                                    <input id="{{ $paymentGateway['name'] }}" name="payment_method"
                                                        type="radio" class="radio radio-primary"
                                                        value="{{ $paymentGateway['name'] }}"
                                                        {{ $loop->first ? 'checked' : '' }} />
                                                    <label for="{{ $paymentGateway['name'] }}" class=label-text
                                                        text-base
                                                        cursor-pointer">{{ $paymentGateway['description'] }}</label>
                                                </div>
                                            @empty
                                                <div class="flex items-center gap-1">
                                                    <input id="cod" name="payment_method" type="radio"
                                                        class="radio radio-primary" value="cod" checked />
                                                    <label for="cod" class=label-text text-base
                                                        cursor-pointer">{{ __('Cash on Delivery') }}</label>
                                                </div>
                                            @endforelse
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="space-y-1">
                                    <label for="notes" class="label-text">Notes</label>
                                    <textarea id="notes" name="notes" class="textarea" rows="3">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <p class="helper-text">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-4 mt-6 lg:mt-0">
                        <div class="card card-border shadow-none">
                            <div class="card-body">
                                @foreach (cart()->items as $product)
                                    <!-- cart item start  -->
                                    <div class="block pb-4">
                                        <div class="flex items-start space-y-4 gap-3">
                                            <div class="size-18 shrink-0">
                                                <a href="{{ route('products.show', $product->product) }}">
                                                    <img class="rounded-box bg-contain w-full shrink-0 h-full"
                                                        src="{{ $product->product->thumbnailURL('thumb') }}"
                                                        alt="{{ $product->product->name }}" loading="lazy" />
                                                </a>
                                            </div>
                                            <div class="inline-block w-full">
                                                <a class="text-base-content font-medium line-clamp-1"
                                                    href="{{ route('products.show', $product->product) }}">{{ $product->product->name }}</a>

                                                <div class="mt-2 flex justify-between">
                                                    <p class="text-base-content font-medium line-clamp-1/tight">Qty:
                                                        <strong class="font-semibold">{{ $product->quantity }}</strong>
                                                    </p>
                                                    <p
                                                        class="text-base-content text-lg font-medium text-end whitespace-nowrap">
                                                        @money($product->total)
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- cart item end -->
                                <dl class="space-y-6 mt-10">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-base-content/80">Sub Total</span>
                                        <span
                                            class="text-base-content font-medium whitespace-nowrap">@money(cart()->total)</span>
                                    </div>

                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-base-content/80">Delivery Charge</span>
                                        <span class="text-base-content font-medium whitespace-nowrap"
                                            x-text="formatCurrency(deliveryCharge)"></span>
                                    </div>

                                    <template x-for="tax in taxes" :key="tax.name">
                                        <div class="flex items-center justify-between">
                                            <dt class="text-base/6 text-gray-600" x-text="tax.name"></dt>
                                            <dd class="text-base/6 font-bold text-gray-900" x-text="tax.amount_display">
                                            </dd>
                                        </div>
                                    </template>
                                    <div class="divider mb-3"></div>
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-base-content text-lg font-semibold">Grand Total</span>
                                        <span class="text-base-content text-lg font-semibold whitespace-nowrap"
                                            x-text="formatCurrency(grandTotal)"></span>
                                    </div>
                                </dl>

                                <button type="submit" class="w-full btn btn-primary mt-8">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            var stateId = "{{ old('address.state_id', setting('company.state')) }}";

            function checkoutTax() {
                return {
                    addressId: "{{ auth()->user()?->defaultAddress?->id }}",
                    taxes: [],
                    state_id: stateId,
                    subTotal: {{ cart()->total }},
                    deliveryCharge: {{ getDeliveryCharge() }},
                    totalTax: 0,
                    grandTotal() {
                        return this.subTotal + this.deliveryCharge + this.totalTax;
                    },
                    fetchTaxes() {
                        axios.get("{{ route('account.checkout.taxes') }}", {
                                params: {
                                    address_id: this.addressId,
                                    state_id: this.state_id
                                }
                            })
                            .then(response => {
                                this.taxes = response.data.taxes;
                                this.totalTax = response.data.total_tax;

                                this.grandTotal = this.subTotal + this.totalTax + this.deliveryCharge;
                            })
                            .catch(error => {
                                console.error("Tax fetch error:", error);
                            });
                    },
                    formatCurrency(value) {
                        return value.toLocaleString('en-US', {
                            style: 'currency',
                            currency: '{{ app_country()->currency }}'
                        });
                    }
                }
            }
        </script>
    @endpush
</x-layouts.front>
