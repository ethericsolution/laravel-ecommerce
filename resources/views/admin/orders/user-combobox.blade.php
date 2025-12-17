<div class="relative" x-data="userCombobox()">
    <input x-model="query" @input="searchUsers" @focus="open = !open" @keydown.arrow-down.prevent="highlightNext()"
        @keydown.arrow-up.prevent="highlightPrev()" @keydown.enter.prevent="selectHighlighted()"
        x-on:mouseout="highlighted = -1" id="user_combobox" type="text" name="user_name" id="user_name"
        class="input @error('user_id') is-invalid @enderror" role="combobox" :aria-expanded="open" autocomplete="off">
    <input type="hidden" name="user_id" id="user_id" x-model="selectedId" />
    <button type="button" class="absolute inset-y-0 right-0 flex items-center rounded-r-lg px-2 focus:outline-hidden"
        @click="open = !open">
        <i data-lucide="chevrons-up-down" class="size-5 text-gray-400"></i>
    </button>

    <ul class="absolute z-100 mt-1 max-h-60 w-full overflow-auto rounded-lg bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-hidden sm:text-sm"
        role="listbox" x-show="open && results.length" @click.away="open = !open">
        <template x-for="(item, i) in results" :key="item.id">
            <li class="relative cursor-default py-2 pr-9 pl-3 text-gray-900 select-none" id="option-0" role="option"
                tabindex="-1"
                :class="{
                    'text-white bg-primary-600 outline-hidden': selectedId == item
                        .id,
                    'text-white bg-primary-600 outline-hidden': highlighted == i,
                }"
                @click="selectUser(item)" @mouseenter="highlighted = i">
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
                    <i data-lucide="check" class="size-5"></i>
                </span>
            </li>
        </template>
    </ul>
</div>

<script>
    function userCombobox() {
        return {
            open: false,
            query: "{{ old('user_name', $order->user->name ?? '') }}",
            results: [],
            highlighted: -1,
            selectedId: "{{ old('user_id', $order->user_id) }}",
            searchUsers() {
                if (this.query.length < 1) {
                    this.results = [];
                    return;
                }
                fetch(`{{ route('admin.users.search') }}?q=${encodeURIComponent(this.query)}`)
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
                    this.selectUser(this.results[this.highlighted]);
                }
            },
            selectUser(item) {
                this.query = item.name;
                this.selectedId = item.id;
                this.open = false;
            }
        }
    }
</script>
