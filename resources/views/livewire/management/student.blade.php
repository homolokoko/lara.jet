<div>

    <div x-data="{
        page:1,
        per_page:15,
        accord:false,
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
                    }).then(()=>{ this.triggerPage(this.page); })
                });
        },
        viewRecord(param){
            this.view = true;
            this.selectedView = _.find(this.datatable.data,i=>i.id===param);
        },
        editRecord(param){
            this.edit = true;
            this.editInfo = _.find(this.datatable.data,i=>i.id===param);
        },
        updateRecord(){
            console.log('update record', this.editInfo);
            this.$wire.updateRecord(this.editInfo)
                .then(()=>{
                    swal.fire({
                        icon: 'success',
                        title: 'Updated Success!',
                        timer: 1000,
                        showConfirmButton: false
                    }).then(()=>{ this.edit = false;this.triggerPage(this.page); })
                })
            console.log('view data', this.editInfo);
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
            this.edit = false;
        },
        triggerPage(number){
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

        <div>
            <div class="p-5"><button @click="accord=!accord" class=" btn btn-block">Create More</button></div>
            <div x-show="accord">
                <div id="create" class="p-5 ">
                    <table class="table w-full">
                        <tr>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Kh Name</label>
                                <input type="text" x-model="result.name_kh" class="block w-full input input-bordered">
                            </td>
                            <td class="row-span-2 space-y-3">
                                <label for="" class="label-text-alt">En Name</label>
                                <input type="text" x-model="result.name_en" class="block w-full input input-bordered">
                            </td>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Gender</label>
                                <div>
                                    <div class="flex items-center gap-4">
                                        <input id="male" x-model="result.gender" value="m"
                                            class=" radio radio-primary radio-md" type="radio" name="gender">
                                        <label for="male" class=" badge badge-outline badge-ghost">Male</label>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <input id="female" x-model="result.gender" value="f"
                                            class=" radio radio-primary radio-md" type="radio" name="gender">
                                        <label for="female" class=" badge badge-outline badge-ghost">Female</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Date of Birth</label>
                                <x-flatpickr model="result.dob" />
                            </td>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Other</label>
                                <input type="text" x-model="result.other" class="block w-full input input-bordered">
                            </td>
                            <td rowspan="2" class="space-y-3">
                                <label for="" class="label-text-alt">Shift</label>
                                <div>
                                    <div class="flex items-center gap-4">
                                        <input id="i" x-model="result.shift" value="i"
                                            class=" radio radio-primary radio-md" type="radio" name="shift">
                                        <label for="i" class=" badge badge-outline badge-ghost">07:30-10:30</label>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <input id="ii" x-model="result.shift" value="ii"
                                            class=" radio radio-primary radio-md" type="radio" name="shift">
                                        <label for="ii" class=" badge badge-outline badge-ghost">01:30-04:30</label>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <input id="iii" x-model="result.shift" value="iii"
                                            class=" radio radio-primary radio-md" type="radio" name="shift">
                                        <label for="iii" class=" badge badge-outline badge-ghost">05:30-06:30</label>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <input id="iv" x-model="result.shift" value="iv"
                                            class=" radio radio-primary radio-md" type="radio" name="shift">
                                        <label for="iv" class=" badge badge-outline badge-ghost">06:30-07:30</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Class Room</label>
                                <div>
                                    <select x-model="result.class_room" class="w-full select select-bordered">
                                        <option selected>Room</option>
                                        <template x-for="i in 10" :key="i">
                                            <option :value="i" x-text="i"></option>
                                        </template>
                                    </select>
                                </div>
                            </td>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Person in Charge</label>
                                <div>
                                    <select x-model="result.staff" class="w-full select select-bordered">
                                        <option selected>Please Select Mentor</option>
                                        <template x-for="(elem, index) in data.staffs" :key="elem.value">
                                            <option :value="elem.value" x-text="elem.text"></option>
                                        </template>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="create" class="p-5 ">
                    <h3>Birth Place</h3>
                    <table class="table w-full">
                        <tr>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Village</label>
                                <input type="text" x-model="result.birth.street"
                                    class="block w-full input input-bordered">
                            </td>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Commune</label>
                                <input type="text" x-model="result.birth.city"
                                    class="block w-full input input-bordered">
                            </td>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">District</label>
                                <input type="text" x-model="result.birth.state"
                                    class="block w-full input input-bordered">
                            </td>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Proving</label>
                                <div>
                                    <select x-model="result.birth.zip" class="w-full select select-bordered">
                                        <option selected>Please Select Proving</option>
                                        <template x-for="(elem, index) in data.zips" :key="elem.value">
                                            <option :value="elem.value" x-text="elem.text"></option>
                                        </template>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <h3>Current Place</h3>
                    <table class="table w-full">
                        <tr>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Village</label>
                                <input type="text" x-model="result.cur.street"
                                    class="block w-full input input-bordered">
                            </td>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Commune</label>
                                <input type="text" x-model="result.cur.city" class="block w-full input input-bordered">
                            </td>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">District</label>
                                <input type="text" x-model="result.cur.state" class="block w-full input input-bordered">
                            </td>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Proving</label>
                                <div>
                                    <select x-model="result.cur.zip" class="w-full select select-bordered">
                                        <option selected>Please Select Proving</option>
                                        <template x-for="(elem, index) in data.zips" :key="elem.value">
                                            <option :value="elem.value" x-text="elem.text"></option>
                                        </template>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="create" class="p-5 ">
                    <table class="table w-full">
                        <tr>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Father's Name</label>
                                <input type="text" x-model="result.father.name"
                                    class="block w-full input input-bordered">
                            </td>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Occupation</label>
                                <input type="text" x-model="result.father.job"
                                    class="block w-full input input-bordered">
                            </td>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Main Phonenumber</label>
                                <input type="text" x-model="result.father.main_number"
                                    class="block w-full input input-bordered">
                            </td>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Subs Phonenumber</label>
                                <input type="text" x-model="result.father.subs_number"
                                    class="block w-full input input-bordered">
                            </td>
                        </tr>
                        <tr>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Mother's Name</label>
                                <input type="text" x-model="result.mother.name"
                                    class="block w-full input input-bordered">
                            </td>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Occupation</label>
                                <input type="text" x-model="result.mother.job"
                                    class="block w-full input input-bordered">
                            </td>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Main Phonenumber</label>
                                <input type="text" x-model="result.mother.main_number"
                                    class="block w-full input input-bordered">
                            </td>
                            <td class="space-y-3">
                                <label for="" class="label-text-alt">Subs Phonenumber</label>
                                <input type="text" x-model="result.mother.subs_number"
                                    class="block w-full input input-bordered">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="flex justify-center p-5"><button @click="create()" class="btn"> Submit </button>
                </div>
            </div>
        </div>



        <table class="table w-full table-compact">
            <thead>
                <tr>
                    <td>Kh Name</td>
                    <td>En Name</td>
                    <td>Gender</td>
                    <td>Date Of Birth</td>
                    <td>Other</td>
                    <td>Shift</td>
                    <td>Class Room</td>
                    <td>Mentor</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <template x-for="(elem, index) in datatable.data" x-bind:key="elem.id">
                    <tr>
                        <td><span x-text="elem.name_kh">Kh Name</span></td>
                        <td><span x-text="elem.name_en">En Name</span></td>
                        <td><span class="uppercase" x-text="elem.gender">Gender</span></td>
                        <td><span x-text="elem.official_dob">DoB</span></td>
                        <td><span>Other</span></td>
                        <td><span x-text="elem.shift_period"></td>
                        <td><span x-text="elem.room">Class Room</span></td>
                        <td><span x-text="elem.staff.name">Mentor</span></td>
                        <td>
                            <button @click="viewRecord(elem.id)" class="btn btn-sm btn-info">
                                <x-heroicon-o-search class="w-5 h-5" />
                            </button>
                            <button @click="editRecord(elem.id)" class="btn btn-sm btn-accent">
                                <x-heroicon-o-pencil class="w-5 h-5" />
                            </button>
                            <button @click="deleteRecord(elem.id)" class="btn btn-sm btn-error">
                                <x-heroicon-o-trash class="w-5 h-5" />
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="9">
                        <div class="flex gap-5 items-center">
                            <div class="flex">
                                <a @click="triggerPage(1)" :disabled="datatable.current_page==1"
                                    class="btn btn-sm btn-secondary rounded-none">⇦first</a>
                                <template x-for="(link,linkIndex) in datatable.links">
                                    <a @click="triggerPage(link.page)" class="btn btn-sm btn-secondary rounded-none"
                                        :disabled="link.active || !link.url" x-text="link.label"></a>
                                </template>
                                <a @click="triggerPage(datatable.last_page)"
                                    :disabled="datatable.current_page==datatable.last_page"
                                    class="btn btn-sm btn-secondary rounded-none">last⇨</a>
                            </div>
                            <div class="flex gap-2 items-center">
                                <h3>Per page</h3>
                                <select x-model="per_page" @change="selectedPerpage()" class="h-10 rounded-lg">
                                    <option value>per page</option>
                                    <option value=5>5</option>
                                    <option value=10>10</option>
                                    <option value=15>15</option>
                                    <option value=25>25</option>
                                    <option value=50>50</option>
                                </select>
                            </div>
                            <div class="badge badge-md" x-text="`Current page : ${datatable.current_page}`"></div>
                            <div class="badge badge-md" x-text="`From : ${datatable.from}`"></div>
                            <div class="badge badge-md" x-text="`To : ${datatable.to}`"></div>
                            <div class="badge badge-md" x-text="`Total : ${datatable.total}`"></div>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>

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

        <x-modal.sub-content-lg-popup :active="'edit'">
            <div class="border overflow-hidden rounded gap-5 divide-y overflow-y-auto max-h-96">
                <div class="flex p-5 justify-between">
                    <h3 class="font-bold text-xl">EDIT PERSONAL INFORMATION</h3>
                    <button @click="closeEditView()" class="btn btn-circle btn-sm btn-error">
                        <x-heroicon-o-x class="w-5 h-5" />
                    </button>
                </div>
                <table class="table table-normal w-full">
                    <tbody>
                        <tr>
                            <td>
                                <ul class="space-y-4">
                                    <li>
                                        <div class="space-y-2">
                                            <label class="label-text-alt uppercase block">KH Name</label>
                                            <input type="text" x-model="editInfo.name_kh"
                                                class="input input-bordered w-full">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="space-y-2">
                                            <label class="label-text-alt uppercase block">EN Name</label>
                                            <input type="text" x-model="editInfo.name_en"
                                                class="input input-bordered w-full">
                                        </div>
                                    </li>
                                    <li class="space-y-3">
                                        <label for="" class="label-text-alt uppercase block">Shift</label>
                                        <div>
                                            <div class="flex items-center gap-4">
                                                <input id="i" x-model="editInfo.shift" value="i"
                                                    class=" radio radio-primary radio-md" type="radio" name="shift">
                                                <label for="i"
                                                    class=" badge badge-outline badge-ghost">07:30-10:30</label>
                                            </div>
                                            <div class="flex items-center gap-4">
                                                <input id="ii" x-model="editInfo.shift" value="ii"
                                                    class=" radio radio-primary radio-md" type="radio" name="shift">
                                                <label for="ii"
                                                    class=" badge badge-outline badge-ghost">01:30-04:30</label>
                                            </div>
                                            <div class="flex items-center gap-4">
                                                <input id="iii" x-model="editInfo.shift" value="iii"
                                                    class=" radio radio-primary radio-md" type="radio" name="shift">
                                                <label for="iii"
                                                    class=" badge badge-outline badge-ghost">05:30-06:30</label>
                                            </div>
                                            <div class="flex items-center gap-4">
                                                <input id="iv" x-model="editInfo.shift" value="iv"
                                                    class=" radio radio-primary radio-md" type="radio" name="shift">
                                                <label for="iv"
                                                    class=" badge badge-outline badge-ghost">06:30-07:30</label>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="" class="label-text-alt uppercase block">Class Room</label>
                                        <div>
                                            <select x-model="editInfo.class_room" class="w-full select select-bordered">
                                                <option disabled>Room</option>
                                                <template x-for="i in 10" :key="i">
                                                    <option :value="i" x-text="i" :selected="i==editInfo.room"></option>
                                                </template>
                                            </select>
                                        </div>
                                    </li>
                                    <li class="space-y-2">
                                        <label for="" class="label-text-alt uppercase block">Person in Charge</label>
                                        <div>
                                            <select x-model="editInfo.staff" class="w-full select select-bordered">
                                                <option selected>Please Select Mentor</option>
                                                <template x-for="(elem, index) in data.staffs" :key="elem.value">
                                                    <option :value="elem.value" x-text="elem.text"
                                                        :selected="elem.value==editInfo.staff_id"></option>
                                                </template>
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <ul class="space-y-4">
                                    <li>
                                        <div class="space-y-2">
                                            <label class="label-text-alt uppercase block"
                                                x-text="`Sex : ${editInfo.gender}`"></label>
                                            <div>
                                                <div class="flex items-center gap-4">
                                                    <input id="male" x-model="editInfo.gender" value="m"
                                                        class=" radio radio-primary radio-md" type="radio"
                                                        name="gender">
                                                    <label for="male"
                                                        class=" badge badge-outline badge-ghost">Male</label>
                                                </div>
                                                <div class="flex items-center gap-4">
                                                    <input id="female" x-model="editInfo.gender" value="f"
                                                        class=" radio radio-primary radio-md" type="radio"
                                                        name="gender">
                                                    <label for="female"
                                                        class=" badge badge-outline badge-ghost">Female</label>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="space-y-2">
                                            <label class="label-text-alt uppercase block"
                                                x-text="`Date Of Birth : ${editInfo.official_dob}`"></label>
                                            <x-flatpickr model="editInfo.dob" />
                                        </div>
                                    </li>
                                    <li>
                                        <label for="" class="label-text-alt uppercase block">Other</label>
                                        <textarea x-model="editInfo.other" cols="30" rows="5"
                                            class="textarea textarea-bordered w-full"></textarea>
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
                                <ul class="space-y-4">
                                    <li>
                                        <div class="space-y-2">
                                            <label class="label-text-alt uppercase block">Village/Street</label>
                                            <input type="text" x-model="editInfo.birth_address.name"
                                                class="input input-bordered w-full">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="space-y-2">
                                            <label class="label-text-alt uppercase block">Commune/City</label>
                                            <input type="text" x-model="editInfo.birth_address.city.name"
                                                class="input input-bordered w-full">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="space-y-2">
                                            <label class="label-text-alt uppercase block">District/State</label>
                                            <input type="text" x-model="editInfo.birth_address.state.name"
                                                class="input input-bordered w-full">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="space-y-2">
                                            <label class="label-text-alt uppercase block">Proving/Zip</label>
                                            <select x-model="editInfo.birth_address.zip"
                                                class="w-full select select-bordered">
                                                <option selected>Please Select Proving</option>
                                                <template x-for="(elem, index) in data.zips" :key="elem.value">
                                                    <option :value="elem.value" x-text="elem.text"
                                                        :selected="elem.value==editInfo.birth_address.zip.id">
                                                    </option>
                                                </template>
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <ul class="space-y-4" <li>
                                    <div class="space-y-2">
                                        <label class="label-text-alt uppercase block">Village/Street</label>
                                        <input type="text" x-model="editInfo.current_address.name"
                                            class="input input-bordered w-full">
                                    </div>
                                    </li>
                                    <li>
                                        <div class="space-y-2">
                                            <label class="label-text-alt uppercase block">Commune/City</label>
                                            <input type="text" x-model="editInfo.current_address.city.name"
                                                class="input input-bordered w-full">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="space-y-2">
                                            <label class="label-text-alt uppercase block">District/State</label>
                                            <input type="text" x-model="editInfo.current_address.state.name"
                                                class="input input-bordered w-full">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="space-y-2">
                                            <label class="label-text-alt uppercase block">Proving/Zip</label>
                                            <select x-model="editInfo.current_address.zip"
                                                class="w-full select select-bordered">
                                                <option selected>Please Select Proving</option>
                                                <template x-for="(elem, index) in data.zips" :key="elem.value">
                                                    <option :value="elem.value" x-text="elem.text"
                                                        :selected="elem.value==editInfo.current_address.zip.id">
                                                    </option>
                                                </template>
                                            </select>
                                        </div>
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
                                <ul class="space-y-4">
                                    <li>
                                        <div class="space-y-2">
                                            <label class="label-text-alt uppercase block">Name</label>
                                            <input type="text" x-model="editInfo.father_info.name"
                                                class="input input-bordered w-full">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="space-y-2">
                                            <label class="label-text-alt uppercase block">Career</label>
                                            <input type="text" x-model="editInfo.father_info.job"
                                                class="input input-bordered w-full">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="space-y-2">
                                            <label class="label-text-alt uppercase block">Main Number</label>
                                            <input type="text" x-model="editInfo.father_info.main_number"
                                                class="input input-bordered w-full">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="space-y-2">
                                            <label class="label-text-alt uppercase block">Secondary Number</label>
                                            <input type="text" x-model="editInfo.father_info.subs_number"
                                                class="input input-bordered w-full">
                                        </div>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <ul class="space-y-4">
                                    <li>
                                        <div class="space-y-2">
                                            <label class="label-text-alt uppercase block">Name</label>
                                            <input type="text" x-model="editInfo.mother_info.name"
                                                class="input input-bordered w-full">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="space-y-2">
                                            <label class="label-text-alt uppercase block">Career</label>
                                            <input type="text" x-model="editInfo.mother_info.job"
                                                class="input input-bordered w-full">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="space-y-2">
                                            <label class="label-text-alt uppercase block">Main Number</label>
                                            <input type="text" x-model="editInfo.mother_info.main_number"
                                                class="input input-bordered w-full">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="space-y-2">
                                            <label class="label-text-alt uppercase block">Secondary Number</label>
                                            <input type="text" x-model="editInfo.mother_info.subs_number"
                                                class="input input-bordered w-full">
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-center items-center p-5 gap-7">
                    <button @click="closeEditView()" class="btn btn-ghost">Close</button>
                    <button @click="updateRecord()" class="btn btn-info">Update</button>
                </div>
            </div>
        </x-modal.sub-content-lg-popup>

    </div>
</div>