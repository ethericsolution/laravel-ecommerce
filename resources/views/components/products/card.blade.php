<div class="card">
    <figure class="bg-base-200">
        <a href="{{ route('products.show', $product) }}">
            <img src="{{ $product->thumbnailURL('thumb') }}" alt="{{ $product?->name }}" />
        </a>
    </figure>

    <a href="{{ route('account.addToWishlist', $product) }}"
        class="btn btn-circle btn-sm btn-primary shadow-none [--btn-color:var(--color-base-100)] text-base-content absolute top-4 right-4"
        data-product-name="{{ $product->name }}" aria-label="Add {{ $product->name }} to wishlist">
        <span class="icon-[tabler--heart] size-4.5 shrink-0"></span>
    </a>

    <div class="card-body gap-3">
        <h3 class="text-base-content text-lg font-medium line-clamp-2">
            <a class="hover:text-primary" href="{{ route('products.show', $product) }}">
                {{ $product?->name }}
            </a>
        </h3>
        <p class="text-base-content/80 text-lg font-medium">@money($product->selling_price)</p>
        <form action="{{ route('products.addToCart') }}" method="POST">
            @csrf
            <input type="hidden" name="quantity" value="1" />
            <input type="hidden" name="product_id" value="{{ $product->id }}" />
            <button
                class="btn not-hover:btn-outline hover:btn-primary hover:btn-gradient border-base-content/20 rounded-box w-full"
                data-product-name="{{ $product->name }}" aria-label="Add {{ $product->name }} to cart">
                <span class="icon-[tabler--shopping-cart] size-5.5 shrink-0"></span>
                Add to Cart
            </button>
        </form>
    </div>
</div>
