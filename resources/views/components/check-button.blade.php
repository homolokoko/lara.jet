 <div
    x-data="{
        list: [],
        param: [],
        addItem(item){
            this.param.push(item.value)
        },
        subtructItem(item)
        {
            _.pull(this.param,item.value)
        }
    }"
    class="">
    {{$slot}}
    <div class="flex flex-wrap w-full gap-3 p-3 overflow-auto border rounded-md max-h-96">
        <template x-for="(item, index) in list" :key="item.value">
            <div>
                <button
                    @click="subtructItem(item)"
                    x-show="param.includes(item.value)"
                    class="btn btn-sm outline outline-1 btn-success">
                    <span x-text="item.text"></span>
                </button>
                <button
                    @click="addItem(item)"
                    x-show="!param.includes(item.value)"
                    class="btn btn-sm outline outline-1 btn-ghost">
                    <span x-text="item.text"></span>
            </div>
        </template>
    </div>

</div>
