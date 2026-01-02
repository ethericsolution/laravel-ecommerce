<div id="product-search-modal" class="overlay modal overlay-open:opacity-100 overlay-open:duration-300 hidden"
    role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="relative"
                data-combo-box='{
        "preventVisibility": true,
        "minSearchLength": 2,
          "isOpenOnFocus": true,
        "apiUrl": "{{ route('products.search') }}",
        "apiSearchQuery":"query",
        "outputItemTemplate": "<div class=\"dropdown-item combo-box-selected:dropdown-active\" data-combo-box-output-item> <div class=\"flex items-center justify-between\"> <a class=\"flex items-center w-full\" data-combo-box-output-item-attr=&apos;[{\"valueFrom\": \"url\", \"attr\": \"href\"}]&apos; > <div class=\"flex items-center justify-center rounded-box bg-base-200 size-12 overflow-hidden me-2.5\"> <img class=\"shrink-0\" data-combo-box-output-item-attr=&apos;[{\"valueFrom\": \"media_url\", \"attr\": \"src\"}, {\"valueFrom\": \"name\", \"attr\": \"alt\"}]&apos; /> </div> <div data-combo-box-output-item-field=\"name\" data-combo-box-search-text data-combo-box-value></div> </a> </div> </div>"
      }'>
                <!-- SearchBox -->
                <div class="modal-header block">
                    <div class="relative">
                        <input class="input ps-8" type="text" placeholder="Search Product" role="combobox"
                            aria-expanded="false" value="" autofocus="" data-combo-box-input="" />
                        <span
                            class="icon-[tabler--search] text-base-content absolute start-3 top-1/2 size-4 shrink-0 -translate-y-1/2"></span>
                    </div>
                </div>
                <!-- SearchBox Modal Body -->
                <div class="modal-body" data-combo-box-output="">
                    <div class="overflow-y-auto max-h-72 space-y-0.5" data-combo-box-output-items-wrapper=""></div>
                </div>
            </div>
        </div>
    </div>
</div>
