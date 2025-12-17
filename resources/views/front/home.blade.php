<x-layouts.front>
    <x-slot name="title">
        {{ setting('general.site_name') }} - {{ setting('general.tagline') }}
    </x-slot>
    <x-slot name="description">
        {{ setting('general.site_description') }}
    </x-slot>

    @if ($sliders->isNotEmpty())
        <!-- banner section start -->
        <div class="bg-base-100 py-4">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div id="image" data-carousel='{ "loadingClasses": "opacity-0", "isInfiniteLoop": true }'
                    class="relative w-full">
                    <div class="carousel">
                        <div class="carousel-body h-full opacity-0">
                            @foreach ($sliders as $slider)
                                <div class="carousel-slide">
                                    <div class="flex h-full justify-center">
                                        <img src="{{ $slider?->getMedia($slider->location)->first()?->getUrl() }}"
                                            class="size-full object-cover" alt="{{ $slider->name }}" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Previous Slide -->
                    <button type="button"
                        class="carousel-prev start-5 max-sm:start-3 carousel-disabled:opacity-50 size-9.5 bg-base-100 flex items-center justify-center rounded-full shadow-base-300/20 shadow-sm">
                        <span class="icon-[tabler--chevron-left] size-5 cursor-pointer"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <!-- Next Slide -->
                    <button type="button"
                        class="carousel-next end-5 max-sm:end-3 carousel-disabled:opacity-50 size-9.5 bg-base-100 flex items-center justify-center rounded-full shadow-base-300/20 shadow-sm">
                        <span class="icon-[tabler--chevron-right] size-5"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- banner section end -->
    @endif

    @if ($brands->count() > 0)
        <!-- Brand showcase section start -->
        <div class="bg-base-200 py-6 sm:py-10 lg:py-14">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"
                data-carousel='{ "loadingClasses": "opacity-0", "slidesQty": { "xs": 1, "lg": 6 }, "isInfiniteLoop": true }'>

                <div
                    class="mb-6 space-y-4 md:mb-8 lg:mb-10 flex flex-col md:flex-row justify-between items-start md:items-center">
                    <h2 class="text-base-content text-2xl font-semibold md:text-3xl lg:text-4xl">Popular Brands
                    </h2>
                    <div class="flex gap-4">
                        <button
                            class="btn btn-square btn-sm carousel-prev btn-primary carousel-disabled:opacity-100 carousel-disabled:btn-outline relative hover:text-white">
                            <span class="icon-[tabler--arrow-left] size-5"></span>
                        </button>
                        <button
                            class="btn btn-square btn-sm carousel-next btn-primary carousel-disabled:opacity-100 carousel-disabled:btn-outline relative hover:text-white">
                            <span class="icon-[tabler--arrow-right] size-5"></span>
                        </button>
                    </div>
                </div>

                <div id="multi-slide" class="relative w-full">
                    <div class="carousel">
                        <div class="carousel-body h-full opacity-0 gap-6">
                            @foreach ($brands as $brand)
                                <div class="carousel-slide h-full">
                                    <a href="{{ route('products.byBrand', $brand) }}" class="block space-y-4">
                                        <figure class="aspect-square flex items-center justify-center">
                                            <img src="{{ $brand->thumbnailURL('thumb') }}" alt="{{ $brand->name }}"
                                                loading="lazy" class="rounded-full" />
                                        </figure>
                                        <p class="text-center">{{ $brand->name }}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Brand showcase section end -->
    @endif

    <!-- feature products section start -->
    <div class="bg-base-100 py-6 sm:py-10 lg:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Product Header -->
            <div class="mb-6 space-y-4 md:mb-8 lg:mb-10">
                <h2 class="text-base-content text-2xl font-semibold md:text-3xl lg:text-4xl">Featured Products</h2>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                @each('components.products.card', $featuredProducts, 'product')
            </div>
        </div>
    </div>
    <!-- feature products section end -->

    <!-- top categories product section start -->
    <div class="bg-base-200 py-6 sm:py-10 lg:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Header section -->
            <div class="mb-6 space-y-4 text-center sm:mb-8 lg:mb-10">
                <h2 class="text-base-content text-2xl font-semibold md:text-3xl lg:text-4xl">Popular Categories</h2>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                @each('components.common.category-card', $topCategories, 'category')
            </div>
        </div>
    </div>
    <!-- top categories product section end -->


    <!-- Our Product section start  -->
    <div class="bg-base-100 py-6 sm:py-10 lg:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Product Header -->
            <div class="mb-6 space-y-4 md:mb-8 lg:mb-10">
                <h2 class="text-base-content text-2xl font-semibold md:text-3xl lg:text-4xl">Our Products</h2>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                @each('components.products.card', $latestProducts, 'product')
            </div>
        </div>
    </div>
    <!-- Our Product section end  -->

    <!-- Testimonials section start -->
    <div class="bg-base-200 py-6 sm:py-10 lg:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div id="multi-slide" data-carousel='{ "loadingClasses": "opacity-0", "slidesQty": { "xs": 1, "md": 2 } }'
                class="relative flex w-full gap-12 max-lg:flex-col md:gap-16 lg:items-center lg:gap-24">
                <div>
                    <div class="space-y-4">
                        <h2 class="text-base-content text-2xl font-semibold md:text-3xl lg:text-4xl">Customers Feedback
                        </h2>
                        <p class="text-base-content/80 text-xl">Real stories from our satisfied customers</p>
                        <div class="flex gap-4">
                            <button
                                class="btn btn-square btn-sm carousel-prev btn-primary carousel-disabled:opacity-100 carousel-disabled:btn-outline relative hover:text-white"
                                disabled="disabled">
                                <span class="icon-[tabler--arrow-left] size-5"></span>
                            </button>
                            <button
                                class="btn btn-square btn-sm carousel-next btn-primary carousel-disabled:opacity-100 carousel-disabled:btn-outline relative hover:text-white">
                                <span class="icon-[tabler--arrow-right] size-5"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="carousel rounded-box">
                    <div class="carousel-body gap-6 opacity-0">
                        @foreach (config('testimonials') as $review)
                            <div class="carousel-slide">
                                <div
                                    class="card card-border hover:border-primary transition-border h-full shadow-none duration-300">
                                    <!-- Star Rating -->
                                    <div class="card-body gap-5">
                                        <h5 class="card-title text-xl">{{ $review['name'] }}</h5>
                                        <div class="flex gap-1">
                                            <span
                                                class="icon-[tabler--star-filled] text-warning size-5 shrink-0"></span>
                                            <span
                                                class="icon-[tabler--star-filled] text-warning size-5 shrink-0"></span>
                                            <span
                                                class="icon-[tabler--star-filled] text-warning size-5 shrink-0"></span>
                                            <span
                                                class="icon-[tabler--star-filled] text-warning size-5 shrink-0"></span>
                                            <span
                                                class="icon-[tabler--star-filled] text-warning size-5 shrink-0"></span>
                                        </div>
                                        <!-- Content -->
                                        <p class="text-base-content/80">{{ $review['review'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonials section end -->

    <!-- recent products section start -->
    <div class="bg-base-100 py-6 sm:py-10 lg:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"
            data-carousel='{ "loadingClasses": "opacity-0", "slidesQty": { "xs": 1, "lg": 4 }, "isInfiniteLoop": true }'>
            <div
                class="mb-6 space-y-4 md:mb-8 lg:mb-10 flex flex-col md:flex-row justify-between items-start md:items-center">
                <h2 class="text-base-content text-2xl font-semibold md:text-3xl lg:text-4xl">Recently Added
                </h2>
                <div class="flex gap-4">
                    <button
                        class="btn btn-square btn-sm carousel-prev btn-primary carousel-disabled:opacity-100 carousel-disabled:btn-outline relative hover:text-white">
                        <span class="icon-[tabler--arrow-left] size-5"></span>
                    </button>
                    <button
                        class="btn btn-square btn-sm carousel-next btn-primary carousel-disabled:opacity-100 carousel-disabled:btn-outline relative hover:text-white">
                        <span class="icon-[tabler--arrow-right] size-5"></span>
                    </button>
                </div>
            </div>

            <div class="relative w-full">
                <div class="carousel">
                    <div class="carousel-body h-full opacity-0 gap-6">
                        @foreach ($bestSellingProducts as $product)
                            <div class="carousel-slide h-full">
                                <x-products.card :product="$product" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- recent products section end -->

</x-layouts.front>
