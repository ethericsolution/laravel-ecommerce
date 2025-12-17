<form method="post" action="{{ route('password.update') }}" class="space-y-4 max-w-xl">
    @csrf
    @method('put')

    <div class="space-y-1">
        <label for="update_password_current_password" class="label-text">
            Current Password
        </label>
        <input type="password" id="update_password_current_password" name="current_password"
            class="input  @error('current_password', 'updatePassword') is-invalid @enderror" />
        @error('current_password', 'updatePassword')
            <span class="helper-text">{{ $message }}</span>
        @enderror
    </div>

    <div class="space-y-1">
        <label for="update_password_password" class="label-text">
            New Password
        </label>
        <input type="password" id="update_password_password" name="password"
            class="input @error('password', 'updatePassword') is-invalid @enderror" />
        @error('password', 'updatePassword')
            <span class="helper-text">{{ $message }}</span>
        @enderror
    </div>

    <div class="space-y-1">
        <label for="update_password_password_confirmation" class="label-text">
            Confirm Password
        </label>
        <input type="password" id="update_password_password_confirmation" name="password_confirmation"
            class="input @error('password_confirmation', 'updatePassword') is-invalid @enderror" />
        @error('password_confirmation', 'updatePassword')
            <span class="helper-text">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Save Changes</button>
</form>
