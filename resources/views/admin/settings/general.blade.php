<x-layouts.admin>


    <div class="max-w-7xl mx-auto">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.settings.general'),
                    'text' => 'General Settings',
                ],
            ];

            $title = 'General Settings';

        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title />


        <form method="post" action="{{ route('admin.settings.store') }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="group_name" value="general" />
            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800">App Settings</h3>
                </div>
                <div class="p-6">
                    <div class="grid lg:grid-cols-3 gap-4">
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="app_name" class="control-label">App Name</label>
                                <span class="text-sm/6 text-gray-500"
                                    id="app-name-optional">setting('general.app_name')</span>
                            </div>
                            <input type="text" name="app_name" id="app_name"
                                class="form-control @error('app_name') is-invalid @enderror"
                                value="{{ old('app_name', $settings->app_name) }}"
                                aria-describedby="app-name-optional" />
                            @error('app_name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="site_name" class="control-label">Site Name</label>
                                <span class="text-sm/6 text-gray-500"
                                    id="site-name-optional">setting('general.site_name')</span>
                            </div>
                            <input type="text" name="site_name" id="site_name"
                                class="form-control @error('site_name') is-invalid @enderror"
                                value="{{ old('site_name', $settings->site_name) }}" />
                            @error('site_name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="tagline" class="control-label">Tagline</label>
                                <span class="text-sm/6 text-gray-500"
                                    id="tagline-optional">setting('general.tagline')</span>
                            </div>
                            <input type="text" name="tagline" id="tagline"
                                class="form-control @error('tagline') is-invalid @enderror"
                                value="{{ old('tagline', $settings->tagline) }}" />
                            @error('tagline')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-full">
                            <div class="flex justify-between">
                                <label for="site_description" class="control-label">Site Description</label>
                                <span class="text-sm/6 text-gray-500"
                                    id="site-description-optional">setting('general.site_description')</span>
                            </div>
                            <textarea class="form-control @error('site_description') is-invalid @enderror" id="site_description"
                                name="site_description" rows="2">{{ old('site_description', $settings->site_description) }}</textarea>
                            @error('site_description')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="date_format" class="control-label">
                                    Date Format
                                </label>
                                <span class="text-sm/6 text-gray-500"
                                    id="date-format-optional">setting('general.date_format')</span>
                            </div>
                            <select id="date_format" name="date_format"
                                class="form-select @error('date_format') is-invalid @enderror">
                                <option value="">Select Date Format</option>
                                @foreach ($dateFormats as $key => $dateFormat)
                                    <option value="{{ $key }}" @selected(old('date_format', $settings->date_format) == $key)>
                                        ({{ $key }})
                                        {{ $dateFormat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('date_format')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="time_format" class="control-label">
                                    Time Format
                                </label>
                                <span class="text-sm/6 text-gray-500"
                                    id="time-format-optional">setting('general.time_format')</span>
                            </div>
                            <select id="time_format" name="time_format"
                                class="form-select @error('time_format') is-invalid @enderror">
                                <option value="">Select Time Format</option>
                                @foreach ($timeFormats as $key => $timeFormat)
                                    <option value="{{ $key }}" @selected(old('time_format', $settings->time_format) == $key)>
                                        ({{ $key }})
                                        {{ $timeFormat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('time_format')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="timezone" class="control-label">
                                    Time Zone
                                </label>
                                <span class="text-sm/6 text-gray-500"
                                    id="time-zone-optional">setting('general.timezone')</span>
                            </div>
                            <select id="timezone" name="timezone"
                                class="form-select @error('timezone') is-invalid @enderror">
                                <option value="">Select Time Zone</option>
                                @foreach ($timezones as $key => $timezone)
                                    <option value="{{ $timezone }}" @selected(old('timezone', $settings->timezone) == $timezone)>
                                        {{ $timezone }}
                                    </option>
                                @endforeach
                            </select>
                            @error('timezone')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="analytics_code" class="control-label">Google Analytics Code</label>
                                <span class="text-sm/6 text-gray-500"
                                    id="analytics_code-optional">setting('general.analytics_code')</span>
                            </div>
                            <input type="text" name="analytics_code" id="analytics_code"
                                class="form-control @error('analytics_code') is-invalid @enderror"
                                value="{{ old('analytics_code', $settings->analytics_code) }}" />
                            @error('analytics_code')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- is_tax_inclusive --}}
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="is_tax_inclusive" class="control-label">
                                    Is Tax Inclusive
                                </label>
                                <span class="text-sm/6 text-gray-500"
                                    id="is-tax-inclusive-optional">setting('general.is_tax_inclusive')</span>
                            </div>
                            <select id="is_tax_inclusive" name="is_tax_inclusive" class="form-select">
                                <option value="0" @selected(old('is_tax_inclusive', $settings->is_tax_inclusive) == '0')>Exclusive</option>
                                <option value="1" @selected(old('is_tax_inclusive', $settings->is_tax_inclusive) == '1')>Inclusive</option>
                            </select>
                            @error('is_tax_inclusive')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="delivery_charge" class="control-label">Delivery Charge</label>
                                <span class="text-sm/6 text-gray-500"
                                    id="delivery_charge-optional">setting('general.delivery_charge')</span>
                            </div>
                            <input type="number" name="delivery_charge" id="delivery_charge"
                                class="form-control @error('delivery_charge') is-invalid @enderror"
                                value="{{ old('delivery_charge', $settings->delivery_charge) }}" />
                            @error('delivery_charge')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-full">
                            <div class="flex justify-between">
                                <label for="free_delivery_zipcode" class="control-label">Free Delivery
                                    Zipcode</label>
                                <span class="text-sm/6 text-gray-500"
                                    id="site-description-optional">setting('general.free_delivery_zipcode')</span>
                            </div>
                            <textarea class="form-control @error('free_delivery_zipcode') is-invalid @enderror" id="free_delivery_zipcode"
                                name="free_delivery_zipcode" rows="2">{{ old('free_delivery_zipcode', $settings->free_delivery_zipcode) }}</textarea>
                            @error('free_delivery_zipcode')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-full">
                            <div class="flex justify-between">
                                <label for="admin_emails" class="control-label">
                                    Admin Emails (use , for multiple)
                                </label>
                                <span class="text-sm/6 text-gray-500"
                                    id="site-description-optional">setting('general.admin_emails')</span>
                            </div>
                            <input type="text" name="admin_emails" id="admin_emails"
                                class="form-control @error('admin_emails') is-invalid @enderror"
                                value="{{ old('admin_emails', $settings->admin_emails) }}" />
                            @error('admin_emails')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800">Cloudflare Captcha</h3>
                </div>
                <div class="p-6">
                    <div class="grid lg:grid-cols-3 gap-4">

                        <!----- Re-captcha -------------->
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="is_captcha" class="control-label">
                                    Captcha Active / De-Active
                                </label>
                                <span class="text-sm/6 text-gray-500"
                                    id="is-captcha-optional">setting('general.is_captcha')</span>
                            </div>
                            <select id="is_captcha" name="is_captcha" class="form-select">
                                <option value="0" @selected(old('is_captcha', $settings->is_captcha) == '0')>De-Active</option>
                                <option value="1" @selected(old('is_captcha', $settings->is_captcha) == '1')>Active</option>
                            </select>
                            @error('is_captcha')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="captcha_site_key" class="control-label">
                                    Captcha Site Key
                                </label>
                                <span class="text-sm/6 text-gray-500"
                                    id="captcha-site-key-optional">setting('general.captcha_site_key')</span>
                            </div>
                            <input type="text" name="captcha_site_key" id="captcha_site_key"
                                class="form-control @error('captcha_site_key') is-invalid @enderror"
                                value="{{ old('captcha_site_key', $settings->captcha_site_key) }}" />
                            @error('captcha_site_key')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="captcha_secret_key" class="control-label">
                                    Captcha Secret Key
                                </label>
                                <span class="text-sm/6 text-gray-500"
                                    id="captcha-secret-key-optional">setting('general.captcha_secret_key')</span>
                            </div>
                            <input type="text" name="captcha_secret_key" id="captcha_secret_key"
                                class="form-control @error('captcha_secret_key') is-invalid @enderror"
                                value="{{ old('captcha_secret_key', $settings->captcha_secret_key) }}" />
                            @error('captcha_secret_key')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800">Logo & Favicon</h3>
                </div>
                <div class="p-6">
                    <div class="grid md:grid-cols-2 gap-4">

                        <!----- Logo And Favicon -------------->
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="logo" class="control-label">
                                    Logo
                                </label>
                                <span class="text-sm/6 text-gray-500" id="logo-optional">getLogoURL()</span>
                            </div>
                            <input type="file" id="logo" name="logo" class="form-control">
                            @error('logo')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <label for="favicon" class="control-label">
                                    Favicon
                                </label>
                                <span class="text-sm/6 text-gray-500" id="favicon-optional">getFaviconURL()</span>
                            </div>
                            <input type="file" id="favicon" name="favicon" class="form-control">
                            @error('favicon')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 space-x-2">
                <button type="submit" class="btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</x-layouts.admin>
