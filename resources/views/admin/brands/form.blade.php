<x-layouts.admin>
    <div class="max-w-7xl mx-auto space-y-6">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.brands.index'),
                    'text' => 'Brands',
                ],
                [
                    'text' => $brand->id ? 'Edit' : 'Create',
                ],
            ];
            $title = $brand->id ? 'Edit ' . $brand->name : 'Create Brand';
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.brands.index')" />


        <form method="post"
            action="{{ $brand->id ? route('admin.brands.update', $brand) : route('admin.brands.store') }}"
            enctype="multipart/form-data">
            @csrf

            @isset($brand->id)
                @method('put')
            @endisset
            <div class="card">
                <div class="card-body">
                    <div class="grid md:grid-cols-2 gap-4" x-data="{
                        title: '{{ addslashes(old('name', $brand->name)) }}',
                        slug: '{{ old('slug', $brand->slug) }}'
                    }">
                        <div class="space-y-1">
                            <label for="name" class="label-text">Name</label>
                            <input type="text" name="name" id="name"
                                class="input @error('name') is-invalid @enderror" x-model="title"
                                @input="slug = slugify(title)" />
                            @error('name')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="slug" class="label-text">Slug</label>
                            <input type="text" name="slug" id="slug"
                                class="input @error('slug') is-invalid @enderror" x-model="slug" readonly />
                            @error('slug')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1 col-span-2">
                            <label for="description" class="label-text">Description</label>
                            <textarea class="textarea @error('description') is-invalid @enderror" id="description" name="description"
                                rows="3">{{ old('description', $brand->description) }}</textarea>
                            @error('description')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="featured-image" class="block text-sm/6 font-medium text-gray-900">Featured
                                Image</label>
                            <input id="featured-image" name="featured-image" type="file" class="input">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-6">
                <div class="card-header">
                    <h3 class="text-base-content text-lg font-medium">SEO</h3>
                </div>
                <div class="card-body">
                    <div class="grid gap-4">
                        <div class="space-y-1">
                            <label for="seo_title" class="label-text">SEO Title</label>
                            <input type="text" name="seo_title" id="seo_title"
                                class="input @error('seo_title') is-invalid @enderror"
                                value="{{ old('seo_title', $brand->seo_title) }}" />
                            @error('seo_title')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="seo_description" class="label-text">SEO Description</label>
                            <textarea class="textarea @error('seo_description') is-invalid @enderror" id="seo_description" name="seo_description"
                                rows="3">{{ old('seo_description', $brand->seo_description) }}</textarea>
                            @error('seo_description')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 space-x-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-soft">Cancel</a>
            </div>
        </form>
    </div>

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
</x-layouts.admin>
