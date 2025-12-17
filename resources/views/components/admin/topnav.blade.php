<!-- ---------- HEADER ---------- -->
<div class="bg-base-100 border-base-content/20 sticky top-0 z-50 flex border-b lg:ps-75">
    <div class="mx-auto w-full">
        <nav class="navbar py-2">
            <div class="navbar-start gap-2">
                <button type="button" class="btn btn-soft btn-square btn-sm lg:hidden" aria-haspopup="dialog"
                    aria-expanded="false" aria-controls="layout-toggle" data-overlay="#layout-toggle">
                    <span class="icon-[tabler--menu-2] size-4.5"></span>
                </button>

                <a href="{{ route('admin.cache.clear') }}" class="btn btn-sm btn-soft btn-error"
                    aria-label="Clear Cache">
                    <span class="icon-[tabler--database] size-4.5"></span>
                    Clear Cache
                </a>

                <!-- Search  -->
                <button type="button"
                    class="max-sm:btn max-sm:btn-text max-sm:btn-sm max-sm:btn-square flex items-center gap-2 text-sm"
                    aria-haspopup="dialog" aria-expanded="false" aria-controls="search-modal"
                    data-overlay="#search-modal">
                    <span class="icon-[tabler--search] text-base-content size-5"></span>
                    <span class="text-base-content/50 max-sm:hidden">Type to search...</span>
                </button>
            </div>

            <div class="navbar-end gap-6">
                <div class="flex items-center">
                    <a href="/" target="_blank" class="btn btn-sm btn-square btn-text btn-success"
                        aria-label="View Website">
                        <span class="icon-[tabler--world-www] size-4.5"></span>
                    </a>
                    <!-- Theme Dropdown  -->
                    <div class="dropdown relative inline-flex [--offset:24]">
                        <button id="dropdown-theme" type="button"
                            class="dropdown-toggle btn btn-sm btn-square btn-text" aria-haspopup="menu"
                            aria-expanded="false" aria-label="Dropdown">
                            <span class="icon-[tabler--sun] size-4.5"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-open:opacity-100 hidden w-full max-w-50" role="menu"
                            aria-orientation="vertical" aria-labelledby="dropdown-theme">
                            <li>
                                <input type="radio" name="theme-dropdown"
                                    class="theme-controller btn btn-text w-full justify-start" aria-label="Light"
                                    value="light" />
                            </li>
                            <li>
                                <input type="radio" name="theme-dropdown"
                                    class="theme-controller btn btn-text w-full justify-start" aria-label="Dark"
                                    value="dark" />
                            </li>
                            <li>
                                <input type="radio" name="theme-dropdown"
                                    class="theme-controller btn btn-text w-full justify-start" aria-label="System"
                                    value="default" />
                            </li>
                        </ul>
                    </div>

                    <!-- Notification Dropdown -->
                    <div class="dropdown relative inline-flex [--auto-close:inside] [--offset:24]">
                        <button id="notification-dropdown" type="button"
                            class="dropdown-toggle btn btn-text btn-square btn-sm" aria-haspopup="menu"
                            aria-expanded="false" aria-label="Dropdown">
                            <span class="indicator">
                                <span class="indicator-item bg-error size-2 rounded-full"></span>
                                <span class="icon-[tabler--bell] size-4.5"></span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-open:opacity-100 hidden w-full max-w-122 space-y-0.5 px-3"
                            role="menu" aria-orientation="vertical" aria-labelledby="notification-dropdown">
                            <div class="mb-0 flex w-full items-center justify-between gap-4 py-2.5">
                                <h6 class="text-base-content/50 text-sm uppercase">Notification</h6>
                                <span class="badge badge-soft badge-sm badge-primary rounded-full">8 New</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <nav class="tabs tabs-bordered" aria-label="Tabs" role="tablist"
                                    aria-orientation="horizontal">
                                    <button type="button" class="tab active-tab:tab-active active font-medium"
                                        id="tabs-basic-item-1" data-tab="#tabs-basic-1" aria-controls="tabs-basic-1"
                                        role="tab" aria-selected="true">
                                        4 Inbox
                                    </button>
                                    <button type="button" class="tab active-tab:tab-active font-medium"
                                        id="tabs-basic-item-2" data-tab="#tabs-basic-2" aria-controls="tabs-basic-2"
                                        role="tab" aria-selected="false">
                                        General
                                    </button>
                                </nav>
                                <div class="dropdown relative inline-flex [--auto-close:inside]">
                                    <button id="notification-settings" type="button"
                                        class="dropdown-toggle btn btn-text btn-sm btn-square" aria-haspopup="menu"
                                        aria-expanded="false" aria-label="Dropdown">
                                        <span class="icon-[tabler--settings] size-5"></span>
                                    </button>
                                    <div class="dropdown-menu dropdown-open:opacity-100 hidden min-w-30"
                                        role="menu" aria-orientation="vertical"
                                        aria-labelledby="notification-settings">
                                        <div class="dropdown-item items-center justify-between gap-2 px-2 py-1">
                                            <label class="label-text text-base" for="settings1">Notification</label>
                                            <input type="checkbox" class="switch switch-primary switch-sm"
                                                id="settings1" checked />
                                        </div>
                                        <div class="dropdown-item items-center justify-between gap-2 px-2 py-1">
                                            <label class="label-text text-base" for="settings2">Location</label>
                                            <input type="checkbox" class="switch switch-primary switch-sm"
                                                id="settings2" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="border-base-content/20 -mx-3 -mt-1 border-1" />
                            <div>
                                <div id="tabs-basic-1" role="tabpanel" aria-labelledby="tabs-basic-item-1">
                                    <ul>
                                        <li>
                                            <div class="flex w-full items-center gap-3 py-3">
                                                <div class="avatar">
                                                    <div class="size-10 rounded-full">
                                                        <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-1.png"
                                                            alt="avatar" />
                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    <h6 class="text-base-content mb-0.5 font-medium">Cristofer
                                                        Torff</h6>
                                                    <div class="flex items-center gap-x-2.5">
                                                        <p class="text-base-content/50 text-sm">12 Minutes ago
                                                        </p>
                                                        <span class="bg-neutral/20 size-1.5 rounded-full"></span>
                                                        <p class="text-base-content/50 text-sm">New post</p>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col items-center gap-3">
                                                    <button class="btn btn-xs btn-circle btn-text">
                                                        <span
                                                            class="icon-[tabler--x] text-base-content/80 size-4"></span>
                                                    </button>
                                                    <div class="bg-primary size-1.5 rounded-full"></div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <hr class="border-base-content/20 -mx-3 my-1.5" />
                                        </li>
                                        <li>
                                            <div class="flex w-full items-center gap-3 py-3">
                                                <div class="avatar">
                                                    <div class="size-10 rounded-full">
                                                        <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-2.png"
                                                            alt="avatar" />
                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    <h6 class="text-base-content mb-0.5 font-medium">Deni
                                                        Arison</h6>
                                                    <div class="flex items-center gap-x-2.5">
                                                        <p class="text-base-content/50 text-sm">27 Minutes ago
                                                        </p>
                                                        <span class="bg-neutral/20 size-1.5 rounded-full"></span>
                                                        <p class="text-base-content/50 text-sm">New comment</p>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col items-center gap-3">
                                                    <button class="btn btn-xs btn-circle btn-text">
                                                        <span
                                                            class="icon-[tabler--x] text-base-content/80 size-4"></span>
                                                    </button>
                                                    <div class="bg-primary size-1.5 rounded-full"></div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <hr class="border-base-content/20 -mx-3 my-1.5" />
                                        </li>
                                        <li>
                                            <div class="flex w-full gap-3 py-3">
                                                <div class="avatar">
                                                    <div class="size-10 rounded-full">
                                                        <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-3.png"
                                                            alt="avatar" />
                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    <h6 class="text-base-content mb-0.5 font-medium text-wrap">
                                                        Anna has applied to create an ad for your campaign
                                                    </h6>
                                                    <div class="mb-3 flex items-center gap-2.5">
                                                        <p class="text-base-content/50 text-sm">2 hours ago</p>
                                                        <span class="bg-neutral/20 size-1.5 rounded-full"></span>
                                                        <p class="text-base-content/50 text-sm">New request for
                                                            campaign</p>
                                                    </div>
                                                    <div class="flex gap-4">
                                                        <button class="btn btn-sm">Decline</button>
                                                        <button class="btn btn-sm btn-primary">Accept</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <hr class="border-base-content/20 -mx-3 my-1.5" />
                                        </li>
                                        <li>
                                            <div class="flex w-full gap-3 py-3">
                                                <div class="avatar">
                                                    <div class="size-10 rounded-full">
                                                        <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-4.png"
                                                            alt="avatar" />
                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    <h6 class="text-base-content mb-0.5 line-clamp-1 font-medium">
                                                        Jason attached the file</h6>
                                                    <div class="mb-3 flex items-center gap-2.5">
                                                        <p class="text-base-content/50 text-sm">6 hours ago</p>
                                                        <span class="bg-neutral/20 size-1.5 rounded-full"></span>
                                                        <p class="text-base-content/50 text-sm">Attached files
                                                        </p>
                                                    </div>
                                                    <div class="flex items-center gap-2 py-1">
                                                        <span class="icon-[tabler--link] size-4"></span>
                                                        <p class="link link-hover">Work examples.com</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div id="tabs-basic-2" class="hidden" role="tabpanel"
                                    aria-labelledby="tabs-basic-item-2">
                                    <ul class="space-y-0.5">
                                        <li>
                                            <div class="flex w-full items-center gap-3 py-3">
                                                <div class="avatar">
                                                    <div class="w-10 rounded-full">
                                                        <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-5.png"
                                                            alt="avatar" />
                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    <h6 class="text-base-content mb-0.5 font-medium">New Update
                                                        Available</h6>
                                                    <div class="flex items-center gap-2.5">
                                                        <p class="text-base-content/50 text-sm">1 hour ago</p>
                                                        <span class="bg-neutral/20 size-1.5 rounded-full"></span>
                                                        <p class="text-base-content/50 text-sm">Click to update
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col items-center gap-3">
                                                    <button class="btn btn-xs btn-circle btn-text">
                                                        <span
                                                            class="icon-[tabler--x] text-base-content/80 size-4"></span>
                                                    </button>
                                                    <div class="bg-primary size-1.5 rounded-full"></div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <hr class="border-base-content/20 -mx-3 my-1.5" />
                                        </li>
                                        <li>
                                            <div class="flex w-full items-center gap-3 py-3">
                                                <div class="avatar">
                                                    <div class="w-10 rounded-full">
                                                        <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-6.png"
                                                            alt="avatar" />
                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    <h6 class="text-base-content mb-0.5 font-medium">Privacy
                                                        Policy Update</h6>
                                                    <div class="flex items-center gap-2.5">
                                                        <p class="text-base-content/50 text-sm">3 hours ago</p>
                                                        <span class="bg-neutral/20 size-1.5 rounded-full"></span>
                                                        <p class="text-base-content/50 text-sm">Review terms
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col items-center gap-3">
                                                    <button class="btn btn-xs btn-circle btn-text">
                                                        <span
                                                            class="icon-[tabler--x] text-base-content/80 size-4"></span>
                                                    </button>
                                                    <div class="bg-primary size-1.5 rounded-full"></div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <hr class="border-base-content/20 -mx-3 my-1.5" />
                                        </li>
                                        <li>
                                            <div class="flex w-full items-center gap-3 py-3">
                                                <div class="avatar">
                                                    <div class="w-10 rounded-full">
                                                        <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-7.png"
                                                            alt="avatar" />
                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    <h6 class="text-base-content mb-0.5 font-medium">Account
                                                        Security Alert</h6>
                                                    <div class="flex items-center gap-2.5">
                                                        <p class="text-base-content/50 text-sm">5 hours ago</p>
                                                        <span class="bg-neutral/20 size-1.5 rounded-full"></span>
                                                        <p class="text-base-content/50 text-sm">Check activity
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col items-center gap-3">
                                                    <button class="btn btn-xs btn-circle btn-text">
                                                        <span
                                                            class="icon-[tabler--x] text-base-content/80 size-4"></span>
                                                    </button>
                                                    <div class="bg-primary size-1.5 rounded-full"></div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Dropdown -->
                <div class="dropdown relative inline-flex [--offset:21]">
                    <button id="profile-dropdown" type="button" class="dropdown-toggle avatar" aria-haspopup="menu"
                        aria-expanded="false" aria-label="Dropdown">

                        <div class="avatar avatar-placeholder">
                            <div class="bg-neutral text-neutral-content w-10 rounded-full">
                                <span class="icon-[tabler--user] size-6"></span>
                            </div>
                        </div>

                    </button>
                    <ul class="dropdown-menu dropdown-open:opacity-100 hidden w-full max-w-75 space-y-0.5"
                        role="menu" aria-orientation="vertical" aria-labelledby="profile-dropdown">
                        <li class="dropdown-header mb-1 gap-4 px-5 pt-4.5 pb-3.5">
                            <div class="avatar avatar-placeholder avatar-online-top">
                                <div class="bg-neutral text-neutral-content w-10 rounded-full">
                                    <span class="icon-[tabler--user] size-6"></span>
                                </div>
                            </div>
                            <div>
                                <h6 class="text-base-content mb-0.5 font-semibold">{{ auth('admin')->user()->name }}
                                </h6>
                                <p class="text-base-content/80 font-medium">{{ auth('admin')->user()->email }}</p>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item px-3" href="{{ route('admin.profile.edit') }}">
                                <span class="icon-[tabler--user] size-5"></span>
                                Your account
                            </a>
                        </li>
                        <li class="dropdown-footer p-2 pt-1">
                            <form action="{{ route('admin.logout') }}" method="post" class="w-full">
                                @csrf
                                <button
                                    class="btn btn-text btn-error btn-block h-11 justify-start px-3 font-normal w-full">
                                    <span class="icon-[tabler--logout] size-5"></span>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- Search Dropdown Content  -->
