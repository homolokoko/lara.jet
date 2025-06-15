<div>

    <div x-data="{
        filter:{
            date:'',
            color:@entangle('color'),
            style:@entangle('style'),
            buyer:@entangle('buyer'),
            purchase_order:@entangle('purchase_order'),
            workstation_locate:@entangle('workstation_locate'),
        },
        qpiDecfects:[],
        data:{
            colors:@entangle('colors'),
            styles:@entangle('styles'),
            buyers:@entangle('buyers'),
            defects:@entangle('defects'),
            purchase_orders:@entangle('purchase_orders'),
            workstation_locates:@entangle('workstation_locates')
        },
        addDefectedItem(item){

        },
        recordDefect(){
            this.$wire.recordDefect(this.filter,this.qpiDecfects)
        },
        save(){
            console.log('filter',this.filter)
        },
        get validateFilter(){
            let error_message = [];
            if(!this.filter.date)
                error_message.push('Please fill date!');
            if(!this.filter.style.value)
                error_message.push('Please choose style!');
            if(!this.filter.buyer.value)
                error_message.push('Please choose buyer!');
            if(!this.filter.purchase_order.value)
                error_message.push('Please choose purchase order!');
            if(!this.filter.workstation_locate.value)
                error_message.push('Please choose location!');
            return error_message;
        },
        get filterDefect(){
            return this.data.defects.filter(
                item=>item.buyer_id===this.filter.buyer.value
            );
        }
    }" class="p-5 space-y-5 border rounded-lg">

    <div class="overflow-hidden border rounded-lg shadow-lg">
        <label class="block px-4 py-2 font-semibold bg-gray-300">Lines</label>
        <x-radio-button>
            <input x-model="filter.workstation_locate" x-modelable="param" hidden />
            <input x-model="data.workstation_locates" x-modelable="list" hidden />
        </x-radio-button>
    </div>

    <div x-show="filter.workstation_locate.value" class="border rounded-lg shadow-lg ">
        <label class="block px-4 py-2 font-semibold bg-gray-300 rounded-t-lg">Style</label>
        <x-fuse-select>
            <input x-model="filter.style" x-modelable="param" hidden />
            <input x-model="data.styles" x-modelable="list" hidden />
        </x-fuse-select>
    </div>
    <div x-show="filter.style.value" class="overflow-hidden border rounded-lg shadow-lg">
        <label class="block px-4 py-2 font-semibold bg-gray-300">Buyer</label>
        <x-radio-button>
            <input x-model="filter.buyer" x-modelable="param" hidden />
            <input x-model="data.buyers" x-modelable="list" hidden />
        </x-radio-button>
    </div>

    {{-- <div class="flex gap-5">
        <template x-for="(item, index) in filterDefect" :key="item.id">
            <div class="flex flex-col overflow-hidden rounded-md shadow-md">
                <div class="px-4 py-3 bg-blue-500"><span x-text="item.name"></span></div>
                <ul class="text-xs font-semibold divide-y">
                    <template x-for="(obj, i) in item.defects" :key="obj.id">
                        <li class="px-3 py-0.5 flex gap-1"><x-heroicon-o-support class="w-5 h-5 text-green-500" /><span x-text="obj.name"></span></li>
                    </template>
                </ul>
            </div>
        </template>
    </div> --}}

    <div x-show="filter.style.value" class="overflow-hidden border rounded-lg shadow-lg">
        <label class="block px-4 py-2 font-semibold bg-gray-300">Purchase Orders</label>
        <x-radio-button>
            <input x-model="filter.purchase_order" x-modelable="param" hidden />
            <input x-model="data.purchase_orders" x-modelable="list" hidden />
        </x-radio-button>
    </div>

    <div x-show="filter.style.value" class="overflow-hidden border rounded-lg shadow-lg">
        <label class="block px-4 py-2 font-semibold bg-gray-300">colors</label>
        <x-radio-button>
            <input x-model="filter.color" x-modelable="param" hidden />
            <input x-model="data.colors" x-modelable="list" hidden />
        </x-radio-button>
    </div>

    <div x-show="filter.style.value" class="overflow-hidden border rounded-lg shadow-lg">
        <label class="block px-4 py-2 font-semibold bg-gray-300">Date</label>
        <x-flatpickr>
            <input x-model="filter.date" x-modelable="param" hidden />
        </x-flatpickr>
    </div>

    <template x-for="error in validateFilter">
        <div class="alert alert-warning">
            <div class="flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <label x-text="error"></label>
            </div>
        </div>
    </template>

    <div x-show="validateFilter.length===0" x-data="{
        img:'',
        isActive:false,
        defectTitle:{},
        subDefect:{},
        get defectList(){
            return _.map(filterDefect,(item)=>{
                return {value:item.id, text:item.name};
            })
        },
        save(){
            qpiDecfects.push({
                img:this.img,
                defect:this.subDefect
            });
            this.img='';
            this.isActive=false;
        },
        get subDefects(){
            defect = _.find(filterDefect,item=>item.id===this.defectTitle.value)
            return _.map(defect.defects,(item)=>{ return {value:item.id, text:item.name}; })
        },
        init(){
            $watch('img',(isExist)=>{ isExist ? modalOpen=true:modalOpen=false })
        }
    }" class="">
        <x-tools.webcam>
            <input x-model="isActive" x-modelable="webcamActive"  hidden />
            <input x-model="img" x-modelable="picture"  hidden />
        </x-tools.webcam>
        <x-modal>
            <x-slot name="trigger">
                <div x-show="img" class="justify-center w-full">
                    <div class="flex flex-col">
                        <img :src="img" class="w-1/2" alt="">
                        <div class="flex w-full btn-group">
                            <button @click="img='';isActive=false" class="rounded-none btn btn-sm btn-error">remove</button>
                            <button @click="modalOpen=true;isActive=false" class="rounded-none btn btn-sm btn-secondary">assign defect</button>
                        </div>
                    </div>
                </div>
            </x-slot>
            <x-slot name="title">{{ __('Assign Defect') }}</x-slot>
            <x-slot name="content">
                <div class="flex flex-col">
                    <div class="space-y-3">
                        <img :src="img" alt="">
                        <div class="overflow-hidden border rounded-lg shadow-lg">
                            <label class="block px-4 py-2 font-semibold text-center bg-gray-300">Defect Title</label>
                            <x-radio-button>
                                <input x-model="defectTitle" x-modelable="param" hidden />
                                <input x-model="defectList" x-modelable="list" hidden />
                            </x-radio-button>
                        </div>
                        <div x-show="filter.buyer.value" class="border rounded-lg shadow-lg ">
                            <label class="block px-4 py-2 font-semibold text-center bg-gray-300 rounded-t-lg">Defect</label>
                            <x-fuse-select>
                                <input x-model="subDefect" x-modelable="param" hidden />
                                <input x-model="subDefects" x-modelable="list" hidden />
                            </x-fuse-select>
                        </div>
                        <div class="flex justify-center">
                            <button @click="save();$nextTick(()=>{ modalOpen=false; })" class="btn btn-primary">save</button>
                        </div>

                    </div>
                </div>

            </x-slot>
        </x-modal>
        <button x-show="!img" @click="isActive=true" class="w-full btn btn-success">start inspection</button>

        <div>
            <div class="grid grid-cols-4 py-4">
                <template x-for="(item, index) in qpiDecfects" :key="index">
                    <div class="flex flex-col items-center border">
                        <img :src="item.img" alt="">
                        <span class="w-full px-3 py-1" x-text="item.defect.text"></span>
                    </div>
                </template>
            </div>
            <div class="block w-full"><button @click="recordDefect()" class="btn btn-accent w-full">record defect</button></div>
        </div>


    </div>


    </div>

</div>
