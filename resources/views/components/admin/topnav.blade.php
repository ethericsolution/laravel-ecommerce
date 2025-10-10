<div
    class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-xs sm:gap-x-6 sm:px-6 lg:px-8">
    <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="showSideNav = true">
        <span class="sr-only">Open sidebar</span>
        <i data-lucide="menu" class="size-5"></i>
    </button>

    <!-- Separator -->
    <div class="h-6 w-px bg-gray-200 lg:hidden" aria-hidden="true"></div>

    <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
        <div class="flex flex-1 items-center gap-x-4 lg:gap-x-6">
            <a href="{{ route('admin.cache.clear') }}" class="btn-outline-danger gap-1">
                <i data-lucide="database" class="size-5"></i>
                <span class="hidden md:inline-flex">Cache Clear</span>
            </a>
        </div>

        <div class="flex items-center gap-x-4 lg:gap-x-6">
            <a href="{{ route('home') }}" target="_blank" class="-m-2.5 p-2.5 text-green-400 hover:text-green-500">
                <span class="sr-only">Website Home</span>
                <i data-lucide="globe" class="size-6"></i>
            </a>
            <button type="button" class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500">
                <span class="sr-only">View notifications</span>
                <i data-lucide="bell" class="size-6"></i>
            </button>

            <!-- Separator -->
            <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200" aria-hidden="true"></div>

            <!-- Profile dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button type="button" class="-m-1.5 flex items-center p-1.5" id="user-menu-button"
                    aria-expanded="false" aria-haspopup="true" @click="open = !open">
                    <span class="sr-only">Open user menu</span>

                    <span class="inline-flex size-8 items-center justify-center rounded-full bg-gray-500">
                        <span
                            class="text-xs font-medium text-white">{{ mb_substr(auth('admin')->user()->name, 0, 1) }}</span>
                    </span>
                    <span class="hidden lg:flex lg:items-center">
                        <span class="ml-4 text-sm/6 font-semibold text-gray-900"
                            aria-hidden="true">{{ auth('admin')->user()->name }}</span>
                        <i data-lucide="chevron-down" class="ml-2 size-5 text-gray-400"></i>
                    </span>
                </button>

                <div class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 ring-1 shadow-lg ring-gray-900/5 focus:outline-hidden"
                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                    x-show="open" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95" @click.outside="open= false" x-cloak>
                    <!-- Active: "bg-gray-50 outline-hidden", Not Active: "" -->
                    <a href="{{ route('admin.profile.edit') }}" class="block px-3 py-1 text-sm/6 text-gray-900"
                        role="menuitem" tabindex="-1" id="user-menu-item-0">Your profile</a>
                    <form action="{{ route('admin.logout') }}" method="post">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left cursor-pointer px-3 py-1 text-sm/6 text-gray-900 hover:bg-gray-50 hover:outline-hidden"
                            role="menuitem" tabindex="-1" id="user-menu-item-1">Sign out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
