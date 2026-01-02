<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [['url' => route('home'), 'text' => 'Home'], ['url' => '#', 'text' => 'Reset Password']],
            'title' => 'Reset Password',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <!-- Reset Password Form Start -->
    <div class="bg-base-100 py-6 sm:py-10 lg:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="card shadow-none border max-w-xl mx-auto">
                <div class="card-body p-8 space-y-4">

                    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="space-y-1 text-left">
                            <label class="label-text" for="email">Email address</label>
                            <input type="email" name="email" value="{{ old('email', $request->email) }}"
                                class="input @error('email') is-invalid @enderror" id="email" required />
                            @error('email')
                                <span class="helper-text text-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1 text-left">
                            <label class="label-text" for="password">{{ __('New Password') }}</label>
                            <div class="input @error('password') is-invalid @enderror">
                                <input id="password" type="password" name="password" autocomplete="new-password"
                                    required />
                                <button type="button" data-toggle-password='{ "target": "#password" }'
                                    class="block cursor-pointer" aria-label="password">
                                    <span
                                        class="icon-[tabler--eye] password-active:block hidden size-5 shrink-0"></span>
                                    <span
                                        class="icon-[tabler--eye-off] password-active:hidden block size-5 shrink-0"></span>
                                </button>
                            </div>

                            @error('password')
                                <span class="helper-text text-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1 text-left">
                            <label class="label-text"
                                for="password_confirmation">{{ __('Confirm New Password') }}</label>
                            <div class="input">
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    autocomplete="new-password" required />
                                <button type="button" data-toggle-password='{ "target": "#password_confirmation" }'
                                    class="block cursor-pointer" aria-label="password_confirmation">
                                    <span
                                        class="icon-[tabler--eye] password-active:block hidden size-5 shrink-0"></span>
                                    <span
                                        class="icon-[tabler--eye-off] password-active:hidden block size-5 shrink-0"></span>
                                </button>
                            </div>
                        </div>

                        <x-common.captcha />

                        <button type="submit" class="btn btn-primary btn-gradient btn-lg w-full">
                            {{ __('Reset Password') }}
                        </button>
                    </form>


                    <p class="font-normal text-base leading-tight text-base-content mt-6 text-center">
                        <a href="{{ route('login') }}" class="text-primary-600 font-medium text-base leading-tight">
                            {{ __('Back to login') }}</a>
                    </p>

                </div>
            </div>
        </div>
    </div>

</x-layouts.front>
