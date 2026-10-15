<x-slot name="title"><p class="uppercase">Users Management</p></x-slot>
<div x-data="{
    page:1,
    perpage:15,
    filter:{},
    createData:{
        email:null,
        name:null,
        locale:null,
        position:null,
        responsible_person:null
    },
    isCreate:false,
    isModify:false,
    datatable:{},
    datasource:{
        positions:[],
        responsible_people:[],
    },
    async retrieveusers(){
        await this.$wire.retrieveusers(this.page,this.perpage,this.filter)
            .then(async (response)=>{this.datatable = await response});
    },
    async getDataSource(){
        await this.$wire.getDataSource()
            .then(async (response)=>{this.datasource = await response});
    },
    async submit(){
        await this.$wire.submit(this.createData);
    },
    init(){
        this.retrieveusers();
        this.getDataSource();
    }
}" wire:ignore>
    <table class="table table-compact">
        <tr>
            <td><p class="uppercase font-semibold text-xs">ID</p></td>
            <td><p class="uppercase font-semibold text-xs">Name</p></td>
            <td><p class="uppercase font-semibold text-xs">Localize</p></td>
            <td><p class="uppercase font-semibold text-xs">Position</p></td>
            <td><p class="uppercase font-semibold text-xs">Resposible Person</p></td>
            <td><p class="uppercase font-semibold text-xs">Join</p></td>
            <td><button @click="isCreate=true" class="btn btn-xs btn-primary">Create</button></td>
        </tr>
        <template x-for="(elem, index) in datatable.data" :key="elem.id">
        <tr>
            <td><p class="uppercase text-xs" x-text="elem.email">ID</p></td>
            <td><p class="uppercase text-xs" x-text="elem.name">Name</p></td>
            <td><p class="uppercase text-xs" x-text="elem.locale">Localize</p></td>
            <td><p class="uppercase text-xs" x-text="''">Position</p></td>
            <td><p class="uppercase text-xs" x-text="''">Resposible Person</p></td>
            <td><p class="uppercase text-xs" x-text="elem.join">Join</p></td>
            <td><button @click="isModify=true" class="btn btn-xs btn-warning">Modify</button></td>
        </tr>
        </template>
    </table>

    <x-modal.sub-content-sm-popup active="isCreate">
        <div class="space-y-4">
            <div class="flex justify-center items-center gap-5">
                <p class="font-bold text-lg uppercase">Create</p>
            </div>
            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="label-text-alt block">ID</label>
                    <input x-model="createData.email" class="input input-sm input-bordered w-full">
                </div>
                <div>
                    <label class="label-text-alt block">Name</label>
                    <input x-model="createData.name" class="input input-sm input-bordered w-full">
                </div>
                <div>
                    <label class="label-text-alt block">Join</label>
                    <input x-model="createData.join" type="date" class="input input-sm input-bordered w-full">
                </div>
                <div>
                    <label class="label-text-alt block">Localize</label>
                    <input x-model="createData.locale" class="input input-sm input-bordered w-full">
                </div>
                <div>
                    <label class="label-text-alt block">Position</label>
                    <select x-model="createData.position" class="select select-sm select-bordered w-full">
                        <option value="">-</option>
                        <template x-for="item in datasource.positions" :key="item.value">
                            <option :value="item.value" x-text="item.text">-</option>
                        </template>
                    </select>
                </div>

                <div>
                    <label class="label-text-alt block">Responsible People</label>
                    <select x-model="createData.responsible_person" class="select select-sm select-bordered w-full">
                        <option value="">-</option>
                        <template x-for="item in datasource.responsible_people" :key="item.value">
                            <option :value="item.value" x-text="item.text">-</option>
                        </template>
                    </select>
                </div>
            </div>
            <div class="flex justify-center items-center gap-5">
                <button @click="submit()" class="btn btn-sm btn-success">Submit</button>
                <button @click="modalOpen=false" class="btn btn-sm btn-ghost btn-outline">Cancel</button>
            </div>
        </div>
    </x-modal.sub-content-sm-popup>

    <x-modal.sub-content-sm-popup active="isModify">
        <div>
            <div class="flex justify-center items-center gap-5">
                <button class="btn btn-sm btn-success">Update</button>
                <button @click="modalOpen=false" class="btn btn-sm btn-ghost btn-outline">Cancel</button>
            </div>
        </div>
    </x-modal.sub-content-sm-popup>

</div>
