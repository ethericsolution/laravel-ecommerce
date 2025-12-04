<x-layouts.front>
    <x-slot name="title">
        {{ $breadcrumbs['title'] }} - {{ setting('general.site_name') }}
    </x-slot>
    <x-slot name="description">
        {{ setting('general.site_description') }}
    </x-slot>

    @include('components.common.breadcrumb', $breadcrumbs)

    <div class="bg-base-100 py-6 sm:py-10 lg:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="my-10 xl:grid-cols-4 sm:grid-cols-2 md:grid-cols-3 grid grid-cols-1 gap-6">
                @foreach ($products as $product)
                    <x-products.card :product="$product" />
                @endforeach
            </div>

            {{ $products->onEachSide(1)->links('pagination::front') }}

        </div>
    </div>
</x-layouts.front>
