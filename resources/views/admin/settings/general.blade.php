<x-layouts.admin>


    <div class="max-w-7xl mx-auto space-y-6">
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


        <form method="post" action="{{ route('admin.settings.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <input type="hidden" name="group_name" value="general" />
            <div class="card">
                <div class="card-header">
                    <h3 class="text-base-content text-lg font-medium">App Settings</h3>
                </div>
                <div class="card-body">
                    <div class="grid lg:grid-cols-3 gap-4">
                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="app_name" class="label-text">App Name</label>
                                <span class="helper-text" id="app-name-optional">setting('general.app_name')</span>
                            </div>
                            <input type="text" name="app_name" id="app_name"
                                class="input @error('app_name') is-invalid @enderror"
                                value="{{ old('app_name', $settings->app_name) }}"
                                aria-describedby="app-name-optional" />
                            @error('app_name')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="site_name" class="label-text">Site Name</label>
                                <span class="helper-text" id="site-name-optional">setting('general.site_name')</span>
                            </div>
                            <input type="text" name="site_name" id="site_name"
                                class="input @error('site_name') is-invalid @enderror"
                                value="{{ old('site_name', $settings->site_name) }}" />
                            @error('site_name')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="tagline" class="label-text">Tagline</label>
                                <span class="helper-text" id="tagline-optional">setting('general.tagline')</span>
                            </div>
                            <input type="text" name="tagline" id="tagline"
                                class="input @error('tagline') is-invalid @enderror"
                                value="{{ old('tagline', $settings->tagline) }}" />
                            @error('tagline')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1 col-span-full">
                            <div class="flex justify-between">
                                <label for="site_description" class="label-text">Site Description</label>
                                <span class="helper-text"
                                    id="site-description-optional">setting('general.site_description')</span>
                            </div>
                            <textarea class="textarea @error('site_description') is-invalid @enderror" id="site_description" name="site_description"
                                rows="2">{{ old('site_description', $settings->site_description) }}</textarea>
                            @error('site_description')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="date_format" class="label-text">
                                    Date Format
                                </label>
                                <span class="helper-text"
                                    id="date-format-optional">setting('general.date_format')</span>
                            </div>
                            <select id="date_format" name="date_format"
                                class="select @error('date_format') is-invalid @enderror">
                                <option value="">Select Date Format</option>
                                @foreach ($dateFormats as $key => $dateFormat)
                                    <option value="{{ $key }}" @selected(old('date_format', $settings->date_format) == $key)>
                                        ({{ $key }})
                                        {{ $dateFormat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('date_format')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="time_format" class="label-text">
                                    Time Format
                                </label>
                                <span class="helper-text"
                                    id="time-format-optional">setting('general.time_format')</span>
                            </div>
                            <select id="time_format" name="time_format"
                                class="select @error('time_format') is-invalid @enderror">
                                <option value="">Select Time Format</option>
                                @foreach ($timeFormats as $key => $timeFormat)
                                    <option value="{{ $key }}" @selected(old('time_format', $settings->time_format) == $key)>
                                        ({{ $key }})
                                        {{ $timeFormat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('time_format')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="timezone" class="label-text">
                                    Time Zone
                                </label>
                                <span class="helper-text" id="time-zone-optional">setting('general.timezone')</span>
                            </div>
                            <select id="timezone" name="timezone"
                                class="select @error('timezone') is-invalid @enderror">
                                <option value="">Select Time Zone</option>
                                @foreach ($timezones as $key => $timezone)
                                    <option value="{{ $timezone }}" @selected(old('timezone', $settings->timezone) == $timezone)>
                                        {{ $timezone }}
                                    </option>
                                @endforeach
                            </select>
                            @error('timezone')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="analytics_code" class="label-text">Google Analytics Code</label>
                                <span class="helper-text"
                                    id="analytics_code-optional">setting('general.analytics_code')</span>
                            </div>
                            <input type="text" name="analytics_code" id="analytics_code"
                                class="input @error('analytics_code') is-invalid @enderror"
                                value="{{ old('analytics_code', $settings->analytics_code) }}" />
                            @error('analytics_code')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- is_tax_inclusive --}}
                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="is_tax_inclusive" class="label-text">
                                    Is Tax Inclusive
                                </label>
                                <span class="helper-text"
                                    id="is-tax-inclusive-optional">setting('general.is_tax_inclusive')</span>
                            </div>
                            <select id="is_tax_inclusive" name="is_tax_inclusive" class="select">
                                <option value="0" @selected(old('is_tax_inclusive', $settings->is_tax_inclusive) == '0')>Exclusive</option>
                                <option value="1" @selected(old('is_tax_inclusive', $settings->is_tax_inclusive) == '1')>Inclusive</option>
                            </select>
                            @error('is_tax_inclusive')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="delivery_charge" class="label-text">Delivery Charge</label>
                                <span class="helper-text"
                                    id="delivery_charge-optional">setting('general.delivery_charge')</span>
                            </div>
                            <input type="number" name="delivery_charge" id="delivery_charge"
                                class="input @error('delivery_charge') is-invalid @enderror"
                                value="{{ old('delivery_charge', $settings->delivery_charge) }}" />
                            @error('delivery_charge')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1 col-span-full">
                            <div class="flex justify-between">
                                <label for="free_delivery_zipcode" class="label-text">Free Delivery
                                    Zipcode</label>
                                <span class="helper-text"
                                    id="site-description-optional">setting('general.free_delivery_zipcode')</span>
                            </div>
                            <textarea class="textarea @error('free_delivery_zipcode') is-invalid @enderror" id="free_delivery_zipcode"
                                name="free_delivery_zipcode" rows="2">{{ old('free_delivery_zipcode', $settings->free_delivery_zipcode) }}</textarea>
                            @error('free_delivery_zipcode')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1 col-span-full">
                            <div class="flex justify-between">
                                <label for="admin_emails" class="label-text">
                                    Admin Emails (use , for multiple)
                                </label>
                                <span class="helper-text"
                                    id="site-description-optional">setting('general.admin_emails')</span>
                            </div>
                            <input type="text" name="admin_emails" id="admin_emails"
                                class="input @error('admin_emails') is-invalid @enderror"
                                value="{{ old('admin_emails', $settings->admin_emails) }}" />
                            @error('admin_emails')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="text-base-content text-lg font-medium">Cloudflare Captcha</h3>
                </div>
                <div class="card-body">
                    <div class="grid lg:grid-cols-3 gap-4">

                        <!----- Re-captcha -------------->
                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="is_captcha" class="label-text">
                                    Captcha Active / De-Active
                                </label>
                                <span class="helper-text"
                                    id="is-captcha-optional">setting('general.is_captcha')</span>
                            </div>
                            <select id="is_captcha" name="is_captcha" class="select">
                                <option value="0" @selected(old('is_captcha', $settings->is_captcha) == '0')>De-Active</option>
                                <option value="1" @selected(old('is_captcha', $settings->is_captcha) == '1')>Active</option>
                            </select>
                            @error('is_captcha')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="captcha_site_key" class="label-text">
                                    Captcha Site Key
                                </label>
                                <span class="helper-text"
                                    id="captcha-site-key-optional">setting('general.captcha_site_key')</span>
                            </div>
                            <input type="text" name="captcha_site_key" id="captcha_site_key"
                                class="input @error('captcha_site_key') is-invalid @enderror"
                                value="{{ old('captcha_site_key', $settings->captcha_site_key) }}" />
                            @error('captcha_site_key')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="captcha_secret_key" class="label-text">
                                    Captcha Secret Key
                                </label>
                                <span class="helper-text"
                                    id="captcha-secret-key-optional">setting('general.captcha_secret_key')</span>
                            </div>
                            <input type="text" name="captcha_secret_key" id="captcha_secret_key"
                                class="input @error('captcha_secret_key') is-invalid @enderror"
                                value="{{ old('captcha_secret_key', $settings->captcha_secret_key) }}" />
                            @error('captcha_secret_key')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="text-base-content text-lg font-medium">Logo & Favicon</h3>
                </div>
                <div class="card-body">
                    <div class="grid md:grid-cols-2 gap-4">

                        <!----- Logo And Favicon -------------->
                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="logo" class="label-text">
                                    Logo
                                </label>
                                <span class="helper-text" id="logo-optional">getLogoURL()</span>
                            </div>
                            <input type="file" id="logo" name="logo" class="input">
                            @error('logo')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="favicon" class="label-text">
                                    Favicon
                                </label>
                                <span class="helper-text" id="favicon-optional">getFaviconURL()</span>
                            </div>
                            <input type="file" id="favicon" name="favicon" class="input">
                            @error('favicon')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 space-x-2">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</x-layouts.admin>
