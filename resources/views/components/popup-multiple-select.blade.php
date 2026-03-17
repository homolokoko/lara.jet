<div x-data="{
    popup:false,
    search:'',
    params:[],
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
    <button @click="popup=true; $nextTick(()=>{ $refs.popSearchFilter.focus() })"
        class="flex w-full overflow-hidden rounded-lg">
        <label class="bg-gray-300 font-semibold px-3 py-2">{{ $title }}</label>
        <div class="border w-full p-1 cursor-default flex flex-wrap gap-1">
            <template x-for="(item, index) in list" :key="index">
                <button x-show="_.includes(params,_.toString(item.value))" class="btn btn-xs btn-success" x-text="item.text"></button>
            </template>
        </div>
    </button>
    <div x-show="popup"
         x-transition:enter="transition ease-in-out duration-50"
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
                            <button class="btn relative"
                                    :class="{
                                        ' btn-success':_.includes(params,_.toString(item.value)),
                                        'btn-success btn-outline':!_.includes(params,_.toString(item.value))
                                    }">
                                <input type="checkbox" x-model="params" :value="item.value"
                                       class="w-full h-full absolute top-0 left-0 opacity-0">
                                <label  for="" x-text="item.text"></label>
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>
