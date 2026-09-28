<div>

    <div class="py-5 px-7">

    <div x-data="{
        garment_tracking_id:null,
        garment_codes:[],
        information:{
            style:{},
            profile:{},
            purchase_order:{},
            size:{},
            color:{},
            apparel:{},
            workstation:{},
            workstation_locate:{},
            supervisor:{},
            garment_id:'',
        },
        data:{
            styles:[],
            purchase_orders:[],
            profiles:[],
            sizes:[],
            colors:[],
            apparels:[],
            supervisors:[],
            defects:[],
            defect_causes:[],
            workstations:[],
            workstation_locates:[],
            checkpoints:[]
        },
        sketch:{
            svg:{},
            checkpoint:{},
            garment_code:{},
            defect_photo:{},
            defect:{},
            defect_cause:{},
        },
        sketch_data:{
            checkpoints:[]
        },
        submit(){
            return this.$wire.submit();
            this.$wire.submitGoodItem({sketch: this.sketch,information:this.information});
        },
        submitAcceptItem(){
            this.$wire.submitAcceptItem(this.information);
        },
        submitRepairGarment(){
            this.$wire.submitRepairGarment(this.information,this.sketch)
        },
        get isStyleSelected(){
            if(this.data.profiles.length==0)
                return false;
            else return true;
        },
        get isProfileSelected(){
            let profile = this.information.profile;
            if(_.isEmpty(profile)){
                return false;
            }else{
                let profileFinding = _.find(
                    this.data.profiles,i=>i.value==profile.value
                );
                this.data.sizes = profileFinding.sizes;
                this.data.colors = profileFinding.colors;
                this.data.apparels = profileFinding.apparels;
                return true;
            }
        },
        get isApparelSelected(){
            let apparel = this.information.apparel;
            if(!apparel.value){
                return false;
            }else{
                let checkpointFinding = _.find(
                    this.data.apparels,i=>i.value==apparel.value
                )
                this.data.checkpoints = checkpointFinding.checkpoints;
                return true;
            }
        },
        get isCompleteInfo(){
            if(_.isEmpty(this.information.style)) return false;
            if(_.isEmpty(this.information.profile)) return false;
            if(_.isEmpty(this.information.purchase_order)) return false;
            if(_.isEmpty(this.information.size)) return false;
            if(_.isEmpty(this.information.color)) return false;
            if(_.isEmpty(this.information.apparel)) return false;
            if(_.isEmpty(this.information.workstation_locate)) return false;
            if(_.isEmpty(this.information.supervisor)) return false;
            return true;
        },
        detectGarmentCode(code){
            this.$wire.detectGarmentCode(code)
                .then((response)=>{
                    if(!response.existed){
                        swal.fire({
                            icon:'success',
                            title:'Done',
                            timer:1500,
                            showConfirmButton:false
                        }).then(()=>{
                            this.information.garment_id = response.garment_tracking_id;
                        })
                    }else{
                        swal.fire({
                            icon:'warning',
                            title:'This Ticket already scan, Are you wish to scan again?'
                        }).then((result)=>{
                                if(result.isConfirmed)
                                    this.information.garment_id = response.garment_tracking_id;
                            })
                    }
                });
        },
        detectGarmentCodeAndPass(code){
            this.$wire.detectGarmentCode(code)
                .then((response)=>{
                    if(!response.existed){
                        swal.fire({
                            icon:'success',
                            title:'Done',
                            timer:1500,
                            showConfirmButton:false
                        }).then(()=>{
                            this.information.garment_id = response.garment_tracking_id;
                            this.submitAcceptItem();
                        })
                    }else{
                        swal.fire({
                            icon:'warning',
                            title:'This Ticket already scan, Are you wish to scan again?'
                        }).then((result)=>{
                            if(result.isConfirmed){
                                this.information.garment_id = response.garment_tracking_id;
                                this.submitAcceptItem();
                            }
                        })
                    }
                });
        },
        init(){
            this.$wire.information()
                .then((response)=>{
                    this.garment_codes= response.garment_codes;
                    this.data.styles= response.styles;
                    this.data.defects= response.defects;
                    this.data.supervisors= response.supervisors;
                    this.data.workstation_locates= response.workstation_locates;
                    this.data.defect_causes= response.defect_causes;
                });

            $watch('information.style',(v)=>{
                this.information.profile = {};
                this.information.purchase_order = {};
                this.$wire.updateStyle(v)
                    .then((response)=>{
                        this.data.profiles= response.profiles;
                        this.data.purchase_orders= response.purchase_orders;
                        // this.data.purchase_orders= response.purchase_orders;
                    })
            });

        },
    }" class="p-5 border border-black rounded-lg ">

    <div class="grid grid-cols-2 gap-5 divide-y">

        <div class="w-full col-span-2 ">
            <label for="" class="font-semibold capitalize label">location</label>
            <x-fuse-select>
                <input type="hidden" x-modelable="param" x-model="information.workstation_locate" />
                <input type="hidden" x-modelable="list" x-model="data.workstation_locates" />
            </x-fuse-select>
        </div>

        <div class="w-full col-span-2 ">
            <label for="" class="font-semibold capitalize label">Person In Charge</label>
            <x-fuse-select>
                <input type="hidden" x-modelable="param" x-model="information.supervisor" />
                <input type="hidden" x-modelable="list" x-model="data.supervisors" />
            </x-fuse-select>
        </div>

        <div class="w-full col-span-2 ">
            <label for="" class="font-semibold capitalize label">Order Number</label>
            <x-fuse-select>
                <input type="hidden" x-modelable="param" x-model="information.style" />
                <input type="hidden" x-modelable="list" x-model="data.styles" />
            </x-fuse-select>
        </div>

        <div x-show="data.purchase_orders.length>0" class="w-full col-span-2">
            <label for="" class="font-semibold capitalize label">purchase order</label>
            <x-fuse-select>
                <input type="hidden" x-modelable="param" x-model="information.purchase_order" />
                <input type="hidden" x-modelable="list" x-model="data.purchase_orders" />
            </x-fuse-select>
        </div>

        <div x-show="data.profiles.length>0" class="w-full col-span-2">
            <label for="" class="font-semibold capitalize label">profile</label>
            <x-fuse-select>
                <input type="hidden" x-modelable="param" x-model="information.profile" />
                <input type="hidden" x-modelable="list" x-model="data.profiles" />
            </x-fuse-select>
        </div>

        <div x-show="isProfileSelected">
            <div class="w-full">
                <label for="" class="font-semibold capitalize label">size</label>
                <x-fuse-select>
                    <input type="hidden" x-modelable="param" x-model="information.size" />
                    <input type="hidden" x-modelable="list" x-model="data.sizes" />
                </x-fuse-select>
            </div>

            <div class="w-full">
                <label for="" class="font-semibold label">color</label>
                <x-fuse-select>
                    <input type="hidden" x-modelable="param" x-model="information.color" />
                    <input type="hidden" x-modelable="list" x-model="data.colors" />
                </x-fuse-select>
            </div>

            <div class="w-full col-span-2">
                <label for="" class="font-semibold label">Apparel</label>
                <x-fuse-select>
                    <input type="hidden" x-modelable="param" x-model="information.apparel" />
                    <input type="hidden" x-modelable="list" x-model="data.apparels" />
                </x-fuse-select>
            </div>
        </div>



    </div>

    <div class="sticky flex justify-center p-5 gap-7 bottom-o">
        <x-modal>
            <x-slot name="title">
                Scan
            </x-slot>
            <x-slot name="trigger">
                <button @click="modalOpen=true; $nextTick(()=>{
                    $dispatch('active-good-item-record');
                    })" :class="{
                        'btn-disabled': !isCompleteInfo,
                        ' btn-active btn-success': isCompleteInfo,
                    }" class="btn btn-lg">Scan Item</button>
            </x-slot>
            <x-slot name="content">
                @include('Inspector.FullQc.Form.Item')
            </x-slot>
        </x-modal>
        <x-modal>
            <x-slot name="title">
                Defect Found
            </x-slot>
            <x-slot name="trigger">
                <button @click="modalOpen=true; $nextTick(()=>{
                    $dispatch('active-sketch-engine');
                    })" :class="{
                        'btn-disabled': !isCompleteInfo,
                        ' btn-active btn-success': isCompleteInfo,
                    }" class="btn btn-lg">Defect Found</button>
            </x-slot>
            <x-slot name="content">
                {{-- @include('Inspector.FullQc.Form.ItemRepair') --}}
            </x-slot>
        </x-modal>
    </div>

    {{-- <div x-data="{tab:0}" @active-sketch-engine.window="tab=2"
    @active-good-item-record-form.window="tab=1">


        <div x-show="tab===1" class="w-full col-span-2">
            <div class="flex flex-wrap w-full gap-3 p-3 overflow-y-auto border rounded-lg max-h-64">
                <template x-for="(garment_code, index) in garment_codes" :key="index">
                    <button @click="detectGarmentCodeAndPass(garment_code)" class="btn" x-text="garment_code"></button>
                </template>
            </div>
        </div>

        <div x-show="tab===2" class="w-full col-span-2">
            <div class="flex flex-wrap w-full gap-3 p-3 overflow-y-auto border rounded-lg max-h-64">
                <template x-for="(garment_code, index) in garment_codes" :key="index">
                    <button @click="detectGarmentCode(garment_code)" class="btn" x-text="garment_code"></button>
                </template>
            </div>
            <div class="w-full">
                <label for="" class="font-semibold label">Checkpoint</label>
                <x-fuse-select>
                    <input type="hidden" x-modelable="param" x-model="sketch.checkpoint" />
                    <input type="hidden" x-modelable="list" x-model="data.checkpoints" />
                </x-fuse-select>
            </div>
            <div class="w-full">
                <label for="" class="font-semibold label">Defect</label>
                <x-fuse-select>
                    <input type="hidden" x-modelable="param" x-model="sketch.defect" />
                    <input type="hidden" x-modelable="list" x-model="data.defects" />
                </x-fuse-select>
            </div>
            <div class="w-full">
                <label for="" class="font-semibold label">Cause By</label>
                <x-fuse-select>
                    <input type="hidden" x-modelable="param" x-model="sketch.defect_cause" />
                    <input type="hidden" x-modelable="list" x-model="data.defect_causes" />
                </x-fuse-select>
            </div>
            <button x-show="isApparelSelected" @click="submitRepairGarment()" class="btn">Submit</button>
        </div>

    </div> --}}



    <x-modal>
        <x-slot name="title">
            Defect Found
        </x-slot>
        <x-slot name="content">
            {{-- @include('Inspector.FullQc.Form.ItemRepair') --}}
        </x-slot>
    </x-modal>

    </div>

</div>


</div>
