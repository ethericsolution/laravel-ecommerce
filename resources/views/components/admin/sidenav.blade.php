@php
    $navigation = [
        [
            'name' => 'Dashboard',
            'route' => route('admin.dashboard'),
            'active' => ($active = request()->routeIs('admin.dashboard')),
            'icon' => 'icon-[tabler--dashboard]',
        ],
        // Shop group (title only)
        [
            'group' => 'Shop',
        ],
        [
            'name' => 'Products',
            'route' => route('admin.products.index'),
            'active' => ($active = request()->routeIs('admin.products.*')),
            'icon' => 'icon-[tabler--shopping-cart]',
        ],
        [
            'name' => 'Categories',
            'route' => route('admin.categories.index'),
            'active' => ($active = request()->routeIs('admin.categories.*')),
            'icon' => 'icon-[tabler--category]',
        ],
        [
            'name' => 'Brands',
            'route' => route('admin.brands.index'),
            'active' => ($active = request()->routeIs('admin.brands.*')),
            'icon' => 'icon-[tabler--brand-tabler]',
        ],
        [
            'name' => 'Orders',
            'route' => route('admin.orders.index'),
            'active' => ($active = request()->routeIs('admin.orders.*')),
            'icon' => 'icon-[tabler--shopping-bag]',
        ],
        [
            'name' => 'Coupons',
            'route' => route('admin.coupons.index'),
            'active' => ($active = request()->routeIs('admin.coupons.*')),
            'icon' => 'icon-[tabler--discount]',
        ],
        [
            'name' => 'Banners',
            'route' => route('admin.banners.index'),
            'active' => ($active = request()->routeIs('admin.banners.*')),
            'icon' => 'icon-[tabler--photo]',
        ],
        [
            'name' => 'Taxes',
            'route' => route('admin.taxes.index'),
            'active' => ($active = request()->routeIs('admin.taxes.*')),
            'icon' => 'icon-[tabler--receipt-tax]',
        ],
        [
            'name' => 'Contact Queries',
            'route' => route('admin.contactQueries.index'),
            'active' => ($active = request()->routeIs('admin.contactQueries.*')),
            'icon' => 'icon-[tabler--message]',
        ],
        [
            'name' => 'Subscribers',
            'route' => route('admin.subscribers.index'),
            'active' => ($active = request()->routeIs('admin.subscribers.*')),
            'icon' => 'icon-[tabler--mail]',
        ],

        // Management group (title only)
        [
            'group' => 'Management',
        ],
        [
            'name' => 'Users',
            'route' => route('admin.users.index'),
            'active' => ($active = request()->routeIs('admin.users.*')),
            'icon' => 'icon-[tabler--users]',
        ],
        // Blog group (title only)
        [
            'group' => 'Blog',
        ],
        [
            'name' => 'Posts',
            'route' => route('admin.blogs.posts.index'),
            'active' => ($active = request()->routeIs('admin.blogs.posts.*')),
            'icon' => 'icon-[tabler--news]',
        ],
        [
            'name' => 'Categories',
            'route' => route('admin.blogs.categories.index'),
            'active' => ($active = request()->routeIs('admin.blogs.categories.*')),
            'icon' => 'icon-[tabler--folders]',
        ],
        // Settings group (title only)
        [
            'group' => 'Settings',
        ],
        [
            'name' => 'General Settings',
            'route' => route('admin.settings.general'),
            'active' => ($active = request()->routeIs('admin.settings.general')),
            'icon' => 'icon-[tabler--settings]',
        ],
        [
            'name' => 'Social Media Links',
            'route' => route('admin.settings.socialMedia'),
            'active' => ($active = request()->routeIs('admin.settings.socialMedia')),
            'icon' => 'icon-[tabler--brand-facebook]',
        ],
        [
            'name' => 'Company Settings',
            'route' => route('admin.settings.company'),
            'active' => ($active = request()->routeIs('admin.settings.company')),
            'icon' => 'icon-[tabler--building]',
        ],
        [
            'name' => 'Prefix Settings',
            'route' => route('admin.settings.prefix'),
            'active' => ($active = request()->routeIs('admin.settings.prefix')),
            'icon' => 'icon-[tabler--adjustments]',
        ],
        [
            'name' => 'Payment Gateway',
            'route' => route('admin.settings.paymentGateway'),
            'active' => ($active = request()->routeIs('admin.settings.paymentGateway')),
            'icon' => 'icon-[tabler--credit-card]',
        ],
    ];
@endphp

<aside id="layout-toggle"
    class="overlay overlay-open:translate-x-0 drawer drawer-start inset-y-0 start-0 hidden h-full [--auto-close:lg] sm:w-75 lg:z-50 lg:block lg:translate-x-0 lg:shadow-none"
    aria-label="Sidebar" tabindex="-1">
    <div class="drawer-head border-base-content/20 border-e px-6 py-2">
        <div class="flex flex-1 items-center justify-between">
            <a class="link text-base-content link-neutral text-xl font-semibold no-underline"
                href="{{ route('admin.dashboard') }}">
                <img class="h-10 w-auto" src="{{ getLogoURL() }}" alt="{{ setting('general.app_name') }}"
                    loading="lazy" />
            </a>
            <button type="button" class="btn btn-text btn-square btn-xs block lg:hidden" aria-label="Close"
                data-overlay="#layout-toggle">
                <span class="icon-[tabler--x] size-4"></span>
            </button>
        </div>
    </div>
    <div class="drawer-body border-base-content/20 h-full border-e p-6">
        <ul class="menu p-0">
            @foreach ($navigation as $item)
                @if (isset($item['group']))
                    <li
                        class="text-base-content/50 before:bg-base-content/20 mt-2 p-2 text-xs uppercase before:absolute before:-start-3 before:top-1/2 before:h-0.5 before:w-2.5">
                        {{ $item['group'] }}</li>
                @else
                    <li>
                        <a href="{{ $item['route'] }}" class="{{ $item['active'] ? 'menu-active' : '' }}">
                            <span class="{{ $item['icon'] }} size-5"></span>
                            {{ $item['name'] }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</aside>
