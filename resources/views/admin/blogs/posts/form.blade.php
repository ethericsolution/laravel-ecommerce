<x-layouts.admin>
    <div class="max-w-7xl mx-auto space-y-6">

        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.blogs.posts.index'),
                    'text' => 'Blog Posts',
                ],
                [
                    'text' => $blog_post->id ? 'Edit' : 'Create',
                ],
            ];
            $title = $blog_post->id ? 'Edit ' . $blog_post->title : 'Create Blog Post';
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.blogs.posts.index')" />

        <form method="post"
            action="{{ $blog_post->id ? route('admin.blogs.posts.update', $blog_post) : route('admin.blogs.posts.store') }}"
            enctype="multipart/form-data">
            @csrf

            @isset($blog_post->id)
                @method('put')
            @endisset

            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 lg:col-span-8 space-y-6">
                    <div class="card">
                        <div class="card-body" x-data="{
                            title: '{{ addslashes(old('title', $blog_post->title)) }}',
                            slug: '{{ old('slug', $blog_post->slug) }}'
                        }">
                            <div class="space-y-1">
                                <label for="title" class="label-text">Title</label>
                                <input type="text" name="title" id="title"
                                    class="input @error('title') is-invalid @enderror" x-model="title"
                                    @input="slug = slugify(title)" />
                                @error('title')
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

                    <div class="mt-6">
                        <h3 class="block text-base/tight font-medium text-gray-700 mb-4">Content</h3>
                        <x-forms.rich-text-editor name="content">{!! old('content', $blog_post->content) !!}</x-forms.rich-text-editor>
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
                                        value="{{ old('seo_title', $blog_post->seo_title) }}" />
                                    @error('seo_title')
                                        <span class="helper-text">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="space-y-1">
                                    <label for="seo_description" class="label-text">SEO
                                        Description</label>
                                    <textarea class="textarea @error('seo_description') is-invalid @enderror" id="seo_description" name="seo_description"
                                        rows="3">{{ old('seo_description', $blog_post->seo_description) }}</textarea>
                                    @error('seo_description')
                                        <span class="helper-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4 space-y-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-base-content text-lg font-medium">Status</h3>
                        </div>
                        <div class="card-body">
                            <select name="status" id="status" class="select @error('status') is-invalid @enderror">
                                <option value="published" @selected(old('status', $blog_post->published) == 'published')>
                                    Published
                                </option>
                                <option value="draft" @selected(old('status', $blog_post->draft) == 'draft')>
                                    Draft
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-base-content text-lg font-medium">Associations</h3>
                        </div>
                        <div class="card-body">
                            <div class="space-y-4">

                                <div class="space-y-1">
                                    <label for="blog_category_id" class="label-text">Category</label>
                                    <select id="blog_category_id" name="blog_category_id" @class(['select', 'is-invalid' => $errors->has('blog_category_id')])
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
                                        @foreach ($blog_categories as $key => $category)
                                            <option value="{{ $key }}" @selected(old('blog_category_id', $blog_post->blog_category_id) == $key)>
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('blog_category_id')
                                        <span class="helper-text">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="space-y-1">
                                    <label for="published_at" class="label-text">Published At</label>
                                    <input type="date" name="published_at" id="published_at"
                                        class="input @error('published_at') is-invalid @enderror"
                                        value="{{ old('published_at', $blog_post->published_at?->format('Y-m-d') ?? now()->format('Y-m-d')) }}" />
                                    @error('published_at')
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
                                <input id="image" name="image" type="file" @class(['input', 'is-invalid' => $errors->has('blog_category_id')]) />
                                @error('image')
                                    <span class="helper-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="mt-6 space-x-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.blogs.posts.index') }}" class="btn btn-soft">Cancel</a>
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
