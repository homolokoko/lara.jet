<div>

    <div x-data="{
        filter:{
            date:'',
            color:@entangle('color'),
            style:{},
            orderno:@entangle('orderno'),
            buyer:@entangle('buyer'),
            purchase_order:@entangle('purchase_order'),
            workstation_locate:{},
        },
        pqiDefects:[],
        removeDefect(index){
            _.pullAt(this.pqiDefects,index);
        },
        data:{
            colors:@entangle('colors'),
            styles:@entangle('styles'),
            ordernos:@entangle('ordernos'),
            defects:@entangle('defects'),
            purchase_orders:@entangle('purchase_orders'),
            workstation_locates:@entangle('workstation_locates')
        },
        addDefectedItem(item){

        },
        recordDefect(){
            this.$wire.recordDefect(this.filter,this.pqiDefects)
                .then(()=>{
                    swal.fire({
                        icon: 'success',
                        title: 'Saved',
                        timer: 1500,
                        showConfirmButton: false,
                    }).then(()=>{ this.pqiDefects = [] })
                })
        },
        save(){
            console.log('filter',this.filter)
        },
        get validateFilter(){
            let error_message = [];
            if(!this.filter.date)
                error_message.push('please pick date');
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
        },
    }" class="p-5 space-y-5 border rounded-lg">

        <button class="btn" @click="console.log(data.defects)">INSPECT</button>

        <div class="grid gap-3 md:grid-cols-2">
            <x-popup-single-select>
                <x-slot name="title">
                    {{ __('Worksation') }}
                </x-slot>
                <x-slot name="other">
                    <input x-model="filter.workstation_locate" x-modelable="param" hidden />
                    <input x-model="data.workstation_locates" x-modelable="list" hidden />
                </x-slot>
            </x-popup-single-select>
            <x-popup-single-select>
                <x-slot name="title">
                    {{ __('Order Number') }}
                </x-slot>
                <x-slot name="other">
                    <input x-model="filter.orderno" x-modelable="param" hidden />
                    <input x-model="data.ordernos" x-modelable="list" hidden />
                </x-slot>
            </x-popup-single-select>
            <label class="button-group input-group">
                <span class="font-semibold uppercase">{{ __('Buyer') }}</span>
                <input x-model="filter.buyer.text" placeholder="" class="input block input-ghost w-full input-bordered" readonly />
            </label>
            <x-popup-single-select>
                <x-slot name="title">
                    {{ __('Style') }}
                </x-slot>
                <x-slot name="other">
                    <input x-model="filter.style" x-modelable="param" hidden />
                    <input x-model="data.styles" x-modelable="list" hidden />
                </x-slot>
            </x-popup-single-select>
            <x-popup-single-select>
                <x-slot name="title">
                    {{ __('Color ') }}
                </x-slot>
                <x-slot name="other">
                    <input x-model="filter.color" x-modelable="param" hidden />
                    <input x-model="data.colors" x-modelable="list" hidden />
                </x-slot>
            </x-popup-single-select>
            <x-popup-single-select>
                <x-slot name="title">
                    {{ __('Purchase Order ') }}
                </x-slot>
                <x-slot name="other">
                    <input x-model="filter.purchase_order" x-modelable="param" hidden />
                    <input x-model="data.purchase_orders" x-modelable="list" hidden />
                </x-slot>
            </x-popup-single-select>

            <div class="overflow-hidden border col-span-2 sm:col-span-1 rounded-lg shadow-lg">
                <label class="block px-4 py-2 font-semibold bg-gray-300">Date</label>
                <x-flatpickr>
                    <input x-model="filter.date" x-modelable="param" hidden />
                </x-flatpickr>
            </div>
        </div>

        <div>
            <template x-for="error in validateFilter">
                <div class="alert alert-warning block">
                    <div class="flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <label x-text="error"></label>
                    </div>
                </div>
            </template>
        </div>

        <div x-show="validateFilter.length===0" x-data="{
            img:'',
            find_str:'',
            isActive:false,
            defect:{},
            get defectList(){
                return data.defects.filter(
                    i => i.text.toLowerCase().includes(this.find_str.toLowerCase())
                )
            },
            save(){
                pqiDefects.push({img:this.img, defect:this.defect});
                this.img='';
                this.isActive=false;
                this.extraDefect = this.subDefect = {};
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
                            <div x-data="{dropdown:false}">
                                <button class="btn btn-outline w-full border rounded-none border-2 capitalize"
                                        x-text="_.isEmpty(defect) ? 'Please choose':defect.text"
                                        @click="dropdown=true;$nextTick(()=>{$refs.find_str.focus()})"></button>
                                <div x-show="dropdown" class="relative bg-white">
                                    <input x-ref="find_str" type="text" x-model="find_str" class="input rounded-none w-full input-sm input-ghost input-bordered" placeholder="search........." />
                                    <ul class="max-h-48 min-h-16 relative overflow-auto bg-white border absolute top-0 left-0 divide-y">
                                        <template x-for="(item, i) in defectList" :key="item.value">
                                            <li class="hover:bg-gray-100">
                                                <label @click="defect=item;dropdown=false" class="flex flex-col w-full px-3">
                                                    <div class="text-xs breadcrumbs">
                                                        <ul>
                                                            <template x-for="(path, j) in item.ancestors" :key="path.value">
                                                                <li><span x-text="path.text"></span></li>
                                                            </template>
                                                        </ul>
                                                    </div>
                                                    <span class="px-3" x-text="item.text"></span>
                                                </label>
                                            </li>
                                        </template>
                                    </ul>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <button @click="save();$nextTick(()=>{ modalOpen=false; })" class="btn btn-primary">save</button>
                            </div>

                        </div>
                    </div>

                </x-slot>
            </x-modal>
            <button x-show="!img" @click="isActive=true" class="w-full btn btn-success">start inspection</button>

            <div x-show="pqiDefects.length > 0">
                <div class="grid grid-cols-4 py-4">
                    <template x-for="(item, index) in pqiDefects" :key="index">
                        <div class="flex flex-col items-center border">
                            <img :src="item.img" alt="">
                            <span class="w-full px-3 py-1" x-text="item.defect.text"></span>
                            <button @click="removeDefect(index)" class="btn btn-sm btn-error rounded-0 w-full">delete</button>
                        </div>
                    </template>
                </div>
                <div class="block w-full"><button @click="recordDefect()" class="btn btn-accent w-full">record defect</button></div>
            </div>


        </div>


    </div>

</div>
