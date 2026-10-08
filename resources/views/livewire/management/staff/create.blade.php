<div x-data="{
    usr:{
        name_en:'',
        name_kh:'',
        edu_lvl:'',
        email:'',
        is_female:null,
        dob:'',
        tel_main:'',
        tel_opt:'',
        is_married:null,
        position:'',
        lvl:'',
        img:{},
        birth_add:{
            street:'',
            city:'',
            state:'',
            zip:null,
        },
        current_add:{
            street:'',
            city:'',
            state:'',
            zip:null,
        },
        parent_info:{
            dad_name:'',
            mom_name:'',
            dad_career:'',
            mom_career:''
        },
        other:''
    },
    zips:[],
    levels:[],
    positions:[],
    edu_levels:[],
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
    async init(){
        await this.$wire.getRelatedList()
            .then(async (response)=>{
                this.zips = await response.zips;
                this.positions = await response.positions;
                this.levels = await response.levels;
                this.edu_levels = await response.edu_levels;
            });
    },
}">


    {{-- Be like water. --}}
    <div class="grid grid-cols-3 gap-7">
        <div class="flex flex-col gap-5">
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Name (Khmer)</label>
                <input x-model="usr.name_kh" type="text" class="w-full input input-bordered">
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Name (English)</label>
                <input x-model="usr.name_en" type="text" class="w-full input input-bordered">
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Education Attainment</label>
                <select x-model="usr.edu_lvl" class="select select-bordered">
                    <option value="">-</option>
                    <template x-for="item in edu_levels" :key="item.value">
                        <option :value="item.value" x-text="item.text">Please Select Level</option>
                    </template>
                </select>
            </div>
        </div>

        <div class="flex flex-col gap-5">
            <div class="space-y-3">
                <label class="block label-text-alt" for="">ID</label>
                <input x-model="usr.email" type="text" class="w-full input input-bordered">
            </div>
            <div class="flex gap-5">
                <div class="space-y-3">
                    <label class="block label-text-alt" for="">Gender</label>
                    <div class="flex gap-3">
                        <button @click="usr.is_female=0" :class="{'btn-active':usr.is_female==0}" class="btn btn-sm btn-outline btn-ghost">M</button>
                        <button @click="usr.is_female=1" :class="{'btn-active':usr.is_female==1}" class="btn btn-sm btn-outline btn-ghost">F</button>
                    </div>
                </div>
                <div class="space-y-3">
                    <label class="block label-text-alt" for="">Date of Birth</label>
                    <x-flatpickr model="usr.dob" />
                </div>
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Phone Number (Main)</label>
                <input x-model="usr.tel_main" type="text" class="w-full input input-bordered">
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Phone Number (Optional)</label>
                <input x-model="usr.tel_opt" type="text" class="w-full input input-bordered">
            </div>
        </div>

        <div class="flex flex-col gap-5">
            <x-single-file-upload disk="" model="usr.img" />
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Marry Status</label>
                <div class="flex gap-3">
                    <button @click="usr.is_married=0" :class="{'btn-active':usr.is_married==0}" class="btn btn-sm btn-outline btn-ghost">Single</button>
                    <button @click="usr.is_married=1" :class="{'btn-active':usr.is_married==1}" class="btn btn-sm btn-outline btn-ghost">Married</button>
                </div>
            </div>
            <div>
                <div class="flex gap-5">
                    <div class="space-y-3">
                        <label class="block label-text-alt" for="">Position</label>
                        <select x-model="usr.position" class="select select-bordered">
                            <option value="">-</option>
                            <template x-for="(elem, index) in positions" :key="elem.value">
                                <option :value="elem.value" x-text="elem.text"></option>
                            </template>
                        </select>
                    </div>
                    <div class="space-y-3">
                        <label class="block label-text-alt" for="">Level</label>
                        <select x-model="usr.lvl" class="select select-bordered">
                            <option value="">-</option>
                            <template x-for="i in levels" :key="i">
                                <option :value="i" x-text="i"></option>
                            </template>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-7">
        <div class="flex flex-col gap-5">
            <h3 class="label">Birth Address</h3>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Street/Village</label>
                <input x-model="usr.birth_add.street" type="text" class="w-full input input-bordered">
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">City/Commune</label>
                <input x-model="usr.birth_add.city" type="text" class="w-full input input-bordered">
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">State/District</label>
                <input x-model="usr.birth_add.state" type="text" class="w-full input input-bordered">
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Zip/Proving</label>
                <select x-model="usr.birth_add.zip" class="w-full select select-bordered">
                    <option>-</option>
                    <template x-for="(elem, index) in zips" :key="elem.value">
                        <option :value="elem.value" x-text="elem.text"></option>
                    </template>
                </select>
            </div>
        </div>
        <div class="flex flex-col gap-5">
            <h3 class="label">Current Address</h3>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Street/Village</label>
                <input x-model="usr.current_add.street" type="text" class="w-full input input-bordered">
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">City/Commune</label>
                <input x-model="usr.current_add.city" type="text" class="w-full input input-bordered">
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">State/District</label>
                <input x-model="usr.current_add.state" type="text" class="w-full input input-bordered">
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Zip/Proving</label>
                <select x-model="usr.current_add.zip" class="w-full select select-bordered">
                    <option>-</option>
                    <template x-for="(elem, index) in zips" :key="elem.value">
                        <option :value="elem.value" x-text="elem.text"></option>
                    </template>
                </select>
            </div>
        </div>
        <div class="flex flex-col gap-5">
            <h3 class="label">Parent Career</h3>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Father's Name</label>
                <input x-model="usr.parent_info.dad_name" type="text" class="w-full input input-bordered">
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Job/Career</label>
                <input x-model="usr.parent_info.dad_career" type="text" class="w-full input input-bordered">
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Mother's Name</label>
                <input x-model="usr.parent_info.mom_name" type="text" class="w-full input input-bordered">
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Job/Career</label>
                <input x-model="usr.parent_info.mom_career" type="text" class="w-full input input-bordered">
            </div>
        </div>
    </div>

    <div class="space-y-3 mt--5">
        <label class="block label-text-alt" for="">Other</label>
        <textarea x-model="usr.other" rows="4" class="w-full textarea textarea-bordered"></textarea>
    </div>

    <div class="flex justify-center w-full p-5">
        <button @click="save()" class="btn btn-primary">Save</button>
    </div>

</div>
