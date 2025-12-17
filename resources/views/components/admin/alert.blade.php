@if (session('success'))
    <!-- Global notification live region, render this permanently at the end of the document -->
    <div aria-live="assertive"
        class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6 z-100"
        x-data="{ show: {{ session('success') ? 'true' : 'false' }} }">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end" x-show="show"
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" x-init="setTimeout(() => { show = false }, 3000)" x-cloak>
            <div
                class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white ring-1 shadow-lg ring-black/5">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="shrink-0">
                            <i data-lucide="check" class="size-5 text-green-400"></i>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm font-medium text-gray-900">{{ session('success') }}</p>
                        </div>
                        <div class="ml-4 flex shrink-0">
                            <button type="button"
                                class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 focus:outline-hidden"
                                @click="show = false" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <span class="icon-[tabler--x] text-lg"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


@if (session('error'))
    <!-- Global notification live region, render this permanently at the end of the document -->
    <div aria-live="assertive"
        class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6 z-100"
        x-data="{ show: {{ session('error') ? 'true' : 'false' }} }">
        <div class="flex w-full flex-col items-center space-y-4 sm:items-end" x-show="show"
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" x-init="setTimeout(() => { show = false }, 3000)" x-cloak>
            <div
                class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white ring-1 shadow-lg ring-black/5">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="shrink-0">
                            <i data-lucide="ban" class="size-5 text-red-400"></i>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm font-medium text-gray-900">{{ session('error') }}</p>
                        </div>
                        <div class="ml-4 flex shrink-0">
                            <button type="button"
                                class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 focus:outline-hidden"
                                @click="show = false" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <i data-lucide="x" class="size-5"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
