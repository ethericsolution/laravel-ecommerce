<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [['url' => route('home'), 'text' => 'Home'], ['url' => '#', 'text' => 'Sign In']],
            'title' => 'Sign In',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <div class="bg-base-100 py-6 sm:py-10 lg:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="card shadow-none border max-w-xl mx-auto">
                <div class="card-body p-8 space-y-4">
                    <form class="mb-4 space-y-4" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="space-y-1">
                            <label class="label-text" for="email">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="input @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" autocomplete="email" autofocus />

                            @error('email')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="label-text" for="password">{{ __('Password') }}</label>
                            <div class="input @error('password') is-invalid @enderror">
                                <input id="password" type="password" name="password" autocomplete="current-password" />
                                <button type="button" data-toggle-password='{ "target": "#password" }'
                                    class="block cursor-pointer" aria-label="password">
                                    <span
                                        class="icon-[tabler--eye] password-active:block hidden size-5 shrink-0"></span>
                                    <span
                                        class="icon-[tabler--eye-off] password-active:hidden block size-5 shrink-0"></span>
                                </button>
                            </div>

                            @error('password')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between gap-y-2">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" class="checkbox checkbox-primary" id="remember" name="remember"
                                    {{ old('remember') ? 'checked' : '' }} />
                                <label class="label-text text-base-content/80 p-0 text-base"
                                    for="remember">{{ __('Remember Me') }}</label>
                            </div>
                            <a href="{{ route('password.request') }}"
                                class="link link-animated link-primary font-normal">{{ __('Forgot Password?') }}</a>
                        </div>

                        <x-common.captcha />

                        <button class="btn btn-lg btn-primary btn-gradient btn-block">{{ __('Sign In') }}</button>
                    </form>
                    @if (Route::has('register'))
                        <p class="text-base-content/80 mb-4 text-center">
                            Don't have account?
                            <a href="{{ route('register') }}" class="link link-animated link-primary font-normal">
                                {{ __('Sign Up') }}</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.front>