<div id="search-modal" class="overlay modal overlay-open:opacity-100 overlay-open:duration-300 modal-middle hidden"
    role="dialog" tabindex="-1">
    <div class="modal-dialog w-full max-w-145">
        <div class="modal-content overflow-auto shadow-none">
            <!-- SearchBox -->
            <div class="modal-header border-base-content/20 border-b-1 px-3 py-2">
                <div class="input no-focus border-0 px-0">
                    <span class="icon-[tabler--search] text-base-content/80 my-auto me-2 size-5 shrink-0"></span>
                    <input type="search" class="grow" placeholder="Search here..." id="kbdInput" />
                    <label class="sr-only" for="kbdInput">Search</label>
                </div>
            </div>

            <!-- Footer Commands -->
            <div class="modal-footer border-base-content/20 text-base-content/50 gap-4 border-t-1 py-4 max-sm:hidden">
                <div class="flex grow items-center gap-2 text-sm">
                    <kbd class="kbd kbd-sm">esc</kbd>
                    <span>To close</span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                    <kbd class="kbd kbd-sm p-0"><span class="icon-[tabler--arrow-back] size-4"></span></kbd>
                    <span>To Select</span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                    <kbd class="kbd kbd-sm p-0"><span class="icon-[tabler--arrow-up] size-4"></span></kbd>
                    <kbd class="kbd kbd-sm p-0"><span class="icon-[tabler--arrow-down] size-4"></span></kbd>
                    <span>To Navigate</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Search Dropdown Content  -->
