<div x-data="{
        selectOpen: false,
        param: '',
        search:'',
        list: [
            {
                text: 'Milk',
                value: 'milk',
                disabled: false
            },
            {
                text: 'Eggs',
                value: 'eggs',
                disabled: false
            },
            {
                text: 'Cheese',
                value: 'cheese',
                disabled: false
            },
            {
                text: 'Bread',
                value: 'bread',
                disabled: false
            },
            {
                text: 'Apples',
                value: 'apples',
                disabled: false
            },
            {
                text: 'Bananas',
                value: 'bananas',
                disabled: false
            },
            {
                text: 'Yogurt',
                value: 'yogurt',
                disabled: false
            },
            {
                text: 'Sugar',
                value: 'sugar',
                disabled: false
            },
            {
                text: 'Salt',
                value: 'salt',
                disabled: false
            },
            {
                text: 'Coffee',
                value: 'coffee',
                disabled: false
            },
            {
                text: 'Tea',
                value: 'tea',
                disabled: false
            }
        ],
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
    class="relative w-full">

    <button  x-ref="selectButton" @click="selectOpen=!selectOpen; $nextTick(()=>{ $refs.searchInput.focus() })"
        :class="{ '' : !selectOpen }"
        class="items-center justify-between w-full rounded-none relativeflex btn btn-ghost ">
        <span x-text="param ? param.text : 'Select Item'" class="truncate">Select Item</span>
        <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="w-5 h-5 text-gray-400"><path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd"></path></svg>
        </span>
    </button>

    <ul x-show="selectOpen"
        x-ref="selectableItemList"
        @click.away="selectOpen = false"
        x-transition:enter="transition ease-out duration-50"
        x-transition:enter-start="opacity-0 -translate-y-1"
        x-transition:enter-end="opacity-100"
        :class="{ 'bottom-0 mb-10' : selectDropdownPosition == 'top', 'top-0 mt-10' : selectDropdownPosition == 'bottom' }"
        class="absolute w-full overflow-auto text-sm bg-white border rounded-md shadow-lg max-h-56"
        x-cloak>

        <input type="text" x-ref="searchInput" x-model="search" class="w-full px-3 py-1 border-none" placeholder="search ........">

        <template x-for="item in filterList" :key="item.value">
            <li
                @click="param=item; selectOpen=false; $refs.selectButton.focus();"
                :id="item.value + '-' + selectId"
                :class="{ 'btn-primary' : selectableItemIsActive(item), 'btn-ghost' : !selectableItemIsActive(item) }"
                @mousemove="selectableItemActive=item"
                class="flex justify-between w-full rounded-none outline-none btn btn-sm">
                <span class="font-medium" x-text="item.text"></span>
            </li>
        </template>

    </ul>

</div>
