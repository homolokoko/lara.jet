<div x-data="{
    popup:false,
    search:'',
    param:{},
    list: [],
    get filterItems(){
        const fuseOptions = {
            // isCaseSensitive: true,
            // includeScore: true,
            // ignoreDiacritics: true,
            // shouldSort: true,
            // includeMatches: false,
            // findAllMatches: true,
            // minMatchCharLength: 1,
            // location: 0,
            // threshold: 0.6,
            // distance: 100,
            // useExtendedSearch: false,
            // ignoreLocation: false,
            // ignoreFieldNorm: false,
            // fieldNormWeight: 1,
            keys: ['text']
        };
        const fuse = new Fuse(this.list, fuseOptions);
        let fuseFilter = fuse.search(this.search);
        if(!this.search) return this.list;
        else return _.map(fuseFilter,obj => obj.item);
    }

}">
    <label class="button-group input-group">
        <span class="font-semibold uppercase">{{ $title }}</span>
        <input @focus="popup=true; $nextTick(()=>{ $refs.popSearchFilter.focus() })" x-model="param.text" placeholder="" class="input block input-ghost w-full input-bordered" readonly />
    </label>
    <div x-show="popup"
         x-transition:enter="transition ease-out duration-50"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100"
        class=" fixed top-0 z-10 left-0 w-screen h-screen">
        <div class="w-full h-full flex justify-center items-center bg-gray-500 bg-opacity-50">
            <div class="bg-white card card-bordered overflow-hidden rounded-2xl divide-y shadow-2xl max-w-xl w-3/4">
                <div class="block px-4 py-2 flex justify-between items-center">
                    <h3 class="font-bold text-lg tracking-wide uppercase">{{ $title }}</h3>
                    <button @click="popup=false" class="btn btn-sm btn-circle btn-ghost"><x-heroicon-o-x /></button>
                </div>
                <div>
                    <input x-ref="popSearchFilter"
                           x-model="search"
                           class="input w-full outline-none border-none input-ghost" placeholder="search ........">
                </div>
                <div class="block">
                    {{ $other  }}
                    <div class="overflow-auto max-h-56 flex justify-center flex-wrap gap-3 p-5">
                        <template x-for="(item, index) in filterItems" :key="index">
                            <button
                                @click="param=item;popup=false"
                                class="btn btn-md"
                                :class="{
                                    'btn-success':item.value===param.value,
                                    'btn-outline btn-success':item.value!==param.value
                                }" x-text="item.text"></button>
                        </template>

                    </div>
                </div>
{{--                <div class="block px-4 py-2 flex justify-evenly">--}}
{{--                    <button @click="submit()" class="btn btn-primary">Ok</button>--}}
{{--                    <button @click="popup=false" class="btn btn-ghost shadow-lg">Close</button>--}}
{{--                </div>--}}
            </div>
        </div>

    </div>


</div>
