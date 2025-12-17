<x-layouts.admin>
    <div class="mx-auto space-y-6">

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
                    'text' => 'List',
                ],
            ];
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks title="Blog Posts" :addNewAction="route('admin.blogs.posts.create')" />

        <x-admin.table.search />

        {{-- Blog Posts Table --}}
        <div class="card">
            <div class="overflow-x-auto">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Category</th>
                            <th scope="col">Status</th>

                            <th scope="col" class="relative">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($blog_posts as $blog_post)
                            <tr>
                                <td class="font-semibold">{{ $blog_post->title }}</td>
                                <td>{{ $blog_post->slug }}</td>
                                <td>{{ $blog_post->blogCategory?->name }}</td>
                                <td>{{ $blog_post->status }}</td>

                                {{-- Actions --}}

                                <td class="space-x-1 text-right">
                                    <x-admin.links.edit :href="route('admin.blogs.posts.edit', $blog_post)" />

                                    <x-admin.links.delete :action="route('admin.blogs.posts.destroy', $blog_post)" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No Records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($blog_posts->hasPages())
                <div class="card-footer border-t border-gray-200 p-4">
                    {!! $blog_posts->links() !!}
                </div>
            @endif
        </div>
    </div>
</x-layouts.admin>
