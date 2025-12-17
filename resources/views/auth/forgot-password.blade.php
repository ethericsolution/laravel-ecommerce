<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [['url' => route('home'), 'text' => 'Home'], ['url' => '#', 'text' => 'Forget Password']],
            'title' => 'Forget Password',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <!-- Forget Password Form Start -->
    <div class="bg-base-100 py-6 sm:py-10 lg:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="card shadow-none border max-w-xl mx-auto">

                <div class="card-body p-8 space-y-6 text-center">
                    <p class="text-base-content/80">
                        Enter your email address and we'll send you a link to reset your password.
                    </p>

                    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                        @csrf
                        <div class="space-y-1 text-left">
                            <label class="label-text" for="email">Email address</label>
                            <input type="email" name="email" value="{{ old('email') }}" id="email"
                                class="input @error('email') is-invalid @enderror" required />
                            @error('email')
                                <span class="helper-text text-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <x-common.captcha />

                        <button type="submit" class="btn btn-primary btn-gradient btn-lg w-full">
                            Send Reset Link
                        </button>
                    </form>

                    <p class="text-base-content/80 text-center">
                        Remember your password?
                        <a href="{{ route('login') }}" class="link link-animated link-primary font-normal">
                            Back to login
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</x-layouts.front>
