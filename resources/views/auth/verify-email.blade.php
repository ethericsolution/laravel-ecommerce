<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [['url' => route('home'), 'text' => 'Home'], ['url' => '#', 'text' => 'Email Verification']],
            'title' => 'Email Verification',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <div class="container py-20">

        <div class="w-full lg:w-1/2 bg-white shadow-xs rounded-xl border border-gray-200 mx-auto p-8">
            <h2 class="text-center text-gray-800 xl:text-4xl text-xl font-bold mb-10">{{ __('Email Verification') }}</h2>

            <div class="mx-12">
                <p class="mb-6 text-gray-600 text-base/6 text-center">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="text-center text-green-400 mb-4">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif
            </div>

            <form method="POST" action="{{ route('verification.send') }}" class="space-y-6">
                @csrf

                <x-common.captcha />

                <button type="submit" class="btn-primary w-full gap-x-2">
                    {{ __('Resend Verification Email') }}
                    <i data-lucide="move-right" class="size-6"></i>
                </button>
            </form>

            <form class="text-center mt-6" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-primary-600 font-medium text-base leading-tight cursor-pointer">
                    {{ __('Back to login') }}
                    <i data-lucide="move-left" class="size-6"></i>
                </button>
            </form>
        </div>
    </div>

</x-layouts.front>
