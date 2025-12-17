<x-layouts.admin>
    <div class="max-w-7xl mx-auto space-y-6">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.subscribers.index'),
                    'text' => 'Subscribers',
                ],
                [
                    'text' => 'List',
                ],
            ];
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks title="Subscribers" :addNewAction="route('admin.subscribers.create')" />

        <x-admin.table.search />

        {{-- Subscribers Table --}}
        <div class="card">
            <div class="overflow-x-auto">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="relative">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subscribers as $subscriber)
                            <tr>
                                <td class="font-semibold">{{ $subscriber->name }}</td>
                                <td>{{ $subscriber->email }}</td>

                                {{-- Actions --}}

                                <td class="space-x-1 text-right">
                                    <x-admin.links.edit :href="route('admin.subscribers.edit', $subscriber)" />

                                    <x-admin.links.delete :action="route('admin.subscribers.destroy', $subscriber)" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No Records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($subscribers->hasPages())
                <div class="card-footer border-t border-gray-200 p-4">
                    {!! $subscribers->links() !!}
                </div>
            @endif
        </div>
    </div>
</x-layouts.admin>
