<div class="space-y-6">
    @foreach (auth()->user()->wishlists as $product)
        <div
            class="card card-border sm:card-side max-w-sm sm:max-w-full hover:border-primary transition-border shadow-none duration-300">

            <div class="card-body sm:grid sm:grid-cols-12 sm:gap-6">
                <div class="sm:col-span-3">
                    <figure>
                        <a href="{{ route('products.show', $product) }}">
                            <img src="{{ $product?->thumbnailURL('thumb') }}" alt="{{ $product->name }}"
                                class="rounded-box" />
                        </a>
                    </figure>
                </div>
                <div class="sm:col-span-9">
                    <a href="{{ route('products.show', $product) }}">
                        <h5 class="card-title text-primary text-xl mb-0.5">{{ $product->name }}</h5>
                    </a>
                    <p class="mb-2 line-clamp-2">{{ $product->short_description }}</p>

                    <p class="mb-4">@money($product->selling_price)
                        @if ($product->regular_price > $product->selling_price)
                            <span class="line-through">@money($product->regular_price)</span>
                            <span class="badge badge-soft badge-success">
                                {{ round((($product->regular_price - $product->selling_price) / $product->regular_price) * 100) }}%
                                OFF
                            </span>
                        @endif
                    </p>
                    <div class="card-actions">
                        <form action="{{ route('products.addToCart') }}" method="POST" class="flex justify-end">
                            @csrf
                            <input type="hidden" name="quantity" value="1" />
                            <input type="hidden" name="product_id" value="{{ $product->id }}" />

                            <button class="btn btn-primary">
                                <span class="icon-[tabler--shopping-bag] size-5"></span>
                                Add to cart
                            </button>
                        </form>

                        <a href="{{ route('account.removeFromWishlist', $product->id) }}"
                            class="btn btn-outline btn-error">
                            <span class="icon-[tabler--trash] size-5"></span>
                            Remove from Wishlist
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
