<x-layouts.front>
    @include('components.common.breadcrumb', $breadcrumbs)

    <div class="bg-base-100 py-6 sm:py-10 lg:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="grid gap-6 md:grid-cols-12">
                <x-account.nav />

                <div class="md:col-span-9">
                    <h3 class="text-base-content mb-4 text-xl font-semibold">{{ $pageTitle }}</h3>
                    @include($rightSideView)
                </div>
            </div>
        </div>
    </div>

</x-layouts.front>
