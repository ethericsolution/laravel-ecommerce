<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Your Account'],
                ['url' => '#', 'text' => 'Your Addresses'],
            ],
            'title' => 'Your Addresses',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)


    <section class="xl:pb-20 pb-8 md:pb-12">
        <div class="container lg:flex px-3 md:px-5 xl:px-0 gap-6">

            <x-account.nav />

            <div class="w-full">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 my-10">
                    <div class="col-span-1">
                        <a href="{{ route('account.addresses.create') }}"
                            class="relative w-full h-full inline-grid items-center rounded-lg border-2 border-dashed border-gray-300 p-12 text-center hover:border-gray-400 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 focus:outline-hidden">
                            <div class="text-center">
                                <i data-lucide="plus" class="mx-auto size-12 text-gray-400"></i>
                                <span class="mt-4 block text-2xl/tight font-bold text-gray-800">Add Address</span>
                            </div>
                        </a>
                    </div>

                    @foreach ($addresses as $address)
                        <div class="col-span-1">
                            <div class="overflow-hidden rounded-xl bg-white shadow-xs border border-gray-200">
                                <div class="p-6 border-b border-gray-200">
                                    <h3 class="text-xl/6 font-semibold text-gray-800">{{ $address?->name }} @if ($address?->is_default)
                                            <span class="text-primary-600">(Default)</span>
                                        @endif
                                    </h3>
                                </div>
                                <div class="p-6">
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
                                        <a class="text-primary-600 hover:text-primary-700"
                                            href="{{ route('account.addresses.edit', $address) }}">Edit</a>

                                        <form action="{{ route('account.addresses.destroy', $address) }}"
                                            method="POST" onsubmit="return confirm('Are you sure want to delete?')">
                                            @csrf
                                            @method('DELETE')

                                            <button class="text-red-600 hover:text-red-700 cursor-pointer"
                                                href="{{ route('account.addresses.edit', $address) }}">Delete</button>
                                        </form>
                                        @if (!$address?->is_default)
                                            <a class="text-gray-600 hover:text-gray-700"
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
            </div>
        </div>
    </section>
</x-layouts.front>
