<x-layouts.admin>
    <div class="max-w-7xl mx-auto space-y-6" x-data="contactQueryModal()">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.contactQueries.index'),
                    'text' => 'Contact Queries',
                ],
                [
                    'text' => 'List',
                ],
            ];
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks title="Contact Queries" />

        <x-admin.table.search />

        {{-- Contact Query Table --}}
        <div class="card">
            <div class="overflow-x-auto">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Subject</th>
                            <th scope="col" class="relative">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contactQueries as $contactQuery)
                            <tr>
                                <td class="font-semibold">{{ $contactQuery->name }}</td>
                                <td>{{ $contactQuery->email }}</td>
                                <td>{{ $contactQuery->phone }}</td>
                                <td>{{ $contactQuery->subject }}</td>

                                {{-- Actions --}}
                                <td class="space-x-1 text-right">
                                    <button class="link-primary"
                                        @click="showModal({
                                            name: '{{ addslashes($contactQuery->name) }}',
                                            email: '{{ addslashes($contactQuery->email) }}',
                                            phone: '{{ addslashes($contactQuery->phone) }}',
                                            subject: '{{ addslashes($contactQuery->subject) }}',
                                            message: `{{ addslashes($contactQuery->message) }}`
                                        })">
                                        <i data-lucide="eye" class="size-5"></i>
                                    </button>

                                    <x-admin.links.delete :action="route('admin.contactQueries.destroy', $contactQuery)" />
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
            @if ($contactQueries->hasPages())
                <div class="card-footer border-t border-gray-200 p-4">
                    {!! $contactQueries->links() !!}
                </div>
            @endif
        </div>

        <!-- Shared Modal -->
        <div x-on:keydown.escape.window="open = false" x-show="open" x-transition @click.away="close()"
            class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500/75" x-cloak>
            <div @click.stop class="bg-white p-6 rounded shadow w-1/3">
                <h2 class="text-lg font-semibold mb-4">Contact Query Details</h2>
                <p><strong>Name:</strong> <span x-text="data.name"></span></p>
                <p><strong>Email:</strong> <span x-text="data.email"></span></p>
                <p><strong>Phone:</strong> <span x-text="data.phone"></span></p>
                <p><strong>Subject:</strong> <span x-text="data.subject"></span></p>
                <p><strong>Message:</strong> <span x-text="data.message"></span></p>
                <button @click="close()"
                    class="mt-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Close</button>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function contactQueryModal() {
                return {
                    open: false,
                    data: {
                        name: '',
                        email: '',
                        phone: '',
                        subject: '',
                        message: '',
                    },
                    showModal(query) {
                        this.data = query;
                        this.open = true;
                    },
                    close() {
                        this.open = false;
                    }
                };
            }
        </script>
    @endpush
</x-layouts.admin>
