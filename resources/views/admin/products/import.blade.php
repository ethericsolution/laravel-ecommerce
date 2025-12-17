<x-layouts.admin>
    <div class="max-w-7xl mx-auto space-y-6">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.products.index'),
                    'text' => 'Products',
                ],
                [
                    'text' => 'Import',
                ],
            ];
            $title = 'Import Product';
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.products.index')" />


        <form method="post" action="{{ route('admin.products.import.store') }}">
            @csrf

            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-base-content text-lg font-medium">Import Product</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="space-y-2">
                            <label for="sku" class="label-text">SKU</label>
                            <input type="text" name="sku" id="sku"
                                class="input @error('sku') is-invalid @enderror" value="{{ old('sku') }}" required />
                            @error('sku')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="barcode" class="label-text">Barcode</label>
                            <input type="text" name="barcode" id="barcode"
                                class="input @error('barcode') is-invalid @enderror" value="{{ old('barcode') }}"
                                required />
                            @error('barcode')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="price" class="label-text">Price</label>
                            <input type="text" name="price" id="price"
                                class="input @error('price') is-invalid @enderror" value="{{ old('price') }}"
                                required />
                            @error('price')
                                <span class="helper-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</x-layouts.admin>
