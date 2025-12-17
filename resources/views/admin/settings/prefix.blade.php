<x-layouts.admin>

    <div class="max-w-7xl mx-auto space-y-6">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.settings.prefix'),
                    'text' => 'Prefix Settings',
                ],
            ];

            $title = 'Prefix Settings';

        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title />

        <form method="post" action="{{ route('admin.settings.store') }}">
            @csrf

            <input type="hidden" name="group_name" value="prefix" />
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mb-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-base-content text-lg font-medium">Order Prefix</h3>
                    </div>
                    <div class="card-body">
                        <div class="grid grid-cols-1 gap-4">
                            <div class="space-y-1">
                                <div class="flex justify-between">
                                    <label for="order_prefix" class="label-text">Prefix</label>
                                    <span class="helper-text"
                                        id="order-prefix-optional">setting('prefix.order_prefix')</span>
                                </div>
                                <input type="text" name="order_prefix" id="order_prefix"
                                    class="input @error('order_prefix') is-invalid @enderror"
                                    value="{{ old('order_prefix', $settings->order_prefix) }}" />
                                @error('order_prefix')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <div class="flex justify-between">
                                    <label for="order_digit_length" class="label-text">Digit Length</label>
                                    <span class="helper-text"
                                        id="order-digit-length-optional">setting('prefix.order_digit_length')</span>
                                </div>
                                <input type="text" name="order_digit_length" id="order_digit_length"
                                    class="input @error('order_digit_length') is-invalid @enderror"
                                    value="{{ old('order_digit_length', $settings->order_digit_length) }}" />
                                @error('order_digit_length')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <div class="flex justify-between">
                                    <label for="order_sequence" class="label-text">Sequence</label>
                                    <span class="helper-text"
                                        id="order-sequence-optional">setting('prefix.order_sequence')</span>
                                </div>
                                <input type="text" name="order_sequence" id="order_sequence"
                                    class="input @error('order_sequence') is-invalid @enderror"
                                    value="{{ old('order_sequence', $settings->order_sequence) }}" />
                                @error('order_sequence')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="text-base-content text-lg font-medium">Payment Prefix</h3>
                    </div>
                    <div class="card-body">
                        <div class="grid grid-cols-1 gap-4">

                            <div class="space-y-1">
                                <div class="flex justify-between">
                                    <label for="payment_prefix" class="label-text">Prefix</label>
                                    <span class="helper-text"
                                        id="payment-prefix-optional">setting('prefix.payment_prefix')</span>
                                </div>
                                <input type="text" name="payment_prefix" id="payment_prefix"
                                    class="input @error('payment_prefix') is-invalid @enderror"
                                    value="{{ old('payment_prefix', $settings->payment_prefix) }}" />
                                @error('payment_prefix')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <div class="flex justify-between">
                                    <label for="payment_digit_length" class="label-text">Digit Length</label>
                                    <span class="helper-text"
                                        id="payment-digit-length-optional">setting('prefix.payment_digit_length')</span>
                                </div>
                                <input type="text" name="payment_digit_length" id="payment_digit_length"
                                    class="input @error('payment_digit_length') is-invalid @enderror"
                                    value="{{ old('payment_digit_length', $settings->payment_digit_length) }}" />
                                @error('payment_digit_length')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <div class="flex justify-between">
                                    <label for="payment_sequence" class="label-text">Sequence</label>
                                    <span class="helper-text"
                                        id="payment-sequence-optional">setting('prefix.payment_sequence')</span>
                                </div>
                                <input type="text" name="payment_sequence" id="payment_sequence"
                                    class="input @error('payment_sequence') is-invalid @enderror"
                                    value="{{ old('payment_sequence', $settings->payment_sequence) }}" />
                                @error('payment_sequence')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</x-layouts.admin>
