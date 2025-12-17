<x-layouts.admin>
    <div class="max-w-7xl mx-auto space-y-6">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.taxes.index'),
                    'text' => 'Taxes',
                ],
                [
                    'text' => 'List',
                ],
            ];
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks title="Taxes" :addNewAction="route('admin.taxes.create')" />

        <x-admin.table.search />

        {{-- Taxes Table --}}
        <div class="card">
            <div class="overflow-x-auto">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Rate</th>
                            <th scope="col" class="relative">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($taxes as $tax)
                            <tr>
                                <td class="font-semibold">{{ $tax->name }}</td>
                                <td>{{ $tax->type }}</td>
                                <td>{{ $tax->rate }}</td>

                                {{-- Actions --}}
                                <td class="space-x-1 text-right">
                                    <x-admin.links.edit :href="route('admin.taxes.edit', $tax)" />
                                    <x-admin.links.delete :action="route('admin.taxes.destroy', $tax)" />
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
            @if ($taxes->hasPages())
                <div class="card-footer border-t border-gray-200 p-4">
                    {!! $taxes->links() !!}
                </div>
            @endif
        </div>
    </div>
</x-layouts.admin>
