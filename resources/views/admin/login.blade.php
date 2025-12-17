<!DOCTYPE html>
<html lang="en" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | {{ setting('general.site_name') }}</title>


    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- favicon --}}
    {{-- <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" /> --}}

    <link rel="icon" type="image/png" href="{{ getFaviconURL() }}" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full font-display">
    <x-admin.alert />
    <main class="flex min-h-[calc(100vh-4rem)] flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto" src="{{ getLogoURL() }}" alt="{{ asset('otc-logo.png') }}"
                loading="lazy" />
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('admin.login.post') }}" method="POST">
                @csrf

                <div class="space-y-1">
                    <label for="email" class="label-text">Email address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" autocomplete="email"
                        class="input @error('email') is-invalid @enderror" />
                    @error('email')
                        <span class="helper-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="password" class="label-text">Password</label>
                    <input type="password" name="password" id="password" autocomplete="current-password"
                        class="input @error('password') is-invalid @enderror">
                    @error('email')
                        <span class="helper-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center gap-2">
                    <input id="remember-me" name="remember" type="checkbox" class="checkbox checkbox-primary">
                    <label for="remember-me" class="label-text text-base-content/80 p-0 text-base">Remember me</label>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary w-full">Sign in</button>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="py-4 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ setting('general.app_name') }}. All rights reserved.
                <span class="block md:inline mt-1 md:mt-0">
                    Developed by
                    <a href="https://ethericsolution.com/" target="_blank" class="link link-hover link-primary">
                        Etheric Solution
                    </a>
                </span>
            </div>
        </div>
    </footer>
</body>

</html>
