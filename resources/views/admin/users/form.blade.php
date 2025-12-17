<x-layouts.admin>
    <div class="max-w-7xl mx-auto space-y-6">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.users.index'),
                    'text' => 'Users',
                ],
                [
                    'text' => $user->id ? 'Edit' : 'Create',
                ],
            ];
            $title = $user->id ? 'Edit ' . $user->name : 'Create User';
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.users.index')" />

        <form method="post" action="{{ $user->id ? route('admin.users.update', $user) : route('admin.users.store') }}">
            @csrf

            @isset($user->id)
                @method('put')
            @endisset

            <div class="card">
                <div class="card-body">
                    <div class="grid md:grid-cols-2 gap-4">

                        <div class="space-y-1">
                            <label for="first_name" class="label-text">First Name</label>
                            <input type="text" name="first_name" id="first_name"
                                class="input @error('first_name') is-invalid @enderror"
                                value="{{ old('first_name', $user->first_name) }}" />
                            @error('first_name')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="last_name" class="label-text">Last Name</label>
                            <input type="text" name="last_name" id="last_name"
                                class="input @error('last_name') is-invalid @enderror"
                                value="{{ old('last_name', $user->last_name) }}" />
                            @error('last_name')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="email" class="label-text">Email</label>
                            <input type="text" name="email" id="email"
                                class="input @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}" />
                            @error('email')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="phone" class="label-text">Phone</label>
                            <input type="text" name="phone" id="phone"
                                class="input @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $user->phone) }}" />
                            @error('phone')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>


                        <!---  password------->
                        <div class="space-y-1">
                            <label for="password" class="label-text">Password</label>
                            <input type="password" name="password" id="password"
                                class="input @error('password') is-invalid @enderror" />
                            @error('password')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="mt-6 space-x-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-soft">Cancel</a>
            </div>
        </form>
    </div>

</x-layouts.admin>
