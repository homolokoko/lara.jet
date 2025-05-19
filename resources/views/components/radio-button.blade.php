 <div
    x-data="{
        list: [],
        param: '',
    }"
    class="">
    {{$slot}}
    <div class="flex flex-wrap w-full gap-3 p-3 border rounded-md">
        <template x-for="(item, index) in list" :key="item.value">
            <label class="space-x-2 btn">
                <input type="radio" x-model="param" :value="item.value" class="radio" ><i x-text="item.text"></i>
            </label>
        </template>
    </div>

</div>
