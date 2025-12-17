<x-layouts.admin>
    <div class="max-w-7xl mx-auto space-y-6">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Profile',
                ],
                [
                    'text' => 'Edit',
                ],
            ];
            $title = 'Edit ' . $user->name;
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title />


        <div class="grid gap-6 grid-cols-1 md:grid-cols-2">

            <form method="post" action="{{ route('admin.profile.update') }}">
                @csrf
                @method('put')

                <div class="card">
                    <div class="card-header">
                        <h5 class="text-base-content text-lg font-medium">Basic Info</h5>
                    </div>
                    <div class="card-body space-y-2">
                        <div class="space-y-1">
                            <label for="name" class="label-text">Name</label>
                            <input type="text" name="name" id="name"
                                class="input @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}" />
                            @error('name')
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
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </form>

            <!--------Password --------->
            <form method="post" action="{{ route('admin.profile.password') }}">
                @csrf
                @method('put')

                <div class="card">
                    <div class="card-header">
                        <h5 class="text-base-content text-lg font-medium">Change Password</h5>
                    </div>
                    <div class="card-body space-y-2">
                        <div class="space-y-1">
                            <label for="update_password_current_password" class="label-text">
                                Current Password
                            </label>
                            <input type="password" name="current_password" id="update_password_current_password"
                                class="input @error('current_password', 'updatePassword') is-invalid @enderror" />
                            @error('current_password', 'updatePassword')
                                <p class="helper-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="update_password_password" class="label-text">New Password</label>
                            <input type="password" name="password" id="update_password_password"
                                class="input @error('password', 'updatePassword') is-invalid @enderror"
                                class="input @error('password', 'updatePassword') is-invalid @enderror" />
                            @error('password', 'updatePassword')
                                <p class="helper-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="update_password_password_confirmation" class="label-text">Confirm
                                Password</label>
                            <input type="password" name="password_confirmation"
                                id="update_password_password_confirmation"
                                class="input @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                                class="input @error('password_confirmation', 'updatePassword') is-invalid @enderror" />
                            @error('password_confirmation', 'updatePassword')
                                <p class="helper-text">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</x-layouts.admin>
