<div class="card shadow-none border">
    <div class="card-body text-center">
        <!-- Watch Image -->
        <a href="{{ route('products.show', $product) }}">
            <img src="{{ $product->thumbnailURL('thumb') }}" alt="{{ $product?->name }}"
                class="mb-6 h-49 w-full object-contain" />
            <h3 class="text-base-content text-lg font-medium">{{ $product?->name }}</h3>
        </a>

        <!-- Badges -->
        {{--  <div class="flex justify-center gap-2">
            <span class="badge badge-soft badge-success">Watch</span>
            <span class="badge badge-soft badge-success">Apple</span>
        </div> --}}

        <!-- Divider -->
        <div class="divider my-2"></div>

        <div class="flex items-center justify-between">
            <span class="text-base-content text-xl font-semibold">@money($product->selling_price)</span>
            <div>
                <a href="{{ route('account.addToWishlist', $product) }}" class="btn btn-circle btn-text btn-secondary"
                    data-product-name="{{ $product->name }}" aria-label="Add {{ $product->name }} to wishlist">
                    <span class="icon-[tabler--heart] size-5.5 shrink-0"></span>
                </a>
                <form action="{{ route('products.addToCart') }}" method="POST" class="inline-block">
                    @csrf
                    <input type="hidden" name="quantity" value="1" />
                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                    <button class="btn btn-circle btn-text btn-secondary" data-product-name="{{ $product->name }}"
                        aria-label="Add {{ $product->name }} to cart">
                        <span class="icon-[tabler--shopping-cart] size-5.5 shrink-0"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
