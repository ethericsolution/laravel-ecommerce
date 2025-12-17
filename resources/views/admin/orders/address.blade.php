<div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-base-content text-lg font-medium">Address Information</h3>
    </div>
    <div class="p-6 space-y-6" x-data="addressInfo()">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="name" class="label-text">Address
                    Name</label>
                <input type="text" id="name" name="address[name]"
                    value="{{ old('address.name', $address?->name) }}"
                    class="input @error('address.name') is-invalid @enderror" />
                @error('address.name')
                    <span class="helper-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="country_id" class="label-text">Country</label>

                <select id="country_id" name="address[country_id]"
                    class="select @error('address.country_id') is-invalid @enderror" x-model="country_id"
                    x-init="countryChange()" @change="countryChange()">
                    <option value="">Select Country</option>
                    @foreach ($countries as $key => $country)
                        <option value="{{ $key }}" @selected(old('country_id', $address->country_id ?? setting('company.country')) == $key)>
                            {{ $country }}</option>
                    @endforeach
                </select>
                @error('address.country_id')
                    <span class="helper-text">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="contact_name" class="label-text">Full
                    Name</label>
                <input type="text" id="contact_name" name="address[contact_name]"
                    value="{{ old('address.contact_name', $address?->contact_name) }}"
                    class="input @error('address.contact_name') is-invalid @enderror" />
                @error('address.contact_name')
                    <span class="helper-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="phone" class="label-text">Phone</label>
                <input type="text" id="phone" name="address[phone]"
                    value="{{ old('address.phone', $address?->phone) }}"
                    class="input @error('address.phone') is-invalid @enderror" />
                @error('address.phone')
                    <span class="helper-text">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="address_line_1" class="label-text">Address
                    Line 1</label>
                <input type="text" id="address_line_1" name="address[address_line_1]"
                    value="{{ old('address.address_line_1', $address?->address_line_1) }}"
                    class="input @error('address.address_line_1') is-invalid @enderror"
                    placeholder="Street address or P.O. Box" />
                @error('address.address_line_1')
                    <span class="helper-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="address_line_2" class="label-text">Address
                    Line 2</label>
                <input type="text" id="address_line_2" name="address[address_line_2]"
                    value="{{ old('address.address_line_2', $address?->address_line_2) }}"
                    class="input @error('address.address_line_2') is-invalid @enderror"
                    placeholder="Apt,suite,unit,building,floor,etc." />
                @error('address.address_line_2')
                    <span class="helper-text">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="space-y-2">
                <label for="city" class="label-text">City</label>
                <input type="text" id="city" name="address[city]"
                    value="{{ old('address.city', $address?->city) }}"
                    class="input @error('address.city') is-invalid @enderror" />
                @error('address.city')
                    <span class="helper-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="state_id" class="label-text">State</label>
                <select x-model="state_id" id="state_id" name="address[state_id]"
                    class="select @error('address.state_id') is-invalid @enderror"
                    @change="$dispatch('state-changed', state_id)">
                    <option value="">Select State</option>
                    <template x-for="(state,key) in states" :key="state">
                        <option :value="state" x-text="key"></option>
                    </template>
                </select>
                @error('address.state_id')
                    <span class="helper-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="zip_code" class="label-text">Zip
                    Code</label>
                <input type="text" id="zip_code" name="address[zip_code]"
                    value="{{ old('address.zip_code', $address?->zip_code) }}"
                    class="input @error('address.zip_code') is-invalid @enderror" />
                @error('address.zip_code')
                    <span class="helper-text">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        var stateId = "{{ old('address.state_id', $address->state_id ?? setting('company.state')) }}";

        function addressInfo() {
            return {
                country_id: "{{ old('address.country_id', $address->country_id ?? setting('company.country')) }}",
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
                            /* console.log(this.states); */

                            if (stateId) {
                                this.state_id = stateId;
                                this.$dispatch('state-changed', stateId);
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
