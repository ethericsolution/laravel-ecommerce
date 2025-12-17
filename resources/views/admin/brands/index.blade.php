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
                    'text' => 'List',
                ],
            ];
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks title="Brands" :addNewAction="route('admin.brands.create')" />

        <x-admin.table.search />

        {{-- Brands Table --}}
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
                        @forelse ($brands as $brand)
                            <tr>
                                <td class="font-semibold">{{ $brand->name }}</td>
                                <td>{{ $brand->slug }}</td>
                                <td class="text-center">{{ $brand->products_count }}</td>

                                {{-- Actions --}}
                                <td class="space-x-1 text-right">
                                    <x-admin.links.edit :href="route('admin.brands.edit', $brand)" />
                                    <x-admin.links.delete :action="route('admin.brands.destroy', $brand)" />
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
            @if ($brands->hasPages())
                <div class="card-footer border-t border-gray-200 p-4">
                    {!! $brands->links() !!}
                </div>
            @endif
        </div>
    </div>
</x-layouts.admin>
