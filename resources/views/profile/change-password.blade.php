<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('account.dashboard'), 'text' => 'Your Account'],
                ['url' => '#', 'text' => 'Change Password'],
            ],
            'title' => 'Change Password',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <section class="xl:pb-20 pb-8 md:pb-12">
        <div class="container lg:flex px-3 md:px-5 xl:px-0 gap-6">

            <x-account.nav />

            <div class="w-full">
                <div class="my-10 overflow-hidden rounded-xl bg-white shadow-xs border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-xl/6 font-semibold text-gray-800">Change Password</h3>
                    </div>
                    <div class="p-6">

                        <form method="post" action="{{ route('password.update') }}" class="space-y-6 max-w-xl">
                            @csrf
                            @method('put')

                            <div class="space-y-2.5">
                                <label for="update_password_current_password" class="control-label">
                                    Current Password
                                </label>
                                <input type="password" id="update_password_current_password" name="current_password"
                                    class="form-control  @error('current_password', 'updatePassword') is-invalid @enderror" />
                                @error('current_password', 'updatePassword')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2.5">
                                <label for="update_password_password" class="control-label">
                                    New Password
                                </label>
                                <input type="password" id="update_password_password" name="password"
                                    class="form-control @error('password', 'updatePassword') is-invalid @enderror" />
                                @error('password', 'updatePassword')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2.5">
                                <label for="update_password_password_confirmation" class="control-label">
                                    Confirm Password
                                </label>
                                <input type="password" id="update_password_password_confirmation"
                                    name="password_confirmation"
                                    class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" />
                                @error('password_confirmation', 'updatePassword')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.front>
