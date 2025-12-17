<x-layouts.admin>

    <div class="max-w-7xl mx-auto space-y-6">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.settings.paymentGateway'),
                    'text' => 'Payment Gateway Settings',
                ],
            ];

            $title = 'Payment Gateway Settings';

        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title />


        <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <form method="post" action="{{ route('admin.settings.store') }}">
                    @csrf

                    <input type="hidden" name="group_name" value="payment_paypal" />
                    <div class="overflow-hidden rounded-xl bg-white shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-base-content text-lg font-medium">Paypal</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_paypal_is_active" class="label-text">Activation</label>
                                    <span class="helper-text">setting('payment_paypal.is_active')</span>
                                </div>
                                <select id="payment_paypal_is_active" name="is_active" class="select">
                                    <option value="1" @selected(old('is_active', setting('payment_paypal.is_active') == 1))>Active</option>
                                    <option value="0" @selected(old('is_active', setting('payment_paypal.is_active') == 0))>De-Active</option>
                                </select>
                                @error('is_active')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_paypal_is_live" class="label-text">Environment</label>
                                    <span class="helper-text">setting('payment_paypal.is_live')</span>
                                </div>
                                <select id="payment_paypal_is_live" name="is_live" class="select">
                                    <option value="0">Sandbox</option>
                                    <option value="1">Live</option>
                                </select>
                                @error('is_live')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_paypal_client_id" class="label-text">Client Id</label>
                                    <span class="helper-text">setting('payment_paypal.client_id')</span>
                                </div>
                                <input type="text" name="client_id" id="payment_paypal_client_id"
                                    class="input @error('client_id') is-invalid @enderror"
                                    value="{{ old('client_id', setting('payment_paypal.client_id')) }}" />
                                @error('client_id')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_paypal_client_secret" class="label-text">Client
                                        Secret</label>
                                    <span class="helper-text">setting('payment_paypal.client_secret')</span>
                                </div>
                                <input type="text" name="client_secret" id="payment_paypal_client_secret"
                                    class="input @error('client_secret') is-invalid @enderror"
                                    value="{{ old('client_secret', setting('payment_paypal.client_secret')) }}" />
                                @error('client_secret')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>

            <div>
                <form method="post" action="{{ route('admin.settings.store') }}">
                    @csrf

                    <input type="hidden" name="group_name" value="payment_phonepe" />
                    <div class="overflow-hidden rounded-xl bg-white shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-base-content text-lg font-medium">Phonepe</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_phonepe_is_active" class="label-text">Activation</label>
                                    <span class="helper-text">setting('payment_phonepe.is_active')</span>
                                </div>
                                <select id="payment_phonepe_is_active" name="is_active" class="select">
                                    <option value="1" @selected(old('is_active', setting('payment_phonepe.is_active') == 1))>Active</option>
                                    <option value="0" @selected(old('is_active', setting('payment_phonepe.is_active') == 0))>De-Active</option>
                                </select>
                                @error('is_active')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_phonepe_is_live" class="label-text">Environment</label>
                                    <span class="helper-text">setting('payment_phonepe.is_live')</span>
                                </div>
                                <select id="payment_phonepe_is_live" name="is_live" class="select">
                                    <option value="0">Sandbox</option>
                                    <option value="1">Live</option>
                                </select>
                                @error('is_live')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_phonepe_client_id" class="label-text">Client Id</label>
                                    <span class="helper-text">setting('payment_phonepe.client_id')</span>
                                </div>
                                <input type="text" name="client_id" id="payment_phonepe_client_id"
                                    class="input @error('client_id') is-invalid @enderror"
                                    value="{{ old('client_id', setting('payment_phonepe.client_id')) }}" />
                                @error('client_id')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_phonepe_client_secret" class="label-text">Client
                                        Secret</label>
                                    <span class="helper-text">setting('payment_phonepe.client_secret')</span>
                                </div>
                                <input type="text" name="client_secret" id="payment_phonepe_client_secret"
                                    class="input @error('client_secret') is-invalid @enderror"
                                    value="{{ old('client_secret', setting('payment_phonepe.client_secret')) }}" />
                                @error('client_secret')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_phonepe_client_version" class="label-text">Client
                                        Version</label>
                                    <span class="helper-text">setting('payment_phonepe.client_version')</span>
                                </div>
                                <input type="text" name="client_version" id="payment_phonepe_client_version"
                                    class="input @error('client_version') is-invalid @enderror"
                                    value="{{ old('client_version', setting('payment_phonepe.client_version')) }}" />
                                @error('client_version')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="p-6 border-t border-gray-200">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>

            <div>
                <form method="post" action="{{ route('admin.settings.store') }}">
                    @csrf

                    <input type="hidden" name="group_name" value="payment_razorpay" />
                    <div class="overflow-hidden rounded-xl bg-white shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-base-content text-lg font-medium">Razorpay</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_razorpay_is_active" class="label-text">Activation</label>
                                    <span class="helper-text">setting('payment_razorpay.is_active')</span>
                                </div>
                                <select id="payment_razorpay_is_active" name="is_active" class="select">
                                    <option value="1" @selected(old('is_active', setting('payment_razorpay.is_active') == 1))>Active</option>
                                    <option value="0" @selected(old('is_active', setting('payment_razorpay.is_active') == 0))>De-Active</option>
                                </select>
                                @error('is_active')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_razorpay_client_id" class="label-text">Client
                                        Id</label>
                                    <span class="helper-text">setting('payment_razorpay.client_id')</span>
                                </div>
                                <input type="text" name="client_id" id="payment_razorpay_client_id"
                                    class="input @error('client_id') is-invalid @enderror"
                                    value="{{ old('client_id', setting('payment_razorpay.client_id')) }}" />
                                @error('client_id')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_razorpay_client_secret" class="label-text">Client
                                        Secret</label>
                                    <span class="helper-text">setting('payment_razorpay.client_secret')</span>
                                </div>
                                <input type="text" name="client_secret" id="payment_razorpay_client_secret"
                                    class="input @error('client_secret') is-invalid @enderror"
                                    value="{{ old('client_secret', setting('payment_razorpay.client_secret')) }}" />
                                @error('client_secret')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="p-6 border-t border-gray-200">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
