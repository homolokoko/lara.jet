<div>
    {{-- The whole world belongs to you. --}}
    <div ignore>
        <x-auditor.inspection.form.section.a.style-information>
        </x-auditor.inspection.form.section.a.style-information>
    </div>


    <div id="inspection.form.section.a.style-information.detail" ignore x-data="{
        data: @entangle('data'),
        removeData(id) {
            let isCompleted = (this.data.length === 1)? true : false;
            $wire.remove(id);
        },
        country(item,city) {
            let country = _.find(QMS.country, function(o) { return o.value == item; })['text'];
            return !city ? country: _.join([city,country],',');
        },
        init(){
            $watch('data',(v)=>{

            })
        }
    }">
        <div class="grid items-center grid-cols-5  text-xs sm:text-sm md:text-base">
            <div class="px-2 font-extrabold bg-gray-200 border border-black  h-full "> Style Number </div>
            <div class="px-2 font-extrabold bg-gray-200 border border-black h-full"> Production Description</div>
            <div class="px-2 font-extrabold bg-gray-200 border border-black h-full"> Purchase Order Number</div>
            <div class="px-2 font-extrabold bg-gray-200 border border-black h-full"> Destination Country </div>
            <div class="px-2 font-extrabold bg-gray-200 border border-black h-full "> Deleted </div>
        </div>
        <template x-for="item in data">
            <div class="grid grid-cols-5 text-xs sm:text-sm md:text-base">
                <div class="p-2 border border-black" x-text="item.style.name"></div>
                <div class="p-2 border border-black" x-text="item.production_desc"></div>
                <div class="p-2 border border-black" x-text="item.purchase_order.no"></div>
                <div class="p-2 border border-black" x-text="country(item.destination_country,item.destination_city)"></div>
                <div class="flex space-x-1 border border-black hover:bg-red-500 hover:text-white hover:cursor-pointer"
                     @click="removeData(item.id)">
                    <span class="p-2"><img src="/icon/trash.svg" class="w-5 h-5"></span> <span
                        class="p-1 hidden sm:block sm:text-sm md:text-base">Remove</span>
                </div>
            </div>
        </template>


    </div>
</div>
