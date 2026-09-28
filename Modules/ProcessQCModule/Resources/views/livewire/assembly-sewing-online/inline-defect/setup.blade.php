<div>

    <div x-data="{
        exists:[],
        related:'',
        buyer:@entangle('buyer'),
        defect:@entangle('defect'),
        extra_defect:{},
        buyers:@entangle('buyers'),
        defects:@entangle('defects'),
        extra_defects:@entangle('extra_defects'),
        list:[],
        addItem(){
            this.list.push({
                serverity:[],
                locale:{
                    kh:null,
                    cn:null,
                    en:this.related
                }
            });
            this.related = '';
        },
        removeItem(index){
            _.pullAt(this.list,index);
        },
        submit(){
            this.$wire.submit({
                    list:this.list,
                    buyer:this.buyer,
                    defect:this.defect,
                    extra_defect:this.extra_defect
                }).then(()=>{
                    swal.fire({
                        icon: 'success',
                        timer: 1500,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        title:'List of defects was created!'
                    }).then(()=>{ this.list = []; })
                });
        },
    }" class="">


        <div class="p-5 space-y-4">

            <div class="overflow-hidden border rounded-lg shadow-lg">
                <label class="block px-4 py-2 font-semibold bg-gray-300">Buyer</label>
                <x-radio-button>
                    <input x-model="buyer" x-modelable="param" hidden />
                    <input x-model="buyers" x-modelable="list" hidden />
                </x-radio-button>
            </div>

            <div x-show="buyer.value" class="overflow-hidden border rounded-lg shadow-lg">
                <label class="block px-4 py-2 font-semibold bg-gray-300">
                    <div class="flex justify-between w-full">
                        <label for="">Defect</label>
                        <x-modal>
                            <x-slot name="trigger">
                                <button @click="modalOpen=true" class="btn btn-xs">add</button>
                            </x-slot>
                            <x-slot name="title">
                                Add New Defect Group
                            </x-slot>
                            <x-slot name="content">
                                <div x-data="{
                            locale:{
                                en:'',
                                kh:'',
                                cn:''
                            },
                            newGroupName(){
                                this.$wire.newGropName({
                                    buyer:buyer,
                                    locale:this.locale
                                })
                                    .then(()=>{
                                        swal.fire({
                                            icon: 'success',
                                            title: 'Defect Created!',
                                            toast: true,
                                            showConfirmButton:false,
                                            timer: 1500,
                                            position: 'top'
                                        }).then(()=>{modalOpen=false})
                                    });
                            }
                        }" class="space-y-3">
                                    <div>
                                        <label for="">English</label>
                                        <input x-model="locale.en" type="text" class="block w-full input-bordered input">
                                    </div>
                                    <div>
                                        <label for="">Khmer</label>
                                        <input x-model="locale.kh" type="text" class="block w-full input-bordered input">
                                    </div>
                                    <div>
                                        <label for="">Chinese</label>
                                        <input x-model="locale.cn" type="text" class="block w-full input-bordered input">
                                    </div>
                                    <button @click="newGroupName()" class="w-full btn btn-sm btn-secondary">submit</button>
                                </div>
                            </x-slot>
                        </x-modal>

                    </div>
                </label>
                <x-radio-button>
                    <input x-model="defect" x-modelable="param" hidden />
                    <input x-model="defects" x-modelable="list" hidden />
                </x-radio-button>
            </div>

            <div x-show="defect.value" class="overflow-hidden border rounded-lg shadow-lg">
                <label class="block px-4 py-2 font-semibold bg-gray-300"></label>
                <x-radio-button>
                    <input x-model="extra_defect" x-modelable="param" hidden />
                    <input x-model="extra_defects" x-modelable="list" hidden />
                </x-radio-button>
            </div>


        <div x-show="extra_defect.value" class="space-y-2">

            <label for="" class="block">Related Defect</label>
            <div class="relative">
                <input @keyup.enter="addItem()" x-model="related"  type="text" class="w-full input input-bordered">
                <button @click="addItem()" class="absolute top-0 right-0 rounded-l-none btn btn-primary">Add</button>
            </div>
        </div>

        </div>

        <div x-show="list.length>0">
            <table class="w-full ">
                <tr class="divide-x bg-gray-50">
                    <td class="px-3 py-2 font-semibold">Operation</td>
                    <td class="px-3 py-2 font-semibold">Description</td>
                    <td class="px-3 py-2 font-semibold">Serverity</td>
                </tr>
                <template x-for="(item, index) in list" :key="index">
                    <tr class="border divide-x">
                        <td class="px-3 py-0.5">
                            <button @click="removeItem(index)" class="btn btn-sm btn-error">remove</button>
                        </td>
                        <td class="px-3 py-0.5">
                            <input x-model="item.locale.en" class="w-full outline-none border-none input"></input>
                        </td>
                        <td class="px-3 py-0.5">
                            <div class="flex gap-2">
                                <div class="flex gap-2 p-1 border rounded-md">
                                    <input x-model="item.serverity" type="checkbox" class="checkbox" value="1">
                                    <label for="" class="block text-xs font-semibold">Critical</label>
                                </div>
                                <div class="flex gap-2 p-1 border rounded-md">
                                    <input x-model="item.serverity" type="checkbox" class="checkbox" value="2">
                                    <label for="" class="block text-xs font-semibold">Major</label>
                                </div>
                                <div class="flex gap-2 p-1 border rounded-md">
                                    <input x-model="item.serverity" type="checkbox" class="checkbox" value="3">
                                    <label for="" class="block text-xs font-semibold">Minor</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                </template>
                <tr><td class="border" colspan="3"><button @click="submit()" class="w-full rounded-none btn btn-md btn-primary">Submit</button></td></tr>
            </table>
        </div>



    </div>

</div>
