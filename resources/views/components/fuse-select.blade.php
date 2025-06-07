<div x-data="{
        selectOpen: false,
        param: '',
        search:'',
        list: [],
        get filterList(){
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
        },
        selectableItemActive: null,
        selectId: $id('select'),
        selectKeydownValue: '',
        selectKeydownTimeout: 1000,
        selectKeydownClearTimeout: null,
        selectDropdownPosition: 'bottom',
        selectableItemIsActive(item) {
            return this.selectableItemActive && this.selectableItemActive.value==item.value;
        },
        selectableItemActiveNext(){
            let index = this.filterList.indexOf(this.selectableItemActive);
            if(index < this.filterList.length-1){
                this.selectableItemActive = this.filterList[index+1];
                this.selectScrollToActiveItem();
            }
        },
        selectableItemActivePrevious(){
            let index = this.filterList.indexOf(this.selectableItemActive);
            if(index > 0){
                this.selectableItemActive = this.filterList[index-1];
                this.selectScrollToActiveItem();
            }
        },
        selectScrollToActiveItem(){
            if(this.selectableItemActive){
                activeElement = document.getElementById(this.selectableItemActive.value + '-' + this.selectId)
                newScrollPos = (activeElement.offsetTop + activeElement.offsetHeight) - this.$refs.selectableItemList.offsetHeight;
                if(newScrollPos > 0){
                    this.$refs.selectableItemList.scrollTop=newScrollPos;
                } else {
                    this.$refs.selectableItemList.scrollTop=0;
                }
            }
        },
        selectKeydown(event){
            if (event.keyCode >= 65 && event.keyCode <= 90) {

                this.selectKeydownValue += event.key;
                selectedItemBestMatch = this.selectItemsFindBestMatch();
                if(selectedItemBestMatch){
                    if(this.selectOpen){
                        this.selectableItemActive = selectedItemBestMatch;
                        this.selectScrollToActiveItem();
                    } else {
                        this.param = this.selectableItemActive = selectedItemBestMatch;
                    }
                }

                if(this.selectKeydownValue != ''){
                    clearTimeout(this.selectKeydownClearTimeout);
                    this.selectKeydownClearTimeout = setTimeout(() => {
                        this.selectKeydownValue = '';
                    }, this.selectKeydownTimeout);
                }
            }
        },
        selectItemsFindBestMatch(){
            typedValue = this.selectKeydownValue.toLowerCase();
            var bestMatch = null;
            var bestMatchIndex = -1;
            for (var i = 0; i < this.filterList.length; i++) {
                var text = this.filterList[i].text.toLowerCase();
                var index = text.indexOf(typedValue);
                if (index > -1 && (bestMatchIndex == -1 || index < bestMatchIndex)) {
                    bestMatch = this.filterList[i];
                    bestMatchIndex = index;
                }
            }
            return bestMatch;
        },
        selectPositionUpdate(){
            selectDropdownBottomPos = this.$refs.selectButton.getBoundingClientRect().top + this.$refs.selectButton.offsetHeight + parseInt(window.getComputedStyle(this.$refs.selectableItemList).maxHeight);
            if(window.innerHeight < selectDropdownBottomPos){
                this.selectDropdownPosition = 'top';
            } else {
                this.selectDropdownPosition = 'bottom';
            }
        }
    }"
    x-init="
        $watch('selectOpen', function(){
            if(!param){
                selectableItemActive=filterList[0];
            } else {
                selectableItemActive=param;
            }
            setTimeout(function(){
                selectScrollToActiveItem();
            }, 10);
            selectPositionUpdate();
            window.addEventListener('resize', (event) => { selectPositionUpdate(); });
        });
    "
    @keydown.escape="if(selectOpen){ selectOpen=false; }"
    @keydown.down="if(selectOpen){ selectableItemActiveNext(); } else { selectOpen=true; } event.preventDefault();"
    @keydown.up="if(selectOpen){ selectableItemActivePrevious(); } else { selectOpen=true; } event.preventDefault();"
    @keydown.enter="param=selectableItemActive; selectOpen=false;"
    @keydown="selectKeydown($event);"
    class="relative w-full"> {{@$slot}}

    <button  x-ref="selectButton" @click="selectOpen=!selectOpen; $nextTick(()=>{ $refs.searchInput.focus() })"
        :class="{ '' : !selectOpen }"
        class="items-center justify-between w-full rounded-none relativeflex btn btn-ghost ">
        <span x-text="Object.keys(param).length > 0 ? param.text : 'Select Item'" class="truncate">Select Item</span>
        <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
            <x-heroicon-o-selector class="w-5 h-5" />
        </span>
    </button>

    <ul x-show="selectOpen"
        x-ref="selectableItemList"
        @click.away="selectOpen = false"
        x-transition:enter="transition ease-out duration-50"
        x-transition:enter-start="opacity-0 -translate-y-1"
        x-transition:enter-end="opacity-100"
        :class="{ 'bottom-0 mb-10' : selectDropdownPosition == 'top', 'top-0 mt-10' : selectDropdownPosition == 'bottom' }"
        class="absolute z-10 w-full overflow-auto text-sm bg-white border rounded-md shadow-lg max-h-56">

        <input type="text" x-ref="searchInput" x-model="search" class="w-full px-3 py-1 border-none" placeholder="search ........">

        <template x-for="item in filterList" :key="item.value">
            <li
                @click="param=item; selectOpen=false; $refs.selectButton.focus();"
                {{-- :id="item.value + '-' + selectId" --}}
                :class="{ 'btn-primary' : selectableItemIsActive(item), 'btn-ghost' : !selectableItemIsActive(item) }"
                @mousemove="selectableItemActive=item"
                class="flex justify-between w-full border-b rounded-none btn btn-sm">
                <span class="font-medium" x-text="item.text"></span>
            </li>
        </template>

    </ul>

</div>
