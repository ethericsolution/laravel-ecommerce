<x-layouts.admin>

    <div class="max-w-7xl mx-auto">
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
                            <h3 class="text-base font-semibold text-gray-800">Paypal</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_paypal_is_active" class="control-label">Activation</label>
                                    <span class="text-sm/6 text-gray-500">setting('payment_paypal.is_active')</span>
                                </div>
                                <select id="payment_paypal_is_active" name="is_active" class="form-select">
                                    <option value="1" @selected(old('is_active', setting('payment_paypal.is_active') == 1))>Active</option>
                                    <option value="0" @selected(old('is_active', setting('payment_paypal.is_active') == 0))>De-Active</option>
                                </select>
                                @error('is_active')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_paypal_is_live" class="control-label">Environment</label>
                                    <span class="text-sm/6 text-gray-500">setting('payment_paypal.is_live')</span>
                                </div>
                                <select id="payment_paypal_is_live" name="is_live" class="form-select">
                                    <option value="0">Sandbox</option>
                                    <option value="1">Live</option>
                                </select>
                                @error('is_live')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_paypal_client_id" class="control-label">Client Id</label>
                                    <span class="text-sm/6 text-gray-500">setting('payment_paypal.client_id')</span>
                                </div>
                                <input type="text" name="client_id" id="payment_paypal_client_id"
                                    class="form-control @error('client_id') is-invalid @enderror"
                                    value="{{ old('client_id', setting('payment_paypal.client_id')) }}" />
                                @error('client_id')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_paypal_client_secret" class="control-label">Client
                                        Secret</label>
                                    <span class="text-sm/6 text-gray-500">setting('payment_paypal.client_secret')</span>
                                </div>
                                <input type="text" name="client_secret" id="payment_paypal_client_secret"
                                    class="form-control @error('client_secret') is-invalid @enderror"
                                    value="{{ old('client_secret', setting('payment_paypal.client_secret')) }}" />
                                @error('client_secret')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200">
                            <button type="submit" class="btn-primary">Save Changes</button>
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
                            <h3 class="text-base font-semibold text-gray-800">Phonepe</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_phonepe_is_active" class="control-label">Activation</label>
                                    <span class="text-sm/6 text-gray-500">setting('payment_phonepe.is_active')</span>
                                </div>
                                <select id="payment_phonepe_is_active" name="is_active" class="form-select">
                                    <option value="1" @selected(old('is_active', setting('payment_phonepe.is_active') == 1))>Active</option>
                                    <option value="0" @selected(old('is_active', setting('payment_phonepe.is_active') == 0))>De-Active</option>
                                </select>
                                @error('is_active')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_phonepe_is_live" class="control-label">Environment</label>
                                    <span class="text-sm/6 text-gray-500">setting('payment_phonepe.is_live')</span>
                                </div>
                                <select id="payment_phonepe_is_live" name="is_live" class="form-select">
                                    <option value="0">Sandbox</option>
                                    <option value="1">Live</option>
                                </select>
                                @error('is_live')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_phonepe_client_id" class="control-label">Client Id</label>
                                    <span class="text-sm/6 text-gray-500">setting('payment_phonepe.client_id')</span>
                                </div>
                                <input type="text" name="client_id" id="payment_phonepe_client_id"
                                    class="form-control @error('client_id') is-invalid @enderror"
                                    value="{{ old('client_id', setting('payment_phonepe.client_id')) }}" />
                                @error('client_id')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_phonepe_client_secret" class="control-label">Client
                                        Secret</label>
                                    <span
                                        class="text-sm/6 text-gray-500">setting('payment_phonepe.client_secret')</span>
                                </div>
                                <input type="text" name="client_secret" id="payment_phonepe_client_secret"
                                    class="form-control @error('client_secret') is-invalid @enderror"
                                    value="{{ old('client_secret', setting('payment_phonepe.client_secret')) }}" />
                                @error('client_secret')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_phonepe_client_version" class="control-label">Client
                                        Version</label>
                                    <span
                                        class="text-sm/6 text-gray-500">setting('payment_phonepe.client_version')</span>
                                </div>
                                <input type="text" name="client_version" id="payment_phonepe_client_version"
                                    class="form-control @error('client_version') is-invalid @enderror"
                                    value="{{ old('client_version', setting('payment_phonepe.client_version')) }}" />
                                @error('client_version')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="p-6 border-t border-gray-200">
                            <button type="submit" class="btn-primary">Save Changes</button>
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
                            <h3 class="text-base font-semibold text-gray-800">Razorpay</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_razorpay_is_active" class="control-label">Activation</label>
                                    <span class="text-sm/6 text-gray-500">setting('payment_razorpay.is_active')</span>
                                </div>
                                <select id="payment_razorpay_is_active" name="is_active" class="form-select">
                                    <option value="1" @selected(old('is_active', setting('payment_razorpay.is_active') == 1))>Active</option>
                                    <option value="0" @selected(old('is_active', setting('payment_razorpay.is_active') == 0))>De-Active</option>
                                </select>
                                @error('is_active')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_razorpay_client_id" class="control-label">Client
                                        Id</label>
                                    <span class="text-sm/6 text-gray-500">setting('payment_razorpay.client_id')</span>
                                </div>
                                <input type="text" name="client_id" id="payment_razorpay_client_id"
                                    class="form-control @error('client_id') is-invalid @enderror"
                                    value="{{ old('client_id', setting('payment_razorpay.client_id')) }}" />
                                @error('client_id')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <label for="payment_razorpay_client_secret" class="control-label">Client
                                        Secret</label>
                                    <span
                                        class="text-sm/6 text-gray-500">setting('payment_razorpay.client_secret')</span>
                                </div>
                                <input type="text" name="client_secret" id="payment_razorpay_client_secret"
                                    class="form-control @error('client_secret') is-invalid @enderror"
                                    value="{{ old('client_secret', setting('payment_razorpay.client_secret')) }}" />
                                @error('client_secret')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="p-6 border-t border-gray-200">
                            <button type="submit" class="btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
