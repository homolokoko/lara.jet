@props(['other', 'label', 'id', 'create'])
@php
    $random_id = \Illuminate\Support\Str::random();
@endphp
<div id="{{ $id ?? $random_id }}" x-data="{
    componentId: '{{ $random_id }}',
    create: {{ $create ?? 'false' }},
    selected: '',
    selectedValue: null,
    selectedText: null,
    modalOpen: false,
    'dataList': [],

    toggle() {

        this.modalOpen = !this.modalOpen;
    },

    setSelected(option) {

        this.selected = option;
        this.selectedValue = option.value;
        this.selectedText = option.text;
        this.toggle();

    },
    searchEngine: null,
    searchResult: null,
    searchText: null,
    getResult() {
        if (this.searchText) {
            return this.searchResult;
        } else {
            return this.dataList;
        }
    },
    submit(){
        let option = {
            value: '',
            text: this.searchText
        };
        this.setSelected(option)

    },
    toSnakeCase(str) {
        // Convert the string to lowercase
        str = str.toLowerCase();

        // Replace all non-alphanumeric characters (excluding underscores) with a space
        str = str.replace(/[^a-z0-9]+/g, ' ');

        // Trim the string to remove leading and trailing spaces
        str = str.trim();

        // Replace spaces with underscores
        str = str.replace(/\s+/g, '_');

        return str;
    },
    showSubmit:false,
    shouldShowSubmit() {
        console.table('trigger this.create', this.create,this.searchText.length);

        if (!this.create) {
            this.showSubmit = false;
            return;
        }

        if (this.searchText.length === 0) {
            this.showSubmit = false;
            return;
        }

        const searchText = this.toSnakeCase(this.searchText);
        const result = this.getResult();

        if (result.length === 0) {
            this.showSubmit = true;
        } else {
            const resultFirstRecord = this.toSnakeCase(result[0].text);
            this.showSubmit = (searchText !== resultFirstRecord);
        }
    },
    getLabel(item) {
        return item.text;
    },
    init() {
        const options = { includeScore: true, keys: ['text'] };
        this.searchEngine = new QMS.fuse(this.dataList, options);
        $watch('dataList', (v) => {
           this.searchEngine.setCollection(v);

        });
        let r = null;
        $watch('searchText', (v) => {
             if(this.dataList.length === 0){
                this.searchResult = [];
                return [];
             }
            r = this.searchEngine.search(v).slice(0, 5);
            if (r.length > 0) {
                r = _.map(r, 'item')
            }
            this.searchResult = (r) ? r : 'nothing';
            this.shouldShowSubmit();
        });
    }
}" {{ $attributes ?? '' }} class="relative w-full">


    <div class="form-control">
        <div class="relative items-center">
            <div class="w-full pr-16 input input-primary input-bordered cursor-pointer hover:bg-gray-100 transition-colors active:bg-gray-200 flex items-center p-0 overflow-hidden"
                 @click="toggle(); $nextTick(() => { if($refs.searchInput) $refs.searchInput.focus(); })">

                <div class="flex-1 px-3 py-2">
                    <div x-show="!selected || !selected.hasOwnProperty('value')" class="text-gray-400 text-xs md:text-sm">
                        @lang('general.choose') {{ $label ?? '' }}...
                    </div>
                    <div x-show="selected && selected.hasOwnProperty('value')" class="flex flex-wrap gap-1">
                            <span
                                x-text="selectedText"></span>
                    </div>
                </div>
            </div>

            <!-- Button container -->
            <div class="absolute top-0 right-0 h-full flex items-center gap-1">
            {{ $other ?? '' }}
            <!-- Clear button -->
                <span class="text-primary btn-sm md:btn-md flex items-center justify-center"
                      @click="selected = [];"
                      x-show="selected && selected.length > 0"
                      type="button"
                      title="Clear selection">
                    <x-heroicon-o-trash class="w-5 h-5"></x-heroicon-o-trash>
                </span>
            </div>
        </div>
    </div>






    <!-- Modal -->
    <x-general.modal>
        <x-slot name="title"> {{ $label ?? '' }} </x-slot>
        <x-slot name="body">
            <div class="flex flex-col bg-gradient-to-r from-gray-50 to-gray-100 sm:flex-row">
                <div class="relative flex-1">
                    <input x-show="modalOpen"
                           type="text"
                           x-ref="input"
                           name="search"
                           class="w-full p-4 text-base font-medium placeholder-gray-500 bg-transparent border-0 sm:text-lg focus:outline-none focus:ring-0"
                           x-model="searchText"
                           placeholder="Please Search..." />

                    <!-- Search Icon -->
                    <div class="absolute text-gray-400 transform -translate-y-1/2 right-4 top-1/2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center bg-white border-t border-gray-200 sm:border-t-0 sm:border-l">
                    <!-- Clear Button -->
                    <button class="flex items-center justify-center flex-1 px-4 py-3 text-sm text-gray-600 transition-all duration-200 border-r border-gray-200 sm:flex-none sm:px-6 sm:py-4 sm:text-base hover:text-red-500 hover:bg-red-50"
                            @click="searchText = ''; $nextTick(() => { $refs.input.focus(); })">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="mr-2">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                        <span class="font-medium hidden">{{ __('general.clear') }}</span>
                    </button>
                </div>
            </div>
            <!-- Select dropdown with scroll functionality -->
            <ul class="w-full p-2 overflow-auto overflow-y-scroll border-2 rounded max-h-32 bg-gray-50 ring-1 ring-gray-300"
            >
                <li  x-show="create && searchText && searchText.length > 0" @click="setSelected({'value':searchText,'text':searchText })"
                     class="flex p-2 space-x-1 font-extrabold cursor-pointer select-none hover:bg-blue-300 hover:text-black" >
                    <span x-text="searchText" ></span>
                    <span class="px-2 py-1 text-xs text-white bg-green-500 rounded-full"> New </span>
                </li>
                <template x-for="option in getResult()">
                    <li class="p-2 cursor-pointer select-none hover:bg-blue-300 hover:text-gray-400"
                        @click="setSelected(option)"
                        :class="{ 'bg-blue-500 border-2 text-white font-extrabold': option.value == selectedValue }"
                        x-text="option.text"> Python </li>
                </template>


            </ul>

        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-center">
                <!-- Confirm button -->
                <button @click="modalOpen = false; $nextTick(()=>{
                    searchText = '';
                })"
                        class="px-4 py-2 mt-4 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                    {{ __('general.close') }}
                </button>
            </div>
        </x-slot>
    </x-general.modal>
    {{ $other ?? '' }}
</div>
