<div x-data="{
    list:[],
    param:{},
    search:'',
    open: false,
    selectItem(item){
        this.param=item;
        this.open=false;
    },
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
}" @click.away="open=false" class="relative w-full divide-y rounded">
    {{ $slot  }}
    <button
        @click="open=!open;$nextTick(()=>{ $refs.input.focus() })"
        class="flex items-center justify-between w-full capitalize btn btn-sm btn-outline">
        <span x-show="!param.value">Select</span>
        <template x-for="(item, index) in list" :key="item.value">
            <span class="btn btn-xs btn-success" x-show="param.value===item.value" x-text="item.text"></span>
        </template>
        <label :class="{'rotate-180':open}"><x-heroicon-o-chevron-down class="w-5 h-5" /></label>
    </button>
    <div x-show="open" class="absolute left-0 z-20 w-full bg-gray-700 border rounded-md shadow-lg top-10">
        <div class="p-2">
            <input
                x-ref="input"
                type="text"
                x-model="search"
                placeholder="search"
                class="border px-3 py-0.5 w-full text-sm">
        </div>
        <ul class="overflow-auto divide-y max-h-48 min-h-16">
            <template x-for="(item, index) in filterItems" :key="item.value">
                <li
                    @click="selectItem(item)"
                    x-text="item.text"
                    :class="{
                            'bg-teal-800':param.value===item.value,
                            'hover:bg-gray-500':param.value!==item.value,
                        }" class="px-3 py-0.5 cursor-default gap-2"></li>
            </template>
        </ul>
    </div>


</div>
