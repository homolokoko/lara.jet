<div>

    <div x-data="{
        tab:'table',
        page:1,
        per_page:10,
        add:false,
        view:false,
        edit: false,
        editInfo:{},
        selectedView:{},
        result:{
            name:'',
            locale:'',
            detail:{
                dob:'',
                room:null,

            },
            dob:'',
            other:'',
            room:'',
            staff:'',
            shift:'',
            is_female:false,
            birth:{
                street:'',
                city:'',
                state:'',
                zip:''
            },
            cur:{
                street:'',
                city:'',
                state:'',
                zip:''
            },
            father:{
                name:'',
                job:'',
                main_number:'',
                subs_number:''
            },
            mother:{
                name:'',
                job:'',
                main_number:'',
                subs_number:''
            }
        },
        data:{
            zips:[],
            staffs:[],
        },
        datatable:{},
        async create(){
            await this.$wire.create(this.result)
                .then(()=>{
                    swal.fire({
                        icon: 'success',
                        title: 'Created Success!',
                        timer: 1000,
                        showConfirmButton: false
                    }).then(()=>{ this.tab='table'; this.triggerPage(this.page); })
                });
        },
        viewRecord(param){
            this.view = true;
            this.selectedView = _.find(this.datatable.data,i=>i.id===param);
        },
        editRecord(param){
            this.tab = 'edit';
            this.editInfo = _.find(this.datatable.data,i=>i.id===param);
            if(_.isEmpty(this.editInfo.detail))
                this.editInfo.detail = {
                    dob:null,
                    room:null,
                    shift:null,
                    is_female:null,
                };
            if(_.isEmpty(this.editInfo.addresses))
                this.editInfo.addresses = [
                    {
                        is_current:false,
                        street:{name:''},
                        city:{name:''},
                        state:{name:''},
                        zip_id:null
                    },
                    {
                        is_current:true,
                        street:{name:''},
                        city:{name:''},
                        state:{name:''},
                        zip_id:null
                    },
                ];
            if(_.isEmpty(this.editInfo.relatives))
                this.editInfo.relatives = [
                    {
                        is_current:true,
                        who_they:{value:1,text:'Mother'},
                        phonenumbers:[
                            {number:''},
                            {number:''},
                        ],
                    },
                    {
                        is_current:true,
                        who_they:{value:2,text:'Father'},
                        phonenumbers:[
                            {number:''},
                            {number:''},
                        ],
                    },
                ];

        },
        async updateRecord(){
            await this.$wire.updateRecord(this.editInfo)
                .then(()=>{
                    swal.fire({
                        icon: 'success',
                        title: 'Updated Success!',
                        timer: 1000,
                        showConfirmButton: false
                    }).then(()=>{ this.tab = 'table';this.triggerPage(this.page); })
                })
        },
        deleteRecord(param){
            swal.fire({
                icon: 'question',
                title: 'Delete Record',
                text: 'Are you wish to delete this record?',
                showDenyButton:true
            }).then((result)=>{
                if(result.isConfirmed)
                    this.$wire.deleteRecord(param)
                        .then(()=>{
                            swal.fire({
                                icon: 'success',
                                title: 'Deleted Success',
                                timer: 1500,
                                showConfirmButton:false
                            }).then(()=>{ this.triggerPage(this.page); })
                        })
            })
        },
        closeDetailView(){
            this.view = false;
            this.selectedView = {};
        },
        closeEditView(){
            this.tab = 'table';
        },
        triggerPage(number){
            this.datatable.data = [];
            this.$wire.datatable( number ?? this.page,this.per_page,this.filter)
                .then((response) => { this.datatable = response;console.log('datatable',response); });
        },
        selectedPerpage(){
            this.$wire.datatable(this.page,this.per_page,this.filter)
                .then((response) => { this.datatable = response;console.log('datatable',response); });
        },
        selectedPage(page){
            this.page = page;
            this.datatable();
        },
        async load(){
            await this.$wire.load()
                .then((response)=>{ this.data = response });
        },
        async datatable(){
            await this.$wire.datatable(this.page,this.per_page,this.filter)
                .then((response) => {this.datatable = response;});
        },
        init(){
            this.load();
            this.datatable();
        }
    }" class="border divide-y rounded-lg">

        <div class="tabs tabs-boxed">
            <a @click="tab='table'" class="tab" :class="{'tab-active':tab=='table'}">
                Data Source</a>
            {{-- <a @click="tab='add'" class="tab" :class="{'tab-active':tab=='add'}">
                Create Person Information</a> --}}
            <a class="tab" :class="{'tab-active':tab=='edit'}">
                Edit Person Information</a>
        </div>

        <div x-show="tab=='table'">
            @include('livewire.management.student.table')
        </div>
        {{-- <div x-show="tab=='add'">
            @include('livewire.management.student.add')
        </div> --}}
        <div x-show="tab=='edit'">
            @include('livewire.management.student.edit')
        </div>


        <x-modal.sub-content-sm-popup :active="'view'">
            <div class="border overflow-hidden rounded gap-5 divide-y ">
                <div class="flex p-5 justify-between">
                    <h3 class="font-bold text-xl">PERSONAL INFORMATION</h3>
                    <button @click="closeDetailView()" class="btn btn-circle btn-sm btn-error">
                        <x-heroicon-o-x class="w-5 h-5" />
                    </button>
                </div>
                <table class="table table-normal w-full">
                    <tbody>
                        <tr>
                            <td>
                                <ul>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Locate : ${selectedView.locale}`"></label>
                                    </li>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Name : ${selectedView.name}`"></label>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Sex : ${selectedView.detail.is_female ? 'F':'M'}`"></label>
                                    </li>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Date Of Birth : ${selectedView.detail.dob}`"></label>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex gap-5">
                    <template x-for="address in selectedView.addresses">
                        <div class="space-y-5">
                            <h3 class="text-xs uppercase font-semibold" x-text="address.is_current ? 'Current Place':'Birth Place'"></h3>
                            <div>
                                <label for="" class="label-text-alt uppercase">Street</label>
                                <p x-text="address.street.name"></p>
                            </div>
                            <div>
                                <label for="" class="label-text-alt uppercase">City</label>
                                <p x-text="address.city.name"></p>
                            </div>
                            <div>
                                <label for="" class="label-text-alt uppercase">State</label>
                                <p x-text="address.state.name"></p>
                            </div>
                            <div>
                                <label for="" class="label-text-alt uppercase">Zip</label>
                                <p x-text="address.zip.name"></p>
                            </div>
                        </div>
                    </template>
                    <template x-for="relative in selectedView.relatives">
                        <div class="space-y-5">
                            <h3 class="text-xs font-semibold uppercase" x-text="relative.who_they.text"></h3>
                            <div>
                                <label for="" class="label-text-alt uppercase">Name</label>
                                <p x-text="relative.name"></p>
                            </div>
                            <div>
                                <label for="" class="label-text-alt uppercase">Career</label>
                                <p x-text="relative.career"></p>
                            </div>
                            <h3 class="text-xs font-semibold uppercase">Phone Numbers</h3>
                            <template x-for="phone in relative.phonenumbers">
                                <p x-text="phone.number"></p>
                            </template>
                        </div>
                    </template>
                </div>
                <div class="flex justify-center items-center p-5">
                    <button @click="closeDetailView()" class="btn btn-ghost">Close</button>
                </div>
            </div>
        </x-modal.sub-content-sm-popup>

    </div>
</div>
