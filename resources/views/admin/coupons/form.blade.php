<x-layouts.admin>
    <div class="max-w-7xl mx-auto space-y-6">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.coupons.index'),
                    'text' => 'Coupons',
                ],
                [
                    'text' => $coupon->id ? 'Edit' : 'Create',
                ],
            ];
            $title = $coupon->id ? 'Edit ' . $coupon->code : 'Create Coupon';
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.coupons.index')" />

        <form method="post"
            action="{{ $coupon->id ? route('admin.coupons.update', $coupon) : route('admin.coupons.store') }}">
            @csrf

            @isset($coupon->id)
                @method('put')
            @endisset
            <div class="card">
                <div class="card-body">
                    <div class="grid md:grid-cols-2 gap-4 py-2">

                        <div class="space-y-1">
                            <label for="code" class="label-text">Coupon Code</label>
                            <input type="text" name="code" id="code"
                                class="input @error('code') is-invalid @enderror"
                                value="{{ old('code', $coupon->code) }}" />
                            @error('code')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1 col-span-2">
                            <label for="description" class="label-text">Description</label>
                            <textarea class="textarea @error('description') is-invalid @enderror" id="description" name="description"
                                rows="3">{{ old('description', $coupon->description) }}</textarea>
                            @error('description')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-3 gap-4 py-2">
                        <div class="space-y-1">
                            <label for="type" class="label-text">Discount Type</label>
                            <select name="type" id="type" class="select @error('type') is-invalid @enderror">
                                <option value="flat" @selected(old('type', $coupon->type) == 'flat')>Flat</option>
                                <option value="percent" @selected(old('type', $coupon->type) == 'percent')>Percent</option>
                            </select>
                            @error('type')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="value" class="label-text">Discount Value</label>
                            <input type="text" name="value" id="value"
                                class="input @error('value') is-invalid @enderror"
                                value="{{ old('value', $coupon->value ?? 0) }}" />
                            @error('value')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="max_discount_value" class="label-text">
                                Maximum Discount Amount
                            </label>
                            <input type="text" name="max_discount_value" id="max_discount_value"
                                class="input @error('max_discount_value') is-invalid @enderror"
                                value="{{ old('max_discount_value', $coupon->max_discount_value ?? 0) }}" />
                            @error('max_discount_value')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 py-2">
                        <div class="space-y-1">
                            <label for="start_date" class="label-text">Start Date</label>
                            <input type="date" name="start_date" id="start_date"
                                class="input @error('start_date') is-invalid @enderror"
                                value="{{ old('start_date', $coupon->start_date?->format('Y-m-d') ?? now()->format('Y-m-d')) }}" />
                            @error('start_date')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="end_date" class="label-text">End Date</label>
                            <input type="date" name="end_date" id="end_date"
                                class="input @error('end_date') is-invalid @enderror"
                                value="{{ old('end_date', $coupon->end_date?->format('Y-m-d') ?? now()->addDays(10)->format('Y-m-d')) }}" />
                            @error('end_date')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 py-2">
                        <div class="space-y-1">
                            <label for="total_quantity" class="label-text">Maximum usage limit</label>
                            <input type="text" name="total_quantity" id="total_quantity"
                                class="input @error('total_quantity') is-invalid @enderror"
                                value="{{ old('total_quantity', $coupon->total_quantity ?? 0) }}" />
                            <p class="text-gray-600 text-xs">
                                Total coupon to create. Enter 0 to unlimited
                            </p>
                            @error('total_quantity')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="use_per_user" class="label-text">Maximum usage limit per user</label>
                            <input type="text" name="use_per_user" id="use_per_user"
                                class="input @error('use_per_user') is-invalid @enderror"
                                value="{{ old('use_per_user', $coupon->use_per_user ?? 0) }}" />
                            <p class="text-gray-600 text-xs">
                                How many times customer can use this coupon?
                            </p>
                            @error('use_per_user')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 py-2 ">
                        <div class="space-y-1">
                            <label for="min_cart_value" class="label-text">Minimum Amount in cart required</label>
                            <input type="text" name="min_cart_value" id="min_cart_value"
                                class="input @error('min_cart_value') is-invalid @enderror"
                                value="{{ old('min_cart_value', $coupon->min_cart_value ?? 0) }}" />
                            @error('min_cart_value')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="max_cart_value" class="label-text">Maximum Amount in cart required</label>
                            <input type="text" name="max_cart_value" id="max_cart_value"
                                class="input @error('max_cart_value') is-invalid @enderror"
                                value="{{ old('max_cart_value', $coupon->max_cart_value ?? 0) }}" />
                            @error('max_cart_value')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="hidden" name="is_for_new_user" value="0" />
                            <input id="is_for_new_user" name="is_for_new_user" type="checkbox"
                                class="checkbox checkbox-primary" value="1" @checked(old('is_for_new_user', $coupon->is_for_new_user)) />
                            <label for="is_for_new_user" class="label-text">Check for New User Only</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 space-x-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-soft">Cancel</a>
            </div>

        </form>
    </div>

</x-layouts.admin>
