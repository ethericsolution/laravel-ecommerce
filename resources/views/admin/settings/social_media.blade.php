<x-layouts.admin>


    <div class="max-w-7xl mx-auto space-y-6">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.settings.general'),
                    'text' => 'Social Media Links',
                ],
            ];

            $title = 'Social Media Links';

        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title />


        <form method="post" action="{{ route('admin.settings.store') }}">
            @csrf

            <input type="hidden" name="group_name" value="social_media" />
            <div class="card">
                <div class="card-body">
                    <div class="grid md:grid-cols-2 gap-4">

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="facebook" class="label-text">Facebook</label>
                                <span class="helper-text" id="facebook-optional">setting('social.facebook')</span>
                            </div>
                            <input type="text" name="facebook" id="facebook"
                                class="input @error('facebook') is-invalid @enderror"
                                value="{{ old('facebook', $settings->facebook) }}" />
                            @error('facebook')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="instagram" class="label-text">Instagram</label>
                                <span class="helper-text" id="instagram-optional">setting('social.instagram')</span>
                            </div>
                            <input type="text" name="instagram" id="instagram"
                                class="input @error('instagram') is-invalid @enderror"
                                value="{{ old('instagram', $settings->instagram) }}" />
                            @error('instagram')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="youtube" class="label-text">YouTube</label>
                                <span class="helper-text" id="youtube-optional">setting('social.youtube')</span>
                            </div>
                            <input type="text" name="youtube" id="youtube"
                                class="input @error('youtube') is-invalid @enderror"
                                value="{{ old('youtube', $settings->youtube) }}" />
                            @error('youtube')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <label for="twitter" class="label-text">Twitter</label>
                                <span class="helper-text" id="twitter-optional">setting('social.twitter')</span>
                            </div>
                            <input type="text" name="twitter" id="twitter"
                                class="input @error('twitter') is-invalid @enderror"
                                value="{{ old('twitter', $settings->twitter) }}" />
                            @error('twitter')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="mt-6 space-x-2">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</x-layouts.admin>
