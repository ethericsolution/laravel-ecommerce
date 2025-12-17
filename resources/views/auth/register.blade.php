<x-layouts.front>
    @php
        $breadcrumbs = [
            'links' => [['url' => route('home'), 'text' => 'Home'], ['url' => '#', 'text' => 'Sign Up']],
            'title' => 'Sign Up',
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <div class="bg-base-100 py-6 sm:py-10 lg:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="card shadow-none border max-w-xl mx-auto">
                <div class="card-body p-8 space-y-4">

                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- First Name -->
                            <div class="space-y-1">
                                <label class="label-text" for="first_name">First Name</label>
                                <input type="text" id="first_name" name="first_name"
                                    class="input @error('first_name') is-invalid @enderror"
                                    value="{{ old('first_name') }}" autocomplete="given-name" />
                                @error('first_name')
                                    <span class="helper-text text-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div class="space-y-1">
                                <label class="label-text" for="last_name">Last Name</label>
                                <input type="text" id="last_name" name="last_name"
                                    class="input @error('last_name') is-invalid @enderror"
                                    value="{{ old('last_name') }}" autocomplete="family-name" />
                                @error('last_name')
                                    <span class="helper-text text-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="space-y-1">
                            <label class="label-text" for="email">Email Address</label>
                            <input id="email" type="email" name="email"
                                class="input @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                autocomplete="email" />
                            @error('email')
                                <span class="helper-text text-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Phone Number -->
                        <div class="space-y-1">
                            <label class="label-text" for="phone">Phone Number</label>
                            <input type="text" name="phone" class="input @error('phone') is-invalid @enderror"
                                id="phone" value="{{ old('phone') }}" autocomplete="tel" />
                            @error('phone')
                                <span class="helper-text text-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="space-y-1">
                            <label class="label-text" for="password">Password</label>
                            <div class="input @error('password') is-invalid @enderror">
                                <input id="password" type="password" name="password" autocomplete="new-password" />
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

                        <!-- Confirm Password -->
                        <div class="space-y-1">
                            <label class="label-text" for="password_confirmation">Confirm Password</label>
                            <div class="input">
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    autocomplete="new-password" />
                                <button type="button" data-toggle-password='{ "target": "#password_confirmation" }'
                                    class="block cursor-pointer" aria-label="password">
                                    <span
                                        class="icon-[tabler--eye] password-active:block hidden size-5 shrink-0"></span>
                                    <span
                                        class="icon-[tabler--eye-off] password-active:hidden block size-5 shrink-0"></span>
                                </button>
                            </div>
                        </div>

                        <x-common.captcha />

                        <div>
                            <button type="submit" class="btn btn-lg btn-primary btn-gradient btn-block">
                                Sign Up
                            </button>
                            <p class="text-muted text-sm">By Clicking I am agree with Terms &
                                Conditions
                            </p>
                        </div>
                    </form>


                    <p class="text-base-content/80 mb-4 text-center">
                        Already have an account?
                        <a href="{{ route('login') }}" class="link link-animated link-primary font-normal">
                            Sign in instead</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign Up Form End -->

</x-layouts.front>
