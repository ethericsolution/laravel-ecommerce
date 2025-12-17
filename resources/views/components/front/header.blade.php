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

<!-- Navbar -->
<header class="border-base-content/20 bg-base-100 py-0.25 fixed top-0 z-10 w-full border-b">
    <nav class="navbar mx-auto max-w-7xl rounded-b-xl px-4 sm:px-6 lg:px-8">
        <div class="w-full lg:flex lg:items-center lg:gap-2">
            <div class="navbar-start items-center justify-between max-lg:w-full">
                <a class="text-base-content flex items-center gap-3 text-xl font-semibold" href="{{ route('home') }}">
                    <img src="{{ getLogoURL() }}" alt="Saptapadi Matrimonial" class="h-10 w-auto" />
                </a>
                <div class="flex items-center gap-5 lg:hidden">
                    <div class="indicator">
                        <div class="indicator-item inline-grid *:[grid-area:1/1]">
                            <div class="status status-error"></div>
                        </div>
                        <a href="{{ route('account.wishlist') }}" class="btn btn-sm btn-text btn-square"
                            aria-label="Wishlist">
                            <span class="icon-[tabler--heart] size-5"></span>
                        </a>
                    </div>

                    <div class="indicator pr-1">
                        <span
                            class="indicator-item p-0 size-4 text-xs text-center badge badge-error rounded-full text-white">
                            {{ cartCount() }}
                        </span>

                        <button type="button" class="btn btn-sm btn-text btn-square" aria-haspopup="dialog"
                            aria-expanded="false" aria-controls="cart-drawer" data-overlay="#cart-drawer">
                            <span class="icon-[tabler--shopping-bag] size-5"></span>
                        </button>
                    </div>
                    <!-- Mobile: Just the menu button for authenticated users -->
                    <button type="button" class="collapse-toggle btn btn-outline btn-secondary btn-square"
                        data-collapse="#navbar-block-4" aria-controls="navbar-block-4" aria-label="Toggle navigation">
                        <span class="icon-[tabler--menu-2] collapse-open:hidden size-5.5"></span>
                        <span class="icon-[tabler--x] collapse-open:block size-5.5 hidden"></span>
                    </button>
                </div>
            </div>
            <div id="navbar-block-4"
                class="lg:navbar-center transition-height collapse hidden grow overflow-hidden font-medium duration-300 lg:flex">
                <div class="text-base-content flex gap-6 text-base max-lg:mt-4 max-lg:flex-col lg:items-center">
                    @foreach ($links as $item)
                        <a href="{{ $item['link'] }}" class="text-gray-600 hover:text-primary nav-link">
                            {{ $item['title'] }}
                        </a>
                    @endforeach

                    <!-- Mobile: Profile and Logout inside drawer for authenticated users -->
                    @auth
                        <div class="lg:hidden border-t border-gray-200 pt-4 mt-4">
                            <div class="flex items-center gap-3 mb-4 px-2">
                                <div class="avatar avatar-placeholder">
                                    <div class="bg-primary/10 text-primary w-10 rounded-full">
                                        <span class="text-md uppercase">{{ Auth::user()->abbr }}</span>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="text-base-content font-semibold">{{ Auth::user()->full_name }}</h6>
                                    <p class="text-base-content/60 text-sm">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-3 px-2 py-2 text-gray-600 hover:text-primary nav-link">
                                <span class="icon-[tabler--user] size-5"></span>
                                Edit Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-3 px-2 py-2 text-red-600 hover:text-red-700 nav-link w-full text-left">
                                    <span class="icon-[tabler--logout] size-5"></span>
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- Mobile: Auth buttons for guests -->
                        <div class="lg:hidden flex items-center gap-2">
                            <a href="{{ route('login') }}" class="btn btn-outline btn-primary btn-sm">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a>
                        </div>
                    @endauth
                </div>
            </div>
            <div class="navbar-end max-lg:hidden">
                <div class="flex items-center gap-3">
                    <div class="indicator">
                        <div class="indicator-item inline-grid *:[grid-area:1/1]">
                            <div class="status status-error"></div>
                        </div>
                        <a href="{{ route('account.wishlist') }}" class="btn btn-sm btn-text btn-square"
                            aria-label="Wishlist">
                            <span class="icon-[tabler--heart] size-5"></span>
                        </a>
                    </div>

                    <div class="indicator pr-1">
                        <span
                            class="indicator-item p-0 size-4 text-xs text-center badge badge-error rounded-full text-white">
                            {{ cartCount() }}
                        </span>

                        <button type="button" class="btn btn-sm btn-text btn-square" aria-haspopup="dialog"
                            aria-expanded="false" aria-controls="cart-drawer" data-overlay="#cart-drawer">
                            <span class="icon-[tabler--shopping-bag] size-5"></span>
                        </button>
                    </div>

                    @auth
                        <!-- Desktop: User dropdown for authenticated users -->
                        <div class="dropdown relative inline-flex [--offset:21]">
                            <button id="desktop-profile-dropdown" type="button" class="dropdown-toggle avatar"
                                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                <div class="avatar avatar-placeholder">
                                    <div class="bg-primary/10 text-primary w-10 rounded-full">
                                        <span class="text-md uppercase">{{ Auth::user()->abbr }}</span>
                                    </div>
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-open:opacity-100 max-w-75 hidden w-full space-y-0.5"
                                role="menu" aria-orientation="vertical" aria-labelledby="desktop-profile-dropdown">
                                <li class="dropdown-header pt-4.5 mb-1 gap-4 px-5 pb-3.5">
                                    <div class="avatar avatar-placeholder">
                                        <div class="bg-primary/10 text-primary w-10 rounded-full">
                                            <span class="text-md uppercase">{{ Auth::user()->abbr }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="text-base-content font-semibold">{{ Auth::user()->name }}
                                        </h6>
                                        <p class="text-base-content/60 text-sm">{{ Auth::user()->email }}</p>
                                    </div>
                                </li>
                                <li class="mb-1">
                                    <a class="dropdown-item px-3" href="{{ route('profile.edit') }}">
                                        <span class="icon-[tabler--user] size-5"></span>
                                        Edit Profile
                                    </a>
                                </li>
                                <li class="dropdown-footer p-2 pt-1">
                                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                                        @csrf
                                        <button
                                            class="btn btn-text btn-error btn-block h-11 justify-start px-3 font-normal">
                                            <span class="icon-[tabler--logout] size-5"></span>
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <!-- Desktop: Auth buttons for guests -->
                        <a href="{{ route('login') }}" class="btn btn-outline btn-primary">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>


<form action="{{ route('account.updateCart') }}" method="POST">
    @csrf
    <!-- Activity Drawer Content  -->
    <div id="cart-drawer" class="overlay overlay-open:translate-x-0 drawer drawer-end hidden sm:max-w-104"
        role="dialog" tabindex="-1">
        <div class="drawer-header border-base-content/20 border-b p-4">
            <h3 class="drawer-title text-xl font-semibold">Cart</h3>
            <button type="button" class="btn btn-text btn-square btn-sm" aria-label="Close"
                data-overlay="#cart-drawer">
                <span class="icon-[tabler--x] size-5"></span>
            </button>
        </div>
        <div class="drawer-body">
            <ul class="space-y-0 mb-12">
                @foreach (cart()->items as $product)
                    <li class="flex items-center justify-between py-4 gap-4">
                        <div class="flex items-center gap-4">
                            <div class="size-18 shrink-0">
                                <a href="{{ route('products.show', $product->product) }}">
                                    <img src="{{ $product->product?->thumbnailURL('thumb') }}"
                                        class="rounded-box bg-contain w-full shrink-0 h-full"
                                        alt="{{ $product->product->name }}" />
                                </a>
                            </div>
                            <div class="flex flex-col justify-between gap-2">
                                <div class="space-y-3">
                                    <div class="text-base-content font-medium line-clamp-1">
                                        <a
                                            href="{{ route('products.show', $product->product) }}">{{ $product->product->name }}</a>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <div class="max-w-24" data-input-number='{ "min": 1 }'>
                                            <div class="input input-sm items-center">
                                                <button type="button"
                                                    class="btn btn-primary btn-soft size-5.5 min-h-0 rounded-sm p-0"
                                                    aria-label="Decrement button" data-input-number-decrement>
                                                    <span class="icon-[tabler--minus] size-3.5 shrink-0"></span>
                                                </button>
                                                <input class="text-center" type="number"
                                                    value="{{ $product->quantity }}"
                                                    name="quantity[{{ $product->product_id }}]"
                                                    aria-label="Mini stacked buttons" data-input-number-input
                                                    id="number-input-mini" readonly />
                                                <button type="button"
                                                    class="btn btn-primary btn-soft size-5.5 min-h-0 rounded-sm p-0"
                                                    aria-label="Increment button" data-input-number-increment>
                                                    <span class="icon-[tabler--plus] size-3.5 shrink-0"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-end gap-3">
                            <div class="text-base-content text-lg font-medium whitespace-nowrap">@money($product->total)
                            </div>
                            <a href="{{ route('account.removeFromCart', $product->product_id) }}"
                                class="btn btn-square btn-text btn-sm" aria-label="Delete Item">
                                <span class="icon-[tabler--trash] size-6 shrink-0"></span>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="drawer-footer flex-col">

            @if (cart()->items->isNotEmpty())
                <div class="mb-6 w-full">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-base-content/80">Sub Total</span>
                        <span class="text-base-content font-medium whitespace-nowrap">@money(cart()->total)</span>
                    </div>
                    @foreach (cart()->tax_breakdown as $tax)
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-base-content/80">{{ $tax['name'] }}</span>
                            <span class="text-base-content font-medium whitespace-nowrap">@money($tax['total_amount'])</span>
                        </div>
                    @endforeach
                    <div class="divider mb-3"></div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-base-content text-lg font-semibold">Grand Total</span>
                        <span
                            class="text-base-content text-lg font-semibold whitespace-nowrap">@money(cart()->total + cart()->total_tax_amount)</span>
                    </div>
                </div>
                <button class="btn btn-primary mb-2 w-full">Checkout</button>
            @endif
            <button type="button" class="btn btn-primary btn-outline w-full" data-overlay="#cart-drawer">Continue
                Shopping</button>
        </div>
    </div>
</form>
<!-- ---------- END HEADER ---------- -->
