<div class="card relative overflow-hidden shadow-none">
    <figure class="size-full">
        <img src="{{ $category?->thumbnailURL('thumb') }}" alt="{{ $category->name }}" class="size-full object-cover"
            loading="lazy" fetchpriority="low" />
    </figure>
    <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-b from-transparent to-black/30"></div>
    <div class="absolute start-6 bottom-6">
        <a href="{{ route('products.byCategory', $category) }}">
            <h3 class="mb-1 text-2xl font-bold text-white">{{ $category->name }}</h3>
        </a>
        <p class="mb-6 text-white">{{ $category->products_count }} Products</p>
        <a href="{{ route('products.byCategory', $category) }}" class="btn btn-success btn-sm">Shop Now</a>
    </div>
</div>
