<div class="sm:grid sm:grid-cols-6 sm:items-start sm:gap-4">
    <div class="mt-2 sm:col-span-6 sm:mt-0 grid grid-cols-1">

        <div class="relative" x-data="productCombobox(item)">
            <input x-model="query" @input="searchProducts" @focus="open = !open"
                @keydown.arrow-down.prevent="highlightNext()" @keydown.arrow-up.prevent="highlightPrev()"
                @keydown.enter.prevent="selectHighlighted()" x-on:mouseout="highlighted = -1" id="product_combobox"
                type="text" name="product_name" id="product_name"
                class="input @error('product_id') is-invalid @enderror" role="combobox" :aria-expanded="open"
                autocomplete="off">

            <input type="hidden" :name="'items[' + index + '][product_id]'" id="product_id" x-model="selectedId" />

            <input type="hidden" :name="'items[' + index + '][name]'" x-model="query" />

            <button type="button"
                class="absolute inset-y-0 right-0 flex items-center rounded-r-lg px-2 focus:outline-hidden"
                @click="open = !open">
                <svg class="size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                    data-slot="icon">
                    <path fill-rule="evenodd"
                        d="M10.53 3.47a.75.75 0 0 0-1.06 0L6.22 6.72a.75.75 0 0 0 1.06 1.06L10 5.06l2.72 2.72a.75.75 0 1 0 1.06-1.06l-3.25-3.25Zm-4.31 9.81 3.25 3.25a.75.75 0 0 0 1.06 0l3.25-3.25a.75.75 0 1 0-1.06-1.06L10 14.94l-2.72-2.72a.75.75 0 0 0-1.06 1.06Z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <ul class="absolute z-100 mt-1 max-h-60 w-full overflow-auto rounded-lg bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-hidden sm:text-sm"
                role="listbox" x-show="open && results.length" @click.away="open = !open">
                <template x-for="(item, i) in results" :key="item.id">
                    <li class="relative cursor-default py-2 pr-9 pl-3 text-gray-900 select-none" id="option-0"
                        role="option" tabindex="-1"
                        :class="{
                            'text-white bg-primary-600 outline-hidden': selectedId ==
                                item
                                .id,
                            'text-white bg-primary-600 outline-hidden': highlighted ==
                                i,
                        }"
                        @click="selectProduct(item)" @mouseenter="highlighted = i">
                        <span class="block truncate"
                            :class="{
                                'font-semibold': selectedId == item.id
                            }"
                            x-text="item.name"></span>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-primary-600"
                            :class="{
                                'text-white': selectedId == item.id,
                                'text-white': highlighted == i,
                            }"
                            x-show="selectedId == item.id">
                            <svg class="size-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                                data-slot="icon">
                                <path fill-rule="evenodd"
                                    d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </li>
                </template>
            </ul>
        </div>
    </div>
</div>

<script>
    function productCombobox(itemRef) {

        return {
            open: false,
            query: itemRef['name'] ?? '',
            results: [],
            highlighted: -1,
            selectedId: itemRef['product_id'] ?? '',

            searchProducts() {

                if (this.query.length < 1) {
                    this.results = [];
                    return;
                }
                fetch(`{{ route('admin.products.search') }}?q=${encodeURIComponent(this.query)}`)
                    .then(res => res.json())
                    .then(data => {
                        this.results = data;
                        this.highlighted = -1;
                        this.selectedId = "";
                    });
            },

            highlightNext() {
                if (this.results.length === 0) return;
                this.highlighted = (this.highlighted + 1) % this.results.length;
            },
            highlightPrev() {
                if (this.results.length === 0) return;
                this.highlighted = (this.highlighted - 1 + this.results.length) % this.results.length;
            },
            selectHighlighted() {
                if (this.highlighted >= 0 && this.results[this.highlighted]) {
                    this.selectProduct(this.results[this.highlighted]);
                }
            },
            selectProduct(item) {
                this.query = item.name;
                this.selectedId = item.id;
                this.open = false;

                itemRef.price = item.selling_price;
                // float to 2 decimal places
                itemRef.total = parseFloat(item.selling_price * itemRef.quantity).toFixed(2);

                // Trigger tax breakdown calculation
                this.$dispatch('product-selected');
            }
        }
    }
</script>
