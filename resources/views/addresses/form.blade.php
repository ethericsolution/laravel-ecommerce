<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Your Account'],
                ['url' => route('account.addresses.index'), 'text' => 'Your Addresses'],
                ['url' => '#', 'text' => $address->id ? 'Edit ' . $address->name : 'Add new Address'],
            ],
            'title' => $address->id ? 'Edit ' . $address->name : 'Add new Address',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)


    <section class="xl:pb-20 pb-8 md:pb-12">
        <div class="container lg:flex px-3 md:px-5 xl:px-0 gap-6">

            <x-account.nav />

            <div class="w-full">
                <div class="my-10 overflow-hidden rounded-xl bg-white shadow-xs border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-xl/6 font-semibold text-gray-800">Address Information</h3>
                    </div>
                    <div class="p-6">
                        <form
                            action="{{ $address->id ? route('account.addresses.update', $address) : route('account.addresses.store') }}"
                            method="POST" class="space-y-6" x-data="addressInfo()">
                            @csrf

                            @isset($address->id)
                                @method('put')
                            @endisset

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2.5">
                                    <label for="name" class="control-label">Address
                                        Name</label>
                                    <input type="text" id="name" name="name"
                                        value="{{ old('name', $address->name) }}"
                                        class="form-control @error('name') is-invalid @enderror" />
                                    @error('name')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-2.5">
                                    <label for="country_id" class="control-label">Country</label>
                                    <select id="country_id" name="country_id"
                                        class="form-select @error('country_id') is-invalid @enderror"
                                        x-model="country_id" x-init="countryChange()" @change="countryChange()">
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $key => $country)
                                            <option value="{{ $key }}" @selected(old('country_id', $address->country_id ?? 233) == $key)>
                                                {{ $country }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2.5">
                                    <label for="contact_name" class="control-label">Full
                                        Name</label>
                                    <input type="text" id="contact_name" name="contact_name"
                                        value="{{ old('contact_name', $address->contact_name ?? auth()->user()->name) }}"
                                        class="form-control @error('contact_name') is-invalid @enderror" />
                                    @error('contact_name')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-2.5">
                                    <label for="phone" class="control-label">Phone</label>
                                    <input type="text" id="phone" name="phone"
                                        value="{{ old('phone', $address->phone ?? auth()->user()->phone) }}"
                                        class="form-control @error('phone') is-invalid @enderror" />
                                    @error('phone')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2.5">
                                    <label for="address_line_1" class="control-label">Address
                                        Line 1</label>
                                    <input type="text" id="address_line_1" name="address_line_1"
                                        value="{{ old('address_line_1', $address->address_line_1) }}"
                                        class="form-control @error('address_line_1') is-invalid @enderror"
                                        placeholder="Street address or P.O. Box" />
                                    @error('address_line_1')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-2.5">
                                    <label for="address_line_2" class="control-label">Address
                                        Line 2</label>
                                    <input type="text" id="address_line_2" name="address_line_2"
                                        value="{{ old('address_line_2', $address->address_line_2) }}"
                                        class="form-control @error('address_line_2') is-invalid @enderror"
                                        placeholder="Apt,suite,unit,building,floor,etc." />
                                    @error('address_line_2')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div class="space-y-2.5">
                                    <label for="city" class="control-label">City</label>
                                    <input type="text" id="city" name="city"
                                        value="{{ old('city', $address->city) }}"
                                        class="form-control @error('city') is-invalid @enderror" />
                                    @error('city')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-2.5">
                                    <label for="state_id" class="control-label">State</label>
                                    <select x-model="state_id" id="state_id" name="state_id"
                                        class="form-select @error('state_id') is-invalid @enderror">
                                        <option value="">Select State</option>
                                        <template x-for="(state,key) in states" :key="state">
                                            <option :value="state" x-text="key"></option>
                                        </template>
                                    </select>
                                    @error('state_id')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-2.5">
                                    <label for="zip_code" class="control-label">Zip
                                        Code</label>
                                    <input type="text" id="zip_code" name="zip_code"
                                        value="{{ old('zip_code', $address->zip_code) }}"
                                        class="form-control @error('zip_code') is-invalid @enderror" />
                                    @error('zip_code')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <input type="hidden" name="is_default" value="0" />
                            <div class="flex gap-3 items-center">
                                <input id="is_default" name="is_default" type="checkbox" class="form-checkbox"
                                    value="1" @checked(old('is_default', $address->is_default)) />
                                <label for="is_default" class="control-label">Default
                                    Address</label>
                            </div>

                            <button type="submit" class="btn-primary">Save Address</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            var stateId = "{{ old('state_id', $address->state_id ?? setting('company.state')) }}";

            function addressInfo() {
                return {
                    country_id: "{{ old('country_id', $address->country_id ?? setting('company.country')) }}",
                    state_id: "",
                    states: [],

                    async countryChange() {

                        if (this.country_id) {
                            try {
                                const response = await axios.post("{{ route('fetchState') }}", {
                                    country_id: this.country_id,
                                    _token: document.querySelector('meta[name="csrf-token"]').getAttribute(
                                        'content')
                                });

                                this.states = response.data;

                                if (stateId) {
                                    this.state_id = stateId;
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
</x-layouts.front>
