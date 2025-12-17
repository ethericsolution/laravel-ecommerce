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
                    'text' => 'List',
                ],
            ];
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks title="Blog Categories" :addNewAction="route('admin.blogs.categories.create')" />

        <x-admin.table.search />

        {{-- Blog-Categories Table --}}
        <div class="card">
            <div class="overflow-x-auto">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col" class="text-center">Blogs</th>

                            <th scope="col" class="relative">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($blog_categories as $blog_category)
                            <tr>
                                <td class="font-semibold">{{ $blog_category->name }}</td>
                                <td>{{ $blog_category->slug }}</td>
                                <td class="text-center">{{ $blog_category->posts_count }}</td>

                                {{-- Actions --}}

                                <td class="space-x-1 text-right">
                                    <x-admin.links.edit :href="route('admin.blogs.categories.edit', $blog_category)" />

                                    <x-admin.links.delete :action="route('admin.blogs.categories.destroy', $blog_category)" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No Records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($blog_categories->hasPages())
                <div class="card-footer border-t border-gray-200 p-4">
                    {!! $blog_categories->links() !!}
                </div>
            @endif
        </div>
    </div>
</x-layouts.admin>
