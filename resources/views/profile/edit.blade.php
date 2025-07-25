<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Your Account'],
                ['url' => '#', 'text' => 'Account Details'],
            ],
            'title' => 'Account Details',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)


    <section class="xl:pb-20 pb-8 md:pb-12">
        <div class="container lg:flex px-3 md:px-5 xl:px-0 gap-6">

            <x-account.nav />

            <div class="w-full">
                <div class="my-10 overflow-hidden rounded-xl bg-white shadow-xs border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-xl/6 font-semibold text-gray-800">Account Details</h3>
                    </div>
                    <div class="p-6">
                        <form method="post" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <div class="grid md:grid-cols-2 gap-6">

                                <div class="space-y-2.5">
                                    <label for="first_name" class="control-label">
                                        First Name
                                    </label>
                                    <input type="text" id="first_name" name="first_name"
                                        value="{{ old('first_name', $user->first_name) }}"
                                        class="form-control @error('first_name') is-invalid @enderror" />
                                    @error('first_name')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-2.5">
                                    <label for="last_name" class="control-label">
                                        Last Name
                                    </label>
                                    <input type="text" id="last_name" name="last_name"
                                        value="{{ old('last_name', $user->last_name) }}"
                                        class="form-control @error('last_name') is-invalid @enderror" />
                                    @error('last_name')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>

                            <div class="grid md:grid-cols-2 gap-4 py-5">
                                <div class="space-y-2.5">
                                    <label for="email" class="control-label">
                                        Email
                                    </label>
                                    <input type="text" id="email" name="email"
                                        value="{{ old('email', $user->email) }}"
                                        class="form-control @error('email') is-invalid @enderror" />
                                    @error('email')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-2.5">
                                    <label for="phone" class="control-label">
                                        Phone
                                    </label>
                                    <input type="text" id="phone" name="phone"
                                        value="{{ old('phone', $user->phone) }}"
                                        class="form-control @error('phone') is-invalid @enderror" />
                                    @error('phone')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn-primary">Save Changes</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.front>
