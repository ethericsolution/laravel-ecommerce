@php

    $categories = App\Models\Category::take(6)->get(['id', 'slug', 'name']);

    $categoryLink = [];

    foreach ($categories as $key => $category) {
        array_push($categoryLink, ['link' => route('products.byCategory', $category), 'title' => $category->name]);
    }

    $links = [
        // ['link' => route('home'), 'title' => 'Home'],
        // ['link' => route('about'), 'title' => 'About Us'],
        ...$categoryLink,
        // ['link' => route('whiteLabel'), 'title' => 'White Labelling'],
        // ['link' => route('contact'), 'title' => 'Contact Us'],
    ];
@endphp

<!-- header area start -->
<header class="sticky top-0 z-40">
    <div class="bg-white/95 backdrop-blur-sm border-b border-accent-200/50 shadow-md">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="flex justify-between items-center gap-4 py-4">
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="block">
                        <img class="h-14" src="{{ getLogoURL() }}" alt="{{ setting('general.app_name') }}"
                            loading="lazy" />
                    </a>
                </div>
                <form action="{{ route('search.store') }}" method="POST" class="lg:max-w-80 lg:block hidden w-full">
                    @csrf
                    <div class="relative group">
                        <input type="text" name="query"
                            class="w-full h-11 pr-4 pl-12 rounded-xl border border-accent-200 bg-accent-50/30 focus:border-primary-400 focus:ring-2 focus:ring-primary-200 focus:bg-white transition-all duration-300 placeholder:text-accent-400"
                            placeholder="Search products...">

                        <i data-lucide="search"
                            class="absolute left-4 top-1/2 -translate-y-1/2 size-5 text-accent-400 group-hover:text-primary-400 transition-colors duration-300"></i>
                    </div>
                </form>
                <div class="lg:block hidden">
                    <div class="flex items-center gap-x-3">
                        <a href="{{ route('account.cart') }}"
                            class="relative p-2 rounded-xl text-accent-700 hover:bg-accent-100 hover:text-primary-500 transition-all duration-300 group">
                            <i data-lucide="shopping-cart" class="size-6"></i>
                            @if (cartCount() > 0)
                                <span
                                    class="absolute -top-1 -right-1 bg-primary-500 text-white text-xs rounded-full px-2 py-0.5 font-medium min-w-[20px] text-center group-hover:scale-110 transition-transform duration-300">
                                    {{ cartCount() }}
                                </span>
                            @endif
                        </a>

                        <a href="{{ route('account.wishlist') }}"
                            class="p-2 rounded-xl text-accent-700 hover:bg-accent-100 hover:text-primary-500 transition-all duration-300"
                            aria-label="Wishlist">
                            <i data-lucide="heart" class="size-6"></i>
                        </a>

                        @auth
                            <a href="{{ route('account.dashboard') }}"
                                class="p-2 rounded-xl text-accent-700 hover:bg-accent-100 hover:text-primary-500 transition-all duration-300"
                                aria-label="Your Account">
                                <i data-lucide="user-circle" class="size-6"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="btn-secondary text-sm gap-2 px-5 py-2.5 rounded-xl shadow-sm hover:shadow">
                                <i data-lucide="user-circle" class="size-5"></i>
                                <span>Login</span>
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="lg:hidden inline-flex space-x-4">
                    <button type="button" class="cursor-pointer text-gray-800 hover:text-primary-500"
                        @click="openSearch=true" aria-label="Open search box">
                        <i data-lucide="search" class="size-6"></i>
                    </button>

                    <a href="{{ route('account.cart') }}" class="relative text-gray-700" aria-label="Shopping Cart">
                        <i data-lucide="shopping-cart" class="size-6"></i>
                        <span class="absolute -top-2 -right-3 bg-red-400 text-white text-xs rounded-full px-1.5 py-0.5">
                            {{ cartCount() }}
                        </span>
                    </a>

                    <a href="{{ route('account.wishlist') }}" class="text-gray-700" aria-label="Wishlist">
                        <i data-lucide="heart" class="size-6"></i>
                    </a>

                    <button type="button" class="cursor-pointer text-gray-800 hover:text-primary-500"
                        @click="showMenu=true" aria-label="Show Menu">
                        <i data-lucide="menu" class="size-6"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div
        class="bottom-header bg-gradient-to-r from-accent-50 to-white border-b border-accent-100 shadow-md relative z-30 hidden lg:block">
        <div class="container px-3 md:px-5 xl:px-0">
            <div class="py-4 items-center">
                <nav class="inline-block space-6 items-center w-full">
                    @foreach ($links as $link)
                        <a class="font-medium {{ request()->url() == $link['link'] ? 'text-primary-500 bg-primary-100' : 'text-accent-700' }} leading-tight hover:text-primary-500 transition-all duration-300 px-4 py-2 rounded-lg hover:bg-primary-100 text-nowrap"
                            href="{{ $link['link'] }}">
                            {{ $link['title'] }}
                        </a>
                    @endforeach
                </nav>
            </div>
        </div>
    </div>
    <div class="relative z-500" aria-labelledby="slide-over-title" role="dialog" aria-modal="true" x-show="showMenu"
        x-cloak>
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div class="fixed inset-0 bg-gray-900/80" aria-hidden="true"></div>

        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10"
                    x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" x-show="showMenu"
                    x-cloak>

                    <div class="pointer-events-auto w-screen max-w-md">
                        <div class="flex h-full flex-col overflow-y-scroll bg-white py-6 shadow-xl">
                            <div class="flex justify-between items-center px-3 py-4 mb-4">
                                <a href="{{ route('home') }}">
                                    <img src="{{ getLogoURL() }}" alt="{{ asset('otc-logo.png') }}" loading="lazy" />
                                </a>

                                <button
                                    class="bg-white text-gray-black flex hover:text-orange-600 focus:text-orange-600 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 focus:outline-hidden"
                                    @click="showMenu = false">
                                    <i data-lucide="x" class="size-6"></i>
                                </button>
                            </div>

                            <ul class="flex flex-col items-center px-3">
                                @foreach ($links as $link)
                                    <li class="w-full block">
                                        <a class="block px-3 py-2 rounded-md {{ request()->url() == $link['link'] ? 'bg-primary-50 text-primary-500 font-medium' : 'text-gray-800' }} hover:text-primary-500 hover:bg-gray-50"
                                            href="{{ $link['link'] }}">{{ $link['title'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-common.search-product />
</header>
<!-- header area end -->
