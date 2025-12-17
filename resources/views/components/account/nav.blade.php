<aside class="md:col-span-3">
    <div class="card card-border shadow-none">
        <nav class="card-body p-2">
            <ul role="list" class="menu p-0">
                <li>
                    <a href="{{ route('account.dashboard') }}"
                        class="@if (request()->routeIs('account.dashboard')) menu-active @endif">
                        <span class="icon-[tabler--home] size-5"></span>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('account.orders.index') }}"
                        class="@if (request()->routeIs('account.orders.*')) menu-active @endif">
                        <span class="icon-[tabler--shopping-bag] size-5"></span>
                        Your Orders
                    </a>
                </li>
                <li>
                    <a href="{{ route('account.addresses.index') }}"
                        class="@if (request()->routeIs('account.addresses.*')) menu-active @endif">
                        <span class="icon-[tabler--map-pin] size-5"></span>
                        Your Addresses
                    </a>
                </li>
                <li>
                    <a href="{{ route('account.wishlist') }}"
                        class="@if (request()->routeIs('account.wishlist')) menu-active @endif">
                        <span class="icon-[tabler--heart] size-5"></span>
                        Your Wishlist
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}" class="@if (request()->routeIs('profile.edit')) menu-active @endif">
                        <span class="icon-[tabler--shield] size-5"></span>
                        Account Details
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.password') }}"
                        class="@if (request()->routeIs('profile.password')) menu-active @endif">
                        <span class="icon-[tabler--key] size-5"></span>
                        Change Password
                    </a>
                </li>
            </ul>
            <div class="divider my-2"></div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-text btn-error btn-block h-11 justify-start px-4 font-normal">
                    <span class="icon-[tabler--logout-2] size-5"></span>
                    {{ __('Logout') }}
                </button>
            </form>
        </nav>
    </div>
</aside>
