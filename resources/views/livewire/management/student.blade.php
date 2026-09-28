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
            name_kh:'',
            name_en:'',
            gender:'',
            dob:'',
            other:'',
            class_room:'',
            staff:'',
            shift:'',
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
        init(){
            this.$wire.load()
                .then((response)=>{ this.data = response });
            this.triggerPage(1);
        }
    }" class="border divide-y rounded-lg">

        <div class="tabs tabs-boxed">
            <a @click="tab='table'" class="tab" :class="{'tab-active':tab=='table'}">
                Data Source</a>
            <a @click="tab='add'" class="tab" :class="{'tab-active':tab=='add'}">
                Create Person Information</a>
            <a class="tab" :class="{'tab-active':tab=='edit'}">
                Edit Person Information</a>
        </div>

        <div x-show="tab=='table'">
            @include('livewire.management.student.table')
        </div>
        <div x-show="tab=='add'">
            @include('livewire.management.student.add')
        </div>
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
                                            x-text="`Name : ${selectedView.name_kh}`"></label>
                                    </li>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Name : ${selectedView.name_en}`"></label>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Sex : ${selectedView.gender}`"></label>
                                    </li>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Date Of Birth : ${selectedView.official_dob}`"></label>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>BIRTH PLACE</th>
                            <th>CURRENT PLACE</th>
                        </tr>
                        <tr>
                            <td>
                                <ul>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Village : ${selectedView.birth_address.name}`"></label>
                                    </li>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Commune : ${selectedView.birth_address.city.name}`"></label>
                                    </li>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`District : ${selectedView.birth_address.state.name}`"></label>
                                    </li>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Proving : ${selectedView.birth_address.zip.name}`"></label>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Village : ${selectedView.current_address.name}`"></label>
                                    </li>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Commune : ${selectedView.current_address.city.name}`"></label>
                                    </li>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`District : ${selectedView.current_address.state.name}`"></label>
                                    </li>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Proving : ${selectedView.current_address.zip.name}`"></label>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>FATHER INFORMATION</th>
                            <th>MOTHER INFORMATION</th>
                        </tr>
                        <tr>
                            <td>
                                <ul>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Name : ${selectedView.father_info.name}`"></label>
                                    </li>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Profession : ${selectedView.father_info.job}`"></label>
                                    </li>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Main Number : ${selectedView.father_info.main_number}`"></label>
                                    </li>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Seconday Number : ${selectedView.father_info.subs_number}`"></label>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Name : ${selectedView.mother_info.name}`"></label>
                                    </li>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Profession : ${selectedView.mother_info.job}`"></label>
                                    </li>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Main Number : ${selectedView.mother_info.main_number}`"></label>
                                    </li>
                                    <li>
                                        <label class="label-text-alt uppercase"
                                            x-text="`Seconday Number : ${selectedView.mother_info.subs_number}`"></label>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-center items-center p-5">
                    <button @click="closeDetailView()" class="btn btn-ghost">Close</button>
                </div>
            </div>
        </x-modal.sub-content-sm-popup>

    </div>
</div>