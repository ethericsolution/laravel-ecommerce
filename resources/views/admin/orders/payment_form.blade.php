<form method="post" action="{{ route('admin.payments.store', $order) }}">
    @csrf

    <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-base-content text-lg font-medium">Record Payment</h3>
        </div>

        <div class="p-6">
            <div class="grid md:grid-cols-2 gap-4">

                <div class="space-y-2">
                    <label for="payment_number" class="label-text">Payment Number</label>
                    <input type="text" name="payment_number" id="payment_number"
                        class="input @error('payment_number') is-invalid @enderror"
                        value="{{ old('payment_number', $payment->payment_number ?? $payment->generatePaymentNumber()) }}"
                        readonly />
                    @error('payment_number')
                        <span class="helper-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="reference" class="label-text">Reference</label>
                    <input type="text" name="reference" id="reference"
                        class="input @error('reference') is-invalid @enderror" value="{{ old('reference') }}" />
                    @error('reference')
                        <span class="helper-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="amount" class="label-text">Amount</label>
                    <input type="text" name="amount" id="amount"
                        class="input @error('amount') is-invalid @enderror"
                        value="{{ old('amount', $order->grand_total - $order->paid_amount) }}" />
                    @error('amount')
                        <span class="helper-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-2 col-span-3 md:col-span-1">
                    <label for="method" class="label-text">Method</label>
                    <select name="method" id="method" class="select @error('method') is-invalid @enderror">
                        <option value="">Select method</option>
                        @foreach (\App\Enums\PaymentType::cases() as $method)
                            <option value="{{ $method->value }}" @selected(old('method', $order->method->value ?? 'cash') == $method->value)>
                                {{ $method->label() }}
                            </option>
                        @endforeach
                    </select>

                    @error('method')
                        <span class="helper-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-2 col-span-2 md:col-span-2">
                    <label for="notes" class="label-text">Note</label>
                    <textarea class="input @error('notes') is-invalid @enderror" id="notes" name="notes" rows="2">{{ old('notes') }}</textarea>
                    @error('notes')
                        <span class="helper-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
