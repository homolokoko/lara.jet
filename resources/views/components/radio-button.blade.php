 <div
    x-data="{
        list: [],
        param: {},
    }"
    class="">
    {{$slot}}
    <div class="flex flex-wrap w-full gap-3 p-3">
        <template x-for="(item, index) in list" :key="item.value">
            <button @click="param=item"
                :class="{
                    'btn-ghost':param.value!==item.value,
                    'btn-success':param.value===item.value,
                    }" class="btn btn-sm outline outline-1" x-text="item.text"></button>
        </template>
    </div>

</div>
