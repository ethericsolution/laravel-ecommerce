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
                    'text' => $order->id ? 'Edit' : 'Create',
                ],
            ];
            $title = $order->id ? 'Edit ' . $order->order_number : 'Create Order';
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.orders.index')" />

        <form method="post"
            action="{{ $order->id ? route('admin.orders.update', $order) : route('admin.orders.store') }}"
            x-data="orderItems" @state-changed.window="selectedState = $event.detail; calculateTaxBreakdown()"
            @product-selected.window="calculateTaxBreakdown()">
            @csrf

            @isset($order->id)
                @method('put')
            @endisset

            <div class="mt-6 rounded-xl bg-white shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-base-content text-lg font-medium">Order Information</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                        <div class="space-y-2">
                            <label for="order_number" class="label-text">Order #</label>
                            <input type="text" name="order_number" id="order_number"
                                class="input @error('order_number') is-invalid @enderror"
                                value="{{ old('order_number', $order->order_number ?? $order->generateOrderNumber()) }}"
                                readonly />
                            @error('order_number')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="order_date" class="label-text">Order Date</label>
                            <input type="date" name="order_date" id="order_date"
                                class="input @error('order_date') is-invalid @enderror"
                                value="{{ old('order_date', $order->order_date?->format('Y-m-d') ?? now()->format('Y-m-d')) }}" />
                            @error('order_date')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="user_name" class="label-text">User</label>
                            @include('admin.orders.user-combobox')
                            @error('user_id')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="status" class="label-text">Status</label>
                            <select name="status" id="status" class="select @error('status') is-invalid @enderror">
                                <option value="">Select Status</option>
                                @foreach (\App\Enums\OrderStatus::cases() as $status)
                                    <option value="{{ $status->value }}" @selected(old('status', $order->status->value ?? 'new') == $status->value)>
                                        {{ $status->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.orders.address', ['address' => $order?->address])

            <div class="mt-6 rounded-xl bg-white shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-base-content text-lg font-medium">Order Items</h3>
                </div>
                <div class="p-6">
                    <div class="-mx-6 -my-6 ">
                        <div class="inline-block min-w-full align-middle">
                            <table class="record-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Tax</th>
                                        <th scope="col">
                                            <span class="sr-only">Action</span>
                                        </th>
                                    </tr>
                                </thead>
                                @php
                                    $taxPercentages = [5.0, 12.0, 18.0, 28.0];
                                @endphp
                                <tbody>
                                    <template x-for="(item, index) in items" :key="index">
                                        <tr>
                                            <td width="50%">
                                                @include('admin.orders.product-combobox')
                                                <p class="text-sm text-red-600"
                                                    x-text="getValidationError(index, 'product_id')">
                                                </p>
                                            </td>
                                            <td>
                                                <input type="number" name="quantity" id="quantity"
                                                    class="input @error('quantity') is-invalid @enderror"
                                                    :name="'items[' + index + '][quantity]'" x-model="item.quantity"
                                                    @input="updateTotal(index)" />
                                            </td>
                                            <td>
                                                <input type="number" name="price" id="price"
                                                    class="input @error('price') is-invalid @enderror"
                                                    :name="'items[' + index + '][price]'" x-model="item.price"
                                                    @input="updateTotal(index)" step="any" />
                                            </td>
                                            <td>
                                                <input type="number" name="total" id="total"
                                                    class="input @error('total') is-invalid @enderror"
                                                    :name="'items[' + index + '][total]'" x-model="item.total"
                                                    readonly />
                                            </td>
                                            <td>
                                                <select :name="'items[' + index + '][tax_rate]'" x-model="item.tax_rate"
                                                    class="select"
                                                    @change="updateTotal(index); calculateTaxBreakdown();">
                                                    <option value="0">No Tax</option>
                                                    <option value="5">5%</option>
                                                    <option value="12">12%</option>
                                                    <option value="18" selected>18%</option>
                                                    <option value="28">28%</option>
                                                </select>
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="link-danger" @click="removeItem(index)"
                                                    x-show="items.length > 1">

                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                        fill="currentColor" class="size-4">
                                                        <path fill-rule="evenodd"
                                                            d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>

                        <div class="border-t border-gray-200 text-center">
                            <button type="button" @click="addItem()" class="btn-secondary my-4">Add Item</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-base-content text-lg font-medium">Order Summary</h3>
                </div>
                <div class="p-6">
                    <div class="grid md:grid-cols-4 gap-4">
                        <div class="space-y-2">
                            <label for="sub_total" class="label-text">Sub Total</label>
                            <input type="text" name="sub_total" id="sub_total"
                                class="input @error('sub_total') is-invalid @enderror" :value="subTotal.toFixed(2)"
                                readonly />
                            @error('sub_total')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="delivery_charge" class="label-text">Delivery Charge</label>
                            <input type="text" name="delivery_charge" id="delivery_charge"
                                class="input @error('delivery_charge') is-invalid @enderror"
                                x-model="deliveryCharge" />
                            @error('delivery_charge')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="tax_amount" class="label-text">Tax Amount</label>
                            <input type="text" name="tax_amount" id="tax_amount" class="input"
                                :value="taxAmount.toFixed(2)" readonly />
                        </div>

                        <div class="space-y-2">
                            <label for="grand_total" class="label-text">Grand Total</label>
                            <input type="text" name="grand_total" id="grand_total"
                                class="input @error('grand_total') is-invalid @enderror" :value="grandTotal.toFixed(2)"
                                readonly />
                            @error('grand_total')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-2 md:col-span-4">
                            <label for="notes" class="label-text">Notes</label>
                            <textarea class="input @error('notes') is-invalid @enderror" id="notes" name="notes" rows="2">{{ old('notes', $order->notes) }}</textarea>
                            @error('notes')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tax Breakdown Section -->
            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm" x-show="taxBreakdown.length > 0">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-base-content text-lg font-medium">Tax Breakdown</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tax Type</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Taxable Amount</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tax Amount</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <template x-for="(tax, index) in taxBreakdown" :key="index">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                                        x-text="tax.type + ' ' + tax.rate + '%'"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                        x-text="'{{ get_currency_symbol() }} ' + (tax.amount / (tax.rate / 100)).toFixed(2)">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                        x-text="'{{ get_currency_symbol() }} ' + tax.amount.toFixed(2)"></td>
                                </tr>
                            </template>
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900"
                                    colspan="2">Total Tax</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900"
                                    x-text="'₹' + taxAmount.toFixed(2)"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="mt-6 space-x-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-soft">Cancel</a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            window.validationErrors = @json($errors->toArray());

            function getValidationError(index, field) {
                const key = `items.${index}.${field}`;
                return window.validationErrors && window.validationErrors[key] ?
                    window.validationErrors[key][0] :
                    '';
            }

            @php
                $formItems = $order->items->map(function ($item) {
                    $item->name = $item->product->name;
                    $item->tax_rate = (float) $item->tax_rate ?? 18; // Default tax rate

                    return $item->only(['product_id', 'name', 'quantity', 'price', 'tax_rate', 'total']);
                });
            @endphp

            var formItems = @json(old('items', $formItems->toArray() ?? []));

            function orderItems() {
                // Initialize items with existing order items or an empty array

                if (formItems.length == 0) {
                    formItems.push({
                        product_id: '',
                        quantity: 1,
                        price: 0,
                        tax_rate: 18,
                        total: 0,
                    })
                }

                return {
                    items: formItems, // Array to hold order items
                    deliveryCharge: '{{ old('delivery_charge', $order->delivery_charge ?? 0) }}',
                    selectedState: {{ old('address.state_id', $order->address?->state_id ?? 'null') }},
                    init() {
                        if (this.selectedState) {
                            this.calculateTaxBreakdown();
                        }
                    },


                    // Method to add a new item
                    addItem() {
                        this.items.push({
                            product_id: '',
                            quantity: 1,
                            price: 0,
                            tax_rate: 18,
                            total: 0,
                        });

                        this.calculateTaxBreakdown();
                    },

                    // Method to remove an item
                    removeItem(index) {
                        this.items.splice(index, 1);

                        this.calculateTaxBreakdown();
                    },

                    // Method to update selected state
                    updateSelectedState(stateId) {
                        this.selectedState = stateId;
                        this.calculateTaxBreakdown();
                    },

                    updateTotal(index) {
                        const item = this.items[index];
                        const baseAmount = item.quantity * item.price;
                        item.total = parseFloat(baseAmount).toFixed(2);

                        this.calculateTaxBreakdown();
                    },

                    get subTotal() {
                        return this.items.reduce((sum, item) => sum + parseFloat(item.total || 0), 0);
                    },

                    get taxAmount() {
                        return this.taxBreakdown.reduce((sum, tax) => sum + tax.amount, 0);
                    },

                    taxBreakdown: [],

                    async calculateTaxBreakdown() {
                        if (!this.selectedState || this.subTotal <= 0) {
                            this.taxBreakdown = [];
                            return;
                        }

                        try {
                            const response = await axios.post('{{ route('admin.orders.getTaxes') }}', {
                                state_id: this.selectedState,
                                items: this.items,
                                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            });

                            this.taxBreakdown = response.data.taxes || [];
                        } catch (error) {
                            console.error('Error calculating taxes:', error);
                            this.taxBreakdown = [];
                        }
                    },

                    get grandTotal() {
                        return this.subTotal + parseFloat(this.deliveryCharge || 0) + this.taxAmount;
                    },
                };
            }
        </script>
    @endpush
</x-layouts.admin>
