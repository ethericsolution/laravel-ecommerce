<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 my-10">
    <div class="col-span-1">
        <a href="{{ route('account.addresses.create') }}"
            class="card card-border h-full hover:border-primary transition-border shadow-none duration-300">
            <div class="card-body items-center justify-center">
                <span class="icon-[tabler--circle-plus] mb-2 size-8"></span>
                <span>Add Address</span>
            </div>
        </a>
    </div>

    @foreach ($addresses as $address)
        <div class="col-span-1">
            <div class="card card-border h-full hover:border-primary transition-border shadow-none duration-300">
                <div class="card-header">
                    <h3 class="text-base-content text-lg font-medium">{{ $address?->name }} @if ($address?->is_default)
                            <span class="text-primary">(Default)</span>
                        @endif
                    </h3>
                </div>
                <div class="card-body">
                    <p>
                        {{ $address?->contact_name }}<br>
                        {{ $address?->address_line_1 }} , {{ $address?->address_line_2 }}
                        {{ $address?->city }}
                        <br>{{ $address?->state?->iso2 }},
                        {{ $address?->country?->iso2 }} -
                        {{ $address?->zip_code }}<br>
                        Phone : {{ $address?->phone }}
                    </p>
                    <div class="flex space-x-2 mt-4">
                        <a class="link link-animated link-primary"
                            href="{{ route('account.addresses.edit', $address) }}">Edit</a>

                        <form action="{{ route('account.addresses.destroy', $address) }}" method="POST"
                            onsubmit="return confirm('Are you sure want to delete?')">
                            @csrf
                            @method('DELETE')

                            <button class="link link-animated link-error"
                                href="{{ route('account.addresses.edit', $address) }}">Delete</button>
                        </form>
                        @if (!$address?->is_default)
                            <a class="link link-animated"
                                href="{{ route('account.addresses.setDefault', $address) }}">Set as
                                Default
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
