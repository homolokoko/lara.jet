@props(['url','other','noResultMessage','itemHTML','minKeywordLength'])

<div
    class="absolute w-full"
    x-data=" {
        url: '{!! $url !!}',
        minKeywordLength:{{ $minKeywordLength ?? 3 }} ,
        open: false,
        componentOpen: false,
        selectedIndex: -1,
        search: '',
        results: [],
        selected: '',

        async searchNow() {
            await axios.post(this.url, {
                keyword: this.search
            }).then((r) => {
                this.results = r.data;
            });
        },

        init() {
            this.$watch('search', (v) => {
                if (v.trim().length >= this.minKeywordLength) {
                    this.searchNow();
                }
            });
        },

        selectItem(index) {
            this.open = false;
            this.selected = this.results[index];
            this.componentOpen = false;
        },

        onKeyDown(event) {
            if (event.key === 'ArrowDown') {
                event.preventDefault();
                if (this.selectedIndex < this.$refs.results.children.length - 1) {
                    this.selectedIndex++;
                } else {
                    this.selectedIndex = 0;
                }
            } else if (event.key === 'ArrowUp') {
                event.preventDefault();
                if (this.selectedIndex > 0) {
                    this.selectedIndex--;
                } else {
                    this.selectedIndex = this.$refs.results.children.length - 1;
                }
            } else if (event.key === 'Enter') {
                event.preventDefault();
                this.selectItem(this.selectedIndex);
            } else if (event.key === 'Escape') {
                this.open = false;
            }
        }
    }"
    x-show="componentOpen"
>
    {!! $other ?? '' !!}

    <div class="flex-col flex">
        <div class="relative">
            <input
                type="text"
                x-model="search"
                @focus="open = true"
                @keydown="onKeyDown($event)"
                class="w-full px-4 py-2 border focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Search..."/>

            <div x-show="search.length > 0" @click="search = ''; selected = ''"
                 x-transition:enter.duration.500ms="ease-in"
                 x-transition:leave.duration.500ms="ease-out"
                 class=" bg-gray-300 px-2 py-1 absolute top-0 right-0 m-1 space-x-2 rounded-md flex items-center">

                <x-heroicon-o-x-circle
                    class=" w-5 h-5 text-gray-500"
                />
                <span class=" text-gray-500"> Clear </span>
            </div>
        </div>
        <!--- Results lists -->
        <div
            wire:ignore.self
            x-show="results.length > 0"
            x-ref="results"
            class="z-50 w-full mt-1 bg-white rounded-b-lg shadow-lg border max-h-60 overflow-y-auto"
        >
            <template x-for="(item, index) in results" :key="index">
                <div
                    @click="selectItem(index)"
                    :class="{
                'px-4 py-2 cursor-pointer hover:bg-gray-100': true,
                'bg-blue-100': selectedIndex === index
            }"
                >
                    {!! $itemHTML !!}
                </div>
            </template>
        </div>

        <!-- Message for no result -->
        <div
            x-show="results.length == 0 && search.length >= minKeywordLength"
            class="z-50 bg-red-50 border-l-4 border-red-400 p-4 text-red-700 text-sm"
        >
            <p class="font-medium">
                {!! $noResultMessage ?? 'This is not available in the Apparel Ezi System. មិនមាននៅក្នុង System Apparel Ezi.' !!}
            </p>
        </div>

        <!-- Message for required keyword length -->
        <div
            x-show="search.length < minKeywordLength"
            class="z-50 bg-red-50 border-l-4 border-red-400 p-4 text-red-700 text-sm"
        >
            <p class="font-medium">
                The minimum keyword length is <span x-text=" minKeywordLength "></span> characters. មួយពាក្យយ៉ាងតិច3អក្សរ.
            </p>
        </div>

    </div>
</div>
