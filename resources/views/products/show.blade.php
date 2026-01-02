<x-layouts.front>
    <x-slot name="title">
        {{ $product->seo_title ?? $product->name . ' - ' . setting('general.site_name') }}
    </x-slot>
    <x-slot name="description">
        {{ $product->seo_description }}
    </x-slot>

    @php
        $breadcrumbs = [
            'links' => [
                ['url' => route('home'), 'text' => 'Home'],
                ['url' => route('products.index'), 'text' => 'Products'],
                ['url' => '#', 'text' => $product->name],
            ],
            'title' => $product->name,
        ];
    @endphp

    @include('components.common.breadcrumb', $breadcrumbs)

    <!-- product details section start -->
    <div class="bg-base-100 py-6 sm:py-10 lg:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="md:grid md:grid-cols-2 md:gap-10 xl:gap-24">

                <div data-carousel='{ "loadingClasses": "opacity-0" }' class="relative w-full max-md:mb-12 init">
                    <div class="carousel flex flex-col gap-6 rounded-none">
                        <div class="rounded-box relative grow overflow-hidden">
                            <div class="carousel-body h-142 max-sm:h-83">
                                <div class="carousel-slide">
                                    <div class="flex size-full justify-center">
                                        <img src="{{ $product->thumbnailURL() }}" class="size-full object-cover"
                                            alt="{{ $product?->name }}" />
                                    </div>
                                </div>
                                @foreach ($product?->getMedia('product-images') as $image)
                                    <div class="carousel-slide">
                                        <div class="flex size-full justify-center">
                                            <img src="{{ $image->getUrl() }}" class="size-full object-cover"
                                                alt="{{ $product?->name }}" />
                                        </div>
                                    </div>
                                @endforeach
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

                        <div class="carousel-pagination flex flex-none justify-between gap-5 overflow-x-auto">
                            <img src="{{ $product->thumbnailURL() }}"
                                class="carousel-pagination-item carousel-active:opacity-100 grow object-cover opacity-30 rounded-box size-16"
                                alt="{{ $product?->name }}" />
                            @foreach ($product?->getMedia('product-images') as $image)
                                <img src="{{ $image->getUrl() }}"
                                    class="carousel-pagination-item carousel-active:opacity-100 grow object-cover opacity-30 rounded-box size-16"
                                    alt="{{ $product?->name }}" />
                            @endforeach
                        </div>

                    </div>
                </div>

                {{-- Right Side --}}
                <div class="space-y-6">
                    <h1 class="font-medium text-3xl text-base-content">
                        {{ $product->name }}
                    </h1>
                    <div class="flex items-center gap-3">
                        <p class="flex gap-3 items-center">
                            <span class="text-base-content text-3xl">@money($product->selling_price)</span>
                            @if ($product->regular_price > $product->selling_price)
                                <span class="text-2xl text-accent-500 line-through">@money($product->regular_price)</span>
                                <span class="badge badge-soft badge-success">
                                    {{ round((($product->regular_price - $product->selling_price) / $product->regular_price) * 100) }}%
                                    OFF
                                </span>
                            @endif
                        </p>
                    </div>

                    <div class="text-base-content/80">
                        {!! $product->short_description !!}
                    </div>
                    <form action="{{ route('products.addToCart') }}" method="POST">
                        @csrf
                        <div class="flex flex-wrap lg:flex-nowrap items-center gap-3 mb-6">
                            <div class="max-w-32" data-input-number='{ "min": 1 }'>
                                <div class="input items-center">
                                    <button type="button"
                                        class="btn btn-primary btn-soft size-5.5 min-h-0 rounded-sm p-0"
                                        aria-label="Decrement button" data-input-number-decrement>
                                        <span class="icon-[tabler--minus] size-3.5 shrink-0"></span>
                                    </button>
                                    <input class="text-center" type="text" value="1" name="quantity"
                                        aria-label="Mini stacked buttons" data-input-number-input id="number-input-mini"
                                        readonly />
                                    <button type="button"
                                        class="btn btn-primary btn-soft size-5.5 min-h-0 rounded-sm p-0"
                                        aria-label="Increment button" data-input-number-increment>
                                        <span class="icon-[tabler--plus] size-3.5 shrink-0"></span>
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="product_id" value="{{ $product->id }}" />
                            <button class="btn btn-primary btn-gradient">
                                <span class="icon-[tabler--shopping-cart] size-5.5 shrink-0"></span>
                                Add To Cart
                            </button>

                            <a href="{{ route('account.addToWishlist', $product->id) }}"
                                class="btn btn-soft btn-primary">
                                <span class="icon-[tabler--heart] size-5.5 shrink-0"></span>
                                Add to Wishlist
                            </a>
                        </div>
                    </form>

                    <div class="space-y-3">
                        @if ($product->sku)
                            <p class="text-base/6 text-gray-700"><span
                                    class="text-base-content font-semibold">SKU</span> :
                                {{ $product?->sku }}</p>
                        @endif
                        @if ($product->barcode)
                            <p class="text-base/6 text-gray-700">
                                <span class="text-base-content font-semibold">Barcode (ISBN, UPC, GTIN, etc.)</span> :
                                {{ $product?->barcode }}
                            </p>
                        @endif
                        @if ($product->category_id)
                            <p class="text-base/6 text-gray-700"><span
                                    class="text-base-content font-semibold">Category</span>
                                :
                                <a class="text-primary-600 hover:underline"
                                    href="{{ route('products.byCategory', $product?->category) }}">{{ $product?->category?->name }}</a>
                            </p>
                        @endif
                        @if ($product->brand_id)
                            <p class="text-base/6 text-gray-700"><span
                                    class="text-base-content font-semibold">Brand</span>
                                :
                                <a class="text-primary-600 hover:underline"
                                    href="{{ route('products.byBrand', $product?->brand) }}">{{ $product?->brand?->name }}</a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="text-2xl font-semibold text-base-content">Product Details</h3>
                <div class="prose max-w-none">
                    {!! $product->long_description !!}
                </div>
            </div>
        </div>
    </div>
    <!-- product details section end -->

    <div class="bg-base-100 py-6 sm:py-10 lg:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"
            data-carousel='{ "loadingClasses": "opacity-0", "slidesQty": { "xs": 1, "lg": 4 }, "isInfiniteLoop": true }'>
            <div
                class="mb-6 space-y-4 md:mb-8 lg:mb-10 flex flex-col md:flex-row justify-between items-start md:items-center">
                <h2 class="text-base-content text-2xl font-semibold md:text-3xl lg:text-4xl">Related Products
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
                        @foreach ($product->relatedProducts(8) as $product)
                            <div class="carousel-slide h-full">
                                <x-products.card :product="$product" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.front>
