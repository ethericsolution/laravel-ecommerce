<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [['url' => route('home'), 'text' => 'Home'], ['url' => '#', 'text' => 'Email Verification']],
            'title' => 'Email Verification',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <div class="bg-base-100 py-6 sm:py-10 lg:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="card shadow-none border max-w-xl mx-auto">
                <div class="card-body p-8 space-y-6 text-center">

                    <h2 class="text-2xl font-bold text-base-content">Email Verification</h2>

                    <p class="text-base-content/80">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </p>

                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <x-common.captcha />

                        <button type="submit" class="btn btn-primary btn-gradient">
                            {{ __('Resend Verification Email') }}
                        </button>
                    </form>

                    <form class="text-center mt-6" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-soft btn-primary">
                            {{ __('Back to login') }}
                            <span class="icon-[tabler--logout] text-lg"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layouts.front>
