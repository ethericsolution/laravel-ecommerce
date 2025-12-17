<x-layouts.admin>
    <div class="mx-auto space-y-6">
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
                    'text' => 'List',
                ],
            ];
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks title="Products" :addNewAction="route('admin.products.create')" />

        <x-admin.table.search />

        {{-- Products Table --}}
        <div class="card">
            <div class="overflow-x-auto">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Regular Price</th>
                            <th scope="col">Selling Price</th>
                            <th scope="col">Category</th>
                            <th scope="col">Brand</th>
                            <th scope="col" class="text-center">View Count</th>
                            <th scope="col" class="relative">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="bg-base-content/10 h-10 w-10 rounded-md">
                                                <img src="{{ $product?->thumbnailURL('thumb') }}"
                                                    alt="{{ $product->name }}" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-medium">{{ $product->name }}</div>
                                            <div class="text-sm opacity-50">{{ $product->slug }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>@money($product->regular_price)</td>
                                <td>@money($product->selling_price)</td>
                                <td>{{ $product->category?->name }}</td>
                                <td>{{ $product->brand?->name }}</td>
                                <td class="text-center">{{ $product->view_count }}</td>

                                {{-- Actions --}}
                                <td class="space-x-1 text-right">
                                    <a href="{{ route('products.show', $product->slug) }}"
                                        class="btn btn-circle btn-text btn-sm" target="_blank">
                                        <span class="icon-[tabler--eye] size-5"></span>
                                    </a>
                                    <x-admin.links.edit :href="route('admin.products.edit', $product)" />
                                    <x-admin.links.delete :action="route('admin.products.destroy', $product)" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No Records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($products->hasPages())
                <div class="card-footer border-t border-gray-200 p-4">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.admin>
