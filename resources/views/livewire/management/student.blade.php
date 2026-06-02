<div>

    <div x-data="{
        page:1,
        per_page:15,
        accord:false,
        modalOpen:false,
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
                    }).then(()=>{ this.$wire.load() })
                });
        },
        viewDetail(param){
            this.modalOpen = true;
            this.selectedView = _.find(this.data.datatable,i=>i.id===param);
            console.log('select view', this.selectedView);
        },
        closeDetailView(){
            this.modalOpen = false;
            this.selectedView = {};
        },
        init(){
            this.$wire.load()
                .then((response)=>{ this.data = response });
            this.$wire.datatable(this.page,this.per_page,this.filter)
                .then((response) => { this.datatable = response;console.log('datatable',response); });
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



        <table class="table w-full">
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
                            <button @click="viewDetail(elem.id)" class="btn btn-sm btn-info">
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

            </tfoot>
        </table>

        <x-modal.sub-content-sm-popup>
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
