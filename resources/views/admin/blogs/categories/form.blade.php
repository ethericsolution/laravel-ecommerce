<x-layouts.admin>
    <div class="max-w-7xl mx-auto space-y-6">

        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.blogs.categories.index'),
                    'text' => 'Blog Categories',
                ],
                [
                    'text' => $blog_category->id ? 'Edit' : 'Create',
                ],
            ];
            $title = $blog_category->id ? 'Edit ' . $blog_category->name : 'Create Blog Category';
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.blogs.categories.index')" />

        <form method="post"
            action="{{ $blog_category->id ? route('admin.blogs.categories.update', $blog_category) : route('admin.blogs.categories.store') }}"
            enctype="multipart/form-data" class="space-y-6">
            @csrf

            @isset($blog_category->id)
                @method('put')
            @endisset
            <div class="card">
                <div class="card-body" x-data="{
                    title: '{{ addslashes(old('name', $blog_category->name)) }}',
                    slug: '{{ old('slug', $blog_category->slug) }}'
                }">
                    <div class="grid md:grid-cols-2 gap-4">
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
                                rows="3"> {{ old('description', $blog_category->description) }}</textarea>
                            @error('description')
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
                                value="{{ old('seo_title', $blog_category->seo_title) }}" />
                            @error('seo_title')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="seo_description" class="label-text">SEO Description</label>
                            <textarea class="textarea @error('seo_description') is-invalid @enderror" id="seo_description" name="seo_description"
                                rows="3">{{ old('seo_description', $blog_category->seo_description) }}</textarea>
                            @error('seo_description')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-x-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.blogs.categories.index') }}" class="btn btn-soft">Cancel</a>
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
