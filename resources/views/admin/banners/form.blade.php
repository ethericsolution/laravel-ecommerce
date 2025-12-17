<x-layouts.admin>
    <div class="max-w-7xl mx-auto space-y-6">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.banners.index'),
                    'text' => 'Banners',
                ],
                [
                    'text' => $banner->id ? 'Edit' : 'Create',
                ],
            ];
            $title = $banner->id ? 'Edit ' . $banner->name : 'Create Banner';
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.banners.index')" />


        <form method="post"
            action="{{ $banner->id ? route('admin.banners.update', $banner) : route('admin.banners.store') }}"
            enctype="multipart/form-data">
            @csrf

            @isset($banner->id)
                @method('put')
            @endisset

            <div class="card">
                <div class="card-body">
                    <div class="grid md:grid-cols-2 gap-4">

                        <div class="space-y-1">
                            <label for="name" class="label-text">Name</label>
                            <input type="text" name="name" id="name"
                                class="input @error('name') is-invalid @enderror"
                                value="{{ old('name', $banner->name) }}" />
                            @error('name')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="image" class="label-text">Image</label>
                            <input id="image" name="image" type="file" class="input">
                        </div>

                        <div class="space-y-1">
                            <label for="link" class="label-text">Destination Link</label>
                            <input type="text" name="link" id="link"
                                class="input @error('link') is-invalid @enderror"
                                value="{{ old('link', $banner->link) }}" />
                            @error('link')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="location" class="label-text">Location</label>
                            <input type="text" name="location" id="location"
                                class="input @error('location') is-invalid @enderror"
                                value="{{ old('location', $banner->location ?? 'slider') }}" list="locationOption" />
                            <datalist id="locationOption">
                                <option value="slider">
                            </datalist>
                            @error('location')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex items-center gap-1">
                                <input type="hidden" name="is_new_tab" value="0" />
                                <input type="checkbox" class="switch switch-primary" id="is_new_tab" name="is_new_tab"
                                    value="1" @checked(old('is_new_tab', $banner->is_new_tab)) />
                                <label class="label-text text-base" for="is_new_tab"> Open in New tab </label>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <div class="flex items-center gap-1">
                                <input type="hidden" name="is_active" value="0" />
                                <input type="checkbox" class="switch switch-primary" id="is_active" name="is_active"
                                    value="1" @checked(old('is_active', $banner->is_active)) />
                                <label class="label-text text-base" for="is_active"> Active </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 space-x-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-soft">Cancel</a>
            </div>
        </form>
    </div>

</x-layouts.admin>
