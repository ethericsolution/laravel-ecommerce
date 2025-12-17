<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    <div class="grid md:grid-cols-2 gap-6">

        <div class="space-y-1">
            <label for="first_name" class="label-text">
                First Name
            </label>
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                class="input @error('first_name') is-invalid @enderror" />
            @error('first_name')
                <span class="helper-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="last_name" class="label-text">
                Last Name
            </label>
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                class="input @error('last_name') is-invalid @enderror" />
            @error('last_name')
                <span class="helper-text">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <div class="grid md:grid-cols-2 gap-4 py-5">
        <div class="space-y-1">
            <label for="email" class="label-text">
                Email
            </label>
            <input type="text" id="email" name="email" value="{{ old('email', $user->email) }}"
                class="input @error('email') is-invalid @enderror" />
            @error('email')
                <span class="helper-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="space-y-1">
            <label for="phone" class="label-text">
                Phone
            </label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                class="input @error('phone') is-invalid @enderror" />
            @error('phone')
                <span class="helper-text">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Save Changes</button>

</form>
