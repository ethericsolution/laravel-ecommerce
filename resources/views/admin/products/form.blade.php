<x-layouts.admin>
    <div class="max-w-7xl mx-auto space-y-6">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.products.index'),
                    'text' => 'Products',
                ],
                [
                    'text' => $product->id ? 'Edit' : 'Create',
                ],
            ];
            $title = $product->id ? 'Edit ' . $product->name : 'Create Product';
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.products.index')" />


        <form method="post"
            action="{{ $product->id ? route('admin.products.update', $product) : route('admin.products.store') }}"
            enctype="multipart/form-data">
            @csrf

            @isset($product->id)
                @method('put')
            @endisset

            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 lg:col-span-8 space-y-6">
                    <div class="card">
                        <div class="card-body" x-data="{
                            title: '{{ addslashes(old('name', $product->name)) }}',
                            slug: '{{ old('slug', $product->slug) }}'
                        }">
                            <div class="space-y-1">
                                <label for="name" class="label-text">Name</label>
                                <input type="text" name="name" id="name"
                                    class="input @error('name') is-invalid @enderror" x-model="title"
                                    @input="slug = slugify(title)" />
                                @error('name')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror

                                <p class="text-sm text-gray-600">
                                    <strong>Slug : </strong>
                                    <span x-text="slug"></span>
                                    <input type="hidden" name="slug" :value="slug" />
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="block text-base/tight font-medium text-gray-700 mb-4">Short Description</h3>
                        <x-forms.rich-text-editor
                            name="short_description">{!! old('short_description', $product->short_description) !!}</x-forms.rich-text-editor>
                    </div>

                    <div>
                        <h3 class="block text-base/tight font-medium text-gray-700 mb-4">Long Description</h3>
                        <x-forms.rich-text-editor
                            name="long_description">{!! old('long_description', $product->long_description) !!}</x-forms.rich-text-editor>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-base-content text-lg font-medium">Pricing</h3>
                        </div>
                        <div class="card-body">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label for="regular_price" class="label-text">Regular Price</label>
                                    <input type="text" name="regular_price" id="regular_price"
                                        class="input @error('regular_price') is-invalid @enderror"
                                        value="{{ old('regular_price', $product->regular_price) }}" />
                                    @error('regular_price')
                                        <span class="helper-text">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="space-y-1">
                                    <label for="selling_price" class="label-text">Selling Price</label>
                                    <input type="text" name="selling_price" id="selling_price"
                                        class="input @error('selling_price') is-invalid @enderror"
                                        value="{{ old('selling_price', $product->selling_price) }}" />
                                    @error('selling_price')
                                        <span class="helper-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-base-content text-lg font-medium">Inventory</h3>
                        </div>
                        <div class="card-body">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label for="sku" class="label-text">SKU (Stock Keeping
                                        Unit)</label>
                                    <input type="text" name="sku" id="sku"
                                        class="input @error('sku') is-invalid @enderror"
                                        value="{{ old('sku', $product->sku) }}" />
                                    @error('sku')
                                        <span class="helper-text">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="space-y-1">
                                    <label for="barcode" class="label-text">Barcode (ISBN, UPC, GTIN,
                                        etc.)</label>
                                    <input type="text" name="barcode" id="barcode"
                                        class="input @error('barcode') is-invalid @enderror"
                                        value="{{ old('barcode', $product->barcode) }}" />
                                    @error('barcode')
                                        <span class="helper-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-base-content text-lg font-medium">SEO</h3>
                        </div>
                        <div class="card-body">
                            <div class="grid gap-4">
                                <div class="space-y-1">
                                    <label for="seo_title" class="label-text">SEO Title</label>
                                    <input type="text" name="seo_title" id="seo_title"
                                        class="input @error('seo_title') is-invalid @enderror"
                                        value="{{ old('seo_title', $product->seo_title) }}" />
                                    @error('seo_title')
                                        <span class="helper-text">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="space-y-1">
                                    <label for="seo_description" class="label-text">SEO
                                        Description</label>
                                    <textarea class="textarea @error('seo_description') is-invalid @enderror" id="seo_description" name="seo_description"
                                        rows="3">{{ old('seo_description', $product->seo_description) }}</textarea>
                                    @error('seo_description')
                                        <span class="helper-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-4  space-y-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-base-content text-lg font-medium">Status</h3>
                        </div>
                        <div class="card-body">
                            <div class="flex items-center gap-1">
                                <input type="hidden" name="is_featured" value="0" />
                                <input type="checkbox" class="switch switch-primary" id="is_featured"
                                    name="is_featured" value="1" @checked(old('is_featured', $product->is_featured)) />
                                <label class="label-text text-base" for="is_featured"> Featured Product </label>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-base-content text-lg font-medium">Associations</h3>
                        </div>
                        <div class="card-body">
                            <div class="space-y-4">
                                <div class="space-y-1">
                                    <label for="brand_id" class="label-text">Brand</label>
                                    <select id="brand_id" name="brand_id" @class(['select', 'is-invalid' => $errors->has('brand_id')])
                                        data-select='{
                                            "placeholder": "Select",
                                            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                            "toggleClasses": "advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40",
                                            "hasSearch": true,
                                            "dropdownClasses": "advance-select-menu max-h-52 pt-0 overflow-y-auto",
                                            "optionClasses": "advance-select-option selected:select-active",
                                            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
                                            "extraMarkup": "<span class=\"icon-[tabler--chevron-down] shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \"></span>"
                                            }'>
                                        <option value="">{{ __('Select Brand') }}</option>
                                        @foreach ($brands as $key => $brand)
                                            <option value="{{ $key }}" @selected(old('brand_id', $product->brand_id) == $key)>
                                                {{ $brand }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <span class="helper-text">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="space-y-1">
                                    <label for="category_id" class="label-text">Category</label>
                                    <select id="category_id" name="category_id" @class(['select', 'is-invalid' => $errors->has('category_id')])
                                        data-select='{
                                            "placeholder": "Select",
                                            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                            "toggleClasses": "advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40",
                                            "hasSearch": true,
                                            "dropdownClasses": "advance-select-menu max-h-52 pt-0 overflow-y-auto",
                                            "optionClasses": "advance-select-option selected:select-active",
                                            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
                                            "extraMarkup": "<span class=\"icon-[tabler--chevron-down] shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \"></span>"
                                            }'>
                                        <option value="">{{ __('Select Category') }}</option>
                                        @foreach ($categories as $key => $category)
                                            <option value="{{ $key }}" @selected(old('category_id', $product->category_id) == $key)>
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="helper-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-base-content text-lg font-medium">Featured Image</h3>
                        </div>
                        <div class="card-body">
                            <div class="space-y-1">
                                <input id="featured-image" name="featured-image" type="file"
                                    @class(['input', 'is-invalid' => $errors->has('category_id')]) />
                                @error('featured-image')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-base-content text-lg font-medium">Product Gallery Images</h3>
                        </div>
                        <div class="card-body">
                            <div class="space-y-1">
                                <input id="product-images" name="product-images[]" type="file"
                                    @class(['input', 'is-invalid' => $errors->has('category_id')]) multiple />
                                @error('product-images')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 space-x-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-soft">Cancel</a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            function slugify(str) {
                return str
                    .trim()
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
            }
        </script>
    @endpush
</x-layouts.admin>
