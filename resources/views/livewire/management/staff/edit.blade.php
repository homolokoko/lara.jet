<div x-data="{
    usr:{
        id:null,
        name_en:'',
        name_kh:'',
        edu_lvl:'',
        email:'',
        is_female:null,
        dob:'',
        is_married:null,
        position:'',
        lvl:'',
        img:{},
        tel_main:'',
        tel_opt:'',
        birth_address:{
            zip_id:null,
        },
        current_address:{
            zip_id:null,
        },
        other:'',
        roleList:[]
    },
    zips:[],
    roles:[],
    async save(){
        await this.$wire.save(this.usr)
            .then(()=>{
                swal.fire({
                    icon:'success',
                    title:'New Staff Created',
                    text: 'Closing ....',
                    showConfirmButton: false,
                    timer:1000,
                    timerProgressBar:true
                }).then(()=>{ $dispatch('reload-data-table') });
            })
    },
    async show(id){
        await this.$wire.show(id)
            .then((response)=>{
                this.usr = response;
                this.usr.roleList = _.map(response.roles,item=>_.toString(item.id));
            });
    },
    async upgrade(){
        await this.$wire.upgrade(this.usr)
            .then(()=>{
                    swal.fire({
                        icon:'success',
                        title:'Staff Upgraded Successfully',
                        text: 'Closing ....',
                        showConfirmButton: false,
                        timer:1000,
                        timerProgressBar:true
                    }).then(()=>{ $dispatch('reload-data-table') });
                })
    },
    async init(){
        await this.$wire.getRelatedList()
            .then(async (response)=>{
                this.zips= await response.zips;
                this.roles= await response.roles;
                this.levels = await response.levels;
                this.edu_levels = await response.edu_levels;
            });
    }
}" @edit-usr-info.window="show(event.detail)">

    <div class="grid grid-cols-3 gap-7">
        <div class="flex flex-col gap-5">
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Name (Khmer)</label>
                <input x-model="usr.locale" type="text" class="w-full input input-bordered">
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Name (English)</label>
                <input x-model="usr.name" type="text" class="w-full input input-bordered">
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Education Attainment</label>
                <select x-model="usr.edu_lvl" class="select select-bordered">
                    <option value="">-</option>
                    <template x-for="item in edu_levels" :key="item.value">
                        <option :value="item.value" x-text="item.text" :selected="item.value==usr.edu_lvl">Please Select Level</option>
                    </template>
                </select>
            </div>
        </div>

        <div class="flex flex-col gap-5">
            <div class="space-y-3">
                <label class="block label-text-alt" for="">ID</label>
                <input x-model="usr.email" type="text" readonly class="w-full input input-bordered">
            </div>
            <div class="flex gap-5">
                <div class="space-y-3">
                    <label class="block label-text-alt" for="">Gender</label>
                    <div class="flex gap-3">
                        <button @click="usr.is_female=0" :class="{'btn-active':usr.is_female==0}" class="btn btn-sm btn-primary btn-outline">M</button>
                        <button @click="usr.is_female=1" :class="{'btn-active':usr.is_female==1}" class="btn btn-sm btn-primary btn-outline">F</button>
                    </div>
                </div>
                <div class="space-y-3">
                    <label class="block label-text-alt" for="">Date of Birth</label>
                    <x-flatpickr model="usr.dob" />
                </div>
            </div>
            <template x-for="phone in usr.phonenumbers" :key="number">
                <div class="space-y-3">
                    <label class="block label-text-alt" for="">Phone Number</label>
                    <input x-model="phone.number" type="text" class="w-full input input-bordered">
                </div>
            </template>
        </div>

        <div class="flex flex-col gap-5">
            <x-single-file-upload disk="" model="usr.profile_photo_url" />
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Marry Status</label>
                <div class="flex gap-3">
                    <button @click="usr.is_married=0" :class="{'btn-active':usr.is_married==0}" class="btn btn-sm btn-primary btn-outline">Single</button>
                    <button @click="usr.is_married=1" :class="{'btn-active':usr.is_married==1}" class="btn btn-sm btn-primary btn-outline">Married</button>
                </div>
            </div>
            <div class="space-y-3">
                <div>
                    <div class="flex gap-5">
                        <div class="space-y-3">
                            <label class="block label-text-alt" for="">Role</label>
                            <div class="grid grid-cols-2 gap-4">
                                <template x-for="role in roles" :key="role.value">
                                    <div class="flex gap-3 items-center">
                                        <input type="checkbox" x-model="usr.roleList" :value="role.value" :checked="usr.roleList?.some(r => r === role.value)" class="checkbox checkbox-sm checkbox-primary">
                                        <label for="" class="label-text-alt uppercase"><p x-text="role.text"></p></label>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <label class="block label-text-alt" for="">Level</label>
                            <select x-model="usr.lvl" class="select select-bordered">
                                <option value="">-</option>
                                <template x-for="i in levels" :key="i">
                                    <option :value="i" x-text="i" :key="i==usr.lvl"></option>
                                </template>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-7">
        <template x-for="address in usr.addresses" :key="address.id">
           <div class="flex flex-col gap-5">
                <h3 class="label"><p x-text="address.is_current ? 'Current Address':'Birth Address'"></p></h3>
                <div class="space-y-3">
                    <label class="block label-text-alt" for="">Street/Village</label>
                    <input x-model="address.street.name" type="text" class="w-full input input-bordered">
                </div>
                <div class="space-y-3">
                    <label class="block label-text-alt" for="">City/Commune</label>
                    <input x-model="address.city.name" type="text" class="w-full input input-bordered">
                </div>
                <div class="space-y-3">
                    <label class="block label-text-alt" for="">State/District</label>
                    <input x-model="address.state.name" type="text" class="w-full input input-bordered">
                </div>
                <div class="space-y-3">
                    <label class="block label-text-alt" for="">Zip/Proving</label>
                    <select x-model="address.zip_id" class="w-full select select-bordered">
                        <option value="">-</option>
                        <template x-for="(elem, index) in zips" :key="elem.value">
                            <option :value="elem.value" x-text="elem.text" :selected="elem.value==address.zip.id"></option>
                        </template>
                    </select>
                </div>
            </div>
        </template>
        <div class="flex flex-col gap-5">
            <h3 class="label">Parent Career</h3>
            <div class="flex gap-5">
                <template x-for="elem in usr.relatives" :key="elem.id">
                    <div>
                        <div class="space-y-3">
                            <label class="block label-text-alt" for="">Is Current?</label>
                            <input x-model="elem.is_current" type="checkbox" class="checkbox checkbox-primary">
                            <label class="block label-text-alt" for=""><p x-text="elem.who_they.text"></p></label>
                            <input x-model="elem.name" type="text" class="w-full input input-bordered">
                        </div>
                        <div class="space-y-3">
                            <label class="block label-text-alt" for="">Job/Career</label>
                            <input x-model="elem.career" type="text" class="w-full input input-bordered">
                        </div>
                        <label class="block label-text-alt" for="">Phone Numbers</label>
                        <div class="space-y-3">
                            <template x-for="phone in elem.phonenumbers" :key="phone.id">
                                <input x-model="`0${phone.number}`" type="text" class="w-full input input-bordered">
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <div class="space-y-3 mt--5">
        <label class="block label-text-alt" for="">Other</label>
        <textarea x-model="usr.other" rows="4" class="w-full textarea textarea-bordered"></textarea>
    </div>

    <div class="flex justify-center w-full p-5">
        <button @click="upgrade()" class="btn btn-primary">Save</button>
    </div>

</div>
