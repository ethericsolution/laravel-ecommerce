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
                    'text' => $subscriber->id ? 'Edit' : 'Create',
                ],
            ];

            $title = $subscriber->id ? 'Edit ' . $subscriber->name : 'Create Subscriber';
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.subscribers.index')" />

        <form method="post"
            action="{{ $subscriber->id ? route('admin.subscribers.update', $subscriber) : route('admin.subscribers.store') }}">
            @csrf

            @isset($subscriber->id)
                @method('put')
            @endisset

            <div class="card">
                <div class="card-body">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label for="name" class="label-text">Name</label>
                            <input type="text" name="name" id="name"
                                value="{{ old('name', $subscriber->name) }}"
                                class="input @error('name') is-invalid @enderror" />
                            @error('name')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="email" class="label-text">Email</label>
                            <input type="text" name="email" id="email"
                                value="{{ old('email', $subscriber->email) }}"
                                class="input @error('email') is-invalid @enderror" />
                            @error('email')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 space-x-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.subscribers.index') }}" class="btn btn-soft">Cancel</a>
            </div>
        </form>
    </div>

</x-layouts.admin>
