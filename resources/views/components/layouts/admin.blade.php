<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? setting('general.site_name') }}</title>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&ampdisplay=swap"
        rel="stylesheet" />

    {{-- favicon --}}
    {{-- <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" /> --}}

    <link rel="icon" type="image/png" href="{{ getFaviconURL() }}" />

    @vite('resources/css/app.css')
</head>

<body>
    <x-admin.alert />

    <div class="bg-base-200 flex min-h-screen flex-col">
        <x-admin.topnav />

        <x-admin.sidenav />
        <div class="flex grow flex-col lg:ps-75">
            <!-- ---------- MAIN CONTENT ---------- -->
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
            <!-- ---------- END MAIN CONTENT ---------- -->

            <!-- ---------- FOOTER CONTENT ---------- -->
            <footer class="bg-base-100">
                <div class="mx-auto h-14 w-full px-6 flex items-center">
                    <p> &copy; {{ date('Y') }} {{ setting('general.app_name') }}. All rights reserved. | Developed
                        by
                        <a href="https://ethericsolution.com/" target="_blank" class="link link-primary link-hover">
                            Etheric Solution
                        </a>
                    </p>
                </div>
            </footer>
            <!-- ---------- END FOOTER CONTENT ---------- -->
        </div>
    </div>

    @vite('resources/js/app.js')

    @stack('scripts')
</body>

</html>
