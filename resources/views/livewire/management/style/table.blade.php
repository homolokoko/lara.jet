<div>
    <div x-data="{
        page:1,
        pages:0,
        filter:{
            style:null,
            buyer:null,
        },
        buyers:@entangle('buyers'),
        datatable:{},
        get filterItems(){
            console.log('datatable',this.datatable);
            return this.datatable;
        },
        searchFilter(){ this.goPage(1); },
        clearFilter(){
            this.filter = {
                style:null,
                buyer:null
            };
            this.datatable={};
            this.goPage(this.page);
        },
        goPage(number){
             this.page=number;
             this.$wire.loadData(number,this.filter)
                .then((response)=>{this.datatable = response})
        },
        triggerPage(url){
            const urlObj = new URL(url);
            const page = urlObj.searchParams.get('page');
            this.goPage(page)
        },
        init(){ this.goPage(this.page) },

    }">
        <table class="table w-full">
            <thead>

                <tr>
                    <td>
                        <input type="text" x-model="filter.style" class="w-full input input-xs input-bordered">
                    </td>
                    <td>
                        <select x-model="filter.buyer" class="w-full select select-bordered select-xs">
                            <option value=""></option>
                            <template x-for="item in buyers" :key="item.value">
                                <option :value="item.value" x-text="item.text"></option>
                            </template>
                        </select>
                    </td>
                    <td colspan="9">
                        <div class=" btn-group">
                            <button @click="searchFilter()" class="btn btn-xs btn-primary">Search Filter</button>
                            <button @click="clearFilter()" class="btn btn-xs btn-outline btn-primary">Clear Filter</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Order</td>
                    <td>Buyer</td>
                    <td>
                        <div x-data="{
                            open:false,
                            filter:{
                                name:'',
                                buyers_id:null,
                            },
                            create(){
                                this.$wire.create(this.filter)
                                    .then((response)=>{
                                        swal.fire({
                                            icon:'success',
                                            toast:true,
                                            title:'Update Success!',
                                            showConfirmButton:false,
                                            timer:1000,
                                            timerProgressBar:true,
                                            position:'top-end'
                                        }).then(()=>{
                                            this.open=false;
                                            clearFilter();
                                        })
                                    });
                            },
                        }">
                            <x-modal>
                                <x-slot name="trigger">
                                    <input type="hidden" x-modelable="modalOpen" x-model="open">
                                    <button @click="open=true" class="btn btn-sm btn-success">Create</button>
                                </x-slot>
                                <x-slot name="title">Create Style</x-slot>
                                <x-slot name="content">
                                    <div class="space-y-3">
                                        <div class="p-5 space-y-3">
                                            <label class="label label-text-alt">Style</label>
                                            <input type="text" x-model="filter.name" class="w-full input input-bordered">
                                            <label class="label label-text-alt">Buyer</label>
                                            <select x-model="filter.buyers_id" class="w-full select select-bordered">
                                                <template x-for="(buyer, index) in buyers" :key="buyer.value">
                                                    <option :value="buyer.value"><span x-text="buyer.text"></span></option>
                                                </template>
                                            </select>
                                            <div class="flex justify-center gap-7">
                                                <button @click="create()" class="btn">Submit</button>
                                                <button @click="modalOpen=false" class="btn btn-outline">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </x-slot>
                            </x-modal>
                        </div>
                    </td>
                    <td>P.O</td>
                    <td>Profile</td>
                    <td>Size</td>
                    <td>Color</td>
                    <td>Jobseq</td>
                    <td>Sketch</td>
                    <td>Panel</td>
                    <td>Review</td>
                </tr>
            </thead>
            <tbody>
                <template x-for="(elem, indexElem) in datatable.data" :key="elem.id">
                <tr>
                    <td><span class="text-sm" x-text="elem.name"></span></td>
                    <td><span class="text-sm" x-text="elem.buyer.name"></span></td>
                    <td class="flex gap-3">
                        <div x-data="{
                            open:false,
                            filter:{},
                            edit(id){
                                this.$wire.show(id)
                                    .then((response)=>{
                                        this.open=true;
                                        this.filter = response;
                                        console.log('response',response);
                                    });
                            },
                            update(){
                                this.$wire.update(this.filter)
                                    .then((response)=>{
                                        swal.fire({
                                            icon:'success',
                                            toast:true,
                                            title:'Update Success!',
                                            showConfirmButton:false,
                                            timer:1000,
                                            timerProgressBar:true,
                                            position:'top-end'
                                        }).then(()=>{
                                            this.open=false;
                                            clearFilter();
                                        })
                                    });
                            }
                        }">
                            <x-modal>
                                <x-slot name="trigger">
                                    <input type="hidden" x-modelable="modalOpen" x-model="open">
                                    <button @click="edit(elem.id)" class="btn btn-sm btn-warning">Edit</button>
                                </x-slot>
                                <x-slot name="title">Edit Style</x-slot>
                                <x-slot name="content">
                                    <div class="space-y-3">
                                        <div class="p-5 space-y-3">
                                            <label class="label label-text-alt">Style</label>
                                            <input type="text" x-model="filter.name" class="w-full input input-bordered">
                                            <label class="label label-text-alt">Buyer</label>
                                            <select x-model="filter.buyers_id" class="w-full select select-bordered">
                                                <template x-for="(buyer, index) in buyers" :key="buyer.value">
                                                    <option :value="buyer.value" :selected="filter.buyers_id==buyer.value"><span x-text="buyer.text"></span></option>
                                                </template>
                                            </select>
                                            <div class="flex justify-center gap-7">
                                                <button @click="update()" class="btn">Submit</button>
                                                <button @click="modalOpen=false" class="btn btn-outline">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </x-slot>
                            </x-modal>
                        </div>
                    </td>
                    <td>
                        <x-heroicon-s-x-circle x-show="!elem.purchase_order" class="w-8 h-8 text-error" />
                        <x-heroicon-s-check-circle x-show="elem.purchase_order" class="w-8 h-8 text-success" />
                    </td>
                    <td>
                        <x-heroicon-s-x-circle x-show="!elem.profile" class="w-8 h-8 text-error" />
                        <x-heroicon-s-check-circle x-show="elem.profile" class="w-8 h-8 text-success" />
                    </td>
                    <td>
                        <x-heroicon-s-x-circle x-show="!elem.size" class="w-8 h-8 text-error" />
                        <x-heroicon-s-check-circle x-show="elem.size" class="w-8 h-8 text-success" />
                    </td>
                    <td>
                        <x-heroicon-s-x-circle x-show="!elem.color" class="w-8 h-8 text-error" />
                        <x-heroicon-s-check-circle x-show="elem.color" class="w-8 h-8 text-success" />
                    </td>
                    <td>
                        <x-heroicon-s-x-circle x-show="!elem.operation_code" class="w-8 h-8 text-error" />
                        <x-heroicon-s-check-circle x-show="elem.operation_code" class="w-8 h-8 text-success" />
                    </td>
                    <td>
                        <x-heroicon-s-x-circle x-show="!elem.sketch" class="w-8 h-8 text-error" />
                        <x-heroicon-s-check-circle x-show="elem.sketch" class="w-8 h-8 text-success" />
                    </td>
                    <td>
                        <x-heroicon-s-x-circle x-show="!elem.panel" class="w-8 h-8 text-error" />
                        <x-heroicon-s-check-circle x-show="elem.panel" class="w-8 h-8 text-success" />
                    </td>
                    <td><button class="btn btn-sm btn-info">Review</button></td>
                </tr>
                </template>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="11">
                        <div class="flex justify-end">
                            <button
                                @click="triggerPage(datatable.first_page_url)"
                                class="btn btn-sm btn-ghost">first</button>
                            <template x-for="(link, index) in datatable.links" :key="index">
                                <button
                                    @click="triggerPage(link.url)"
                                    :disabled="link.active"
                                    :class="{
                                            'btn-ghost':!link.active,
                                            'btn-active':link.active,
                                            'btn-circle':!_.isNaN(_.toNumber(link.label))
                                        }"
                                    class="btn btn-sm" x-html="link.label"></button>
                            </template>
                            <button
                                @click="triggerPage(datatable.last_page_url)"
                                class="btn btn-sm btn-ghost">last</button>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>

    </div>

</div>
