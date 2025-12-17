<form action="{{ $address->id ? route('account.addresses.update', $address) : route('account.addresses.store') }}"
    method="POST" class="space-y-6" x-data="addressInfo()">
    @csrf

    @isset($address->id)
        @method('put')
    @endisset

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-1">
            <label for="name" class="label-text">Address Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $address->name) }}"
                class="input @error('name') is-invalid @enderror" />
            @error('name')
                <span class="helper-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="country_id" class="label-text">Country</label>
            <select id="country_id" name="country_id" class="select @error('country_id') is-invalid @enderror"
                x-model="country_id" x-init="countryChange()" @change="countryChange()">
                <option value="">Select Country</option>
                @foreach ($countries as $key => $country)
                    <option value="{{ $key }}" @selected(old('country_id', $address->country_id ?? 233) == $key)>
                        {{ $country }}</option>
                @endforeach
            </select>
            @error('country_id')
                <span class="helper-text">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-1">
            <label for="contact_name" class="label-text">Full
                Name</label>
            <input type="text" id="contact_name" name="contact_name"
                value="{{ old('contact_name', $address->contact_name ?? auth()->user()->name) }}"
                class="input @error('contact_name') is-invalid @enderror" />
            @error('contact_name')
                <span class="helper-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="phone" class="label-text">Phone</label>
            <input type="text" id="phone" name="phone"
                value="{{ old('phone', $address->phone ?? auth()->user()->phone) }}"
                class="input @error('phone') is-invalid @enderror" />
            @error('phone')
                <span class="helper-text">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-1">
            <label for="address_line_1" class="label-text">Address
                Line 1</label>
            <input type="text" id="address_line_1" name="address_line_1"
                value="{{ old('address_line_1', $address->address_line_1) }}"
                class="input @error('address_line_1') is-invalid @enderror" placeholder="Street address or P.O. Box" />
            @error('address_line_1')
                <span class="helper-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="address_line_2" class="label-text">Address
                Line 2</label>
            <input type="text" id="address_line_2" name="address_line_2"
                value="{{ old('address_line_2', $address->address_line_2) }}"
                class="input @error('address_line_2') is-invalid @enderror"
                placeholder="Apt,suite,unit,building,floor,etc." />
            @error('address_line_2')
                <span class="helper-text">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="space-y-1">
            <label for="city" class="label-text">City</label>
            <input type="text" id="city" name="city" value="{{ old('city', $address->city) }}"
                class="input @error('city') is-invalid @enderror" />
            @error('city')
                <span class="helper-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="state_id" class="label-text">State</label>
            <select x-model="state_id" id="state_id" name="state_id"
                class="select @error('state_id') is-invalid @enderror">
                <option value="">Select State</option>
                <template x-for="(state,key) in states" :key="state">
                    <option :value="state" x-text="key"></option>
                </template>
            </select>
            @error('state_id')
                <span class="helper-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="zip_code" class="label-text">Zip
                Code</label>
            <input type="text" id="zip_code" name="zip_code" value="{{ old('zip_code', $address->zip_code) }}"
                class="input @error('zip_code') is-invalid @enderror" />
            @error('zip_code')
                <span class="helper-text">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <input type="hidden" name="is_default" value="0" />
    <div class="flex items-center gap-2">
        <input id="is_default" name="is_default" type="checkbox" class="checkbox checkbox-primary" value="1"
            @checked(old('is_default', $address->is_default)) />
        <label for="is_default"
            class="label-text text-base-content/80 p-0 text-base">{{ __('Default Address') }}</label>
    </div>

    <button type="submit" class="btn btn-primary">Save Address</button>
</form>

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
