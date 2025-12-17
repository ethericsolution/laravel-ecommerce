<x-layouts.admin>
    <div class="max-w-7xl mx-auto space-y-6">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.categories.index'),
                    'text' => 'Categories',
                ],
                [
                    'text' => 'List',
                ],
            ];
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks title="Categories" :addNewAction="route('admin.categories.create')" />

        <x-admin.table.search />

        {{-- Category Table --}}
        <div class="card">
            <div class="overflow-x-auto">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col" class="text-center">Products</th>
                            <th scope="col" class="relative">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td class="font-semibold">{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td class="text-center">{{ $category->products_count }}</td>

                                {{-- Actions --}}
                                <td class="space-x-1 text-right">
                                    <x-admin.links.edit :href="route('admin.categories.edit', $category)" />
                                    <x-admin.links.delete :action="route('admin.categories.destroy', $category)" />
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
            @if ($categories->hasPages())
                <div class="card-footer border-t border-gray-200 p-4">
                    {!! $categories->links() !!}
                </div>
            @endif
        </div>
    </div>
</x-layouts.admin>
