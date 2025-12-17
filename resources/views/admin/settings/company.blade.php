<x-layouts.admin>
    <div class="max-w-7xl mx-auto space-y-6">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.settings.company'),
                    'text' => 'Company Settings',
                ],
            ];

            $title = 'Company Settings';

        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title />


        <form method="post" action="{{ route('admin.settings.store') }}">
            @csrf

            <input type="hidden" name="group_name" value="company" />
            <div class="card mb-6">
                <div class="card-body" x-data="companyAddressInfo()">
                    <div class="grid md:grid-cols-2 gap-4">

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="name" class="label-text">Name</label>
                                <span class="helper-text" id="name-optional">setting('company.name')</span>
                            </div>
                            <input type="text" name="name" id="name"
                                class="input @error('name') is-invalid @enderror"
                                value="{{ old('name', $settings->name) }}" />
                            @error('name')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="email" class="label-text">Email</label>
                                <span class="helper-text" id="email-optional">setting('company.email')</span>
                            </div>
                            <input type="text" name="email" id="email"
                                class="input @error('email') is-invalid @enderror"
                                value="{{ old('email', $settings->email) }}" />
                            @error('email')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="phone" class="label-text">Phone</label>
                                <span class="helper-text" id="phone-optional">setting('company.phone')</span>
                            </div>
                            <input type="text" name="phone" id="phone"
                                class="input @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $settings->phone) }}" />
                            @error('phone')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="website" class="label-text">Website</label>
                                <span class="helper-text" id="website-optional">setting('company.website')</span>
                            </div>
                            <input type="text" name="website" id="website"
                                class="input @error('website') is-invalid @enderror"
                                value="{{ old('website', $settings->website) }}" />
                            @error('website')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1 col-span-full">
                            <div class="flex justify-between">
                                <label for="address" class="label-text">Address</label>
                                <span class="helper-text" id="address-optional">setting('company.address')</span>
                            </div>
                            <textarea class="textarea @error('address') is-invalid @enderror" id="address" name="address" rows="2">{{ old('address', $settings->address) }}</textarea>
                            @error('address')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="country" class="label-text">Country</label>
                                <span class="helper-text" id="country-optional">setting('company.country')</span>
                            </div>
                            <select id="country" name="country" class="select @error('country') is-invalid @enderror"
                                x-model="country" x-init="countryChange()" @change="countryChange()">
                                <option value="">Select Country</option>
                                @foreach ($countries as $key => $country)
                                    <option value="{{ $key }}" @selected(old('country', $address->country_id ?? 233) == $key)>
                                        {{ $country }}</option>
                                @endforeach
                            </select>
                            @error('country')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="state" class="label-text">State</label>
                                <span class="helper-text" id="state-optional">setting('company.state')</span>
                            </div>
                            <select x-model="state" id="state" name="state"
                                class="select @error('state') is-invalid @enderror">
                                <option value="">Select State</option>
                                <template x-for="(state,key) in states" :key="state">
                                    <option :value="state" x-text="key"></option>
                                </template>
                            </select>
                            @error('state')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="city" class="label-text">City</label>
                                <span class="helper-text" id="city-optional">setting('company.city')</span>
                            </div>
                            <input type="text" name="city" id="city"
                                class="input @error('city') is-invalid @enderror"
                                value="{{ old('city', $settings->city) }}" />
                            @error('city')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="zipcode" class="label-text">Zipcode</label>
                                <span class="helper-text" id="zipcode-optional">setting('company.zipcode')</span>
                            </div>
                            <input type="text" name="zipcode" id="zipcode"
                                class="input @error('zipcode') is-invalid @enderror"
                                value="{{ old('zipcode', $settings->zipcode) }}" />
                            @error('zipcode')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>


    @push('scripts')
        <script>
            var stateId = "{{ old('state', $settings->state) }}";

            function companyAddressInfo() {
                return {
                    country: "{{ old('country', $settings->country) }}",
                    state: "",
                    states: [],

                    async countryChange() {

                        if (this.country) {
                            try {
                                const response = await axios.post("{{ route('fetchState') }}", {
                                    country_id: this.country,
                                    _token: document.querySelector('meta[name="csrf-token"]').getAttribute(
                                        'content')
                                });

                                this.states = response.data;

                                if (stateId) {
                                    this.state = stateId;
                                }

                            } catch (error) {
                                console.error('Error fetching countries:', error);
                            }
                        }
                    }
                };
            }
        </script>
    @endpush
</x-layouts.admin>
