<div x-data="{
    usr:{
        id:null,
        name:'',
        email:'',
        locale:'',
        detail:{},
        photo:{},
        roles:[],
        roleList:[],
        relatives:[],
        addresses:[],
        phonenumbers:[]
    },
    zips:[],
    roles:[],
    levels:[],
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
    async show(id){
        await this.$wire.show(id)
            .then((response)=>{
                this.usr.id = response.id;
                this.usr.name = response.name;
                this.usr.email = response.email;
                this.usr.locale = response.locale;
                this.usr.other = response.other;
                this.usr.roles = response.roles;
                this.usr.detail = response.detail;
                if(_.isEmpty(response.addresses)){
                    this.usr.detail = {
                        lvl:null,
                        edu_lvl:null,
                        dob:'',
                        is_female:0,
                        is_married:0
                    };
                }else{ this.usr.detail = response.detail; }
                if(_.isEmpty(response.addresses)){
                    this.usr.addresses = [
                        {is_current:0},
                        {is_current:1},
                    ];
                }else{ this.usr.relatives = response.relatives; }
                if(_.isEmpty(response.relatives)){
                    this.usr.relatives = [
                        {
                            who_they:{value:1,text:'Mother'},
                            phonenumbers:[{number:''},{number:''}]
                        },
                        {
                            who_they:{value:2,text:'Father'},
                            phonenumbers:[{number:''},{number:''}]
                        },
                    ];
                }else{ this.usr.relatives = response.relatives; }
                this.usr.phonenumbers = response.phonenumbers;
                this.usr.photo = {
                    url:response.profile_photo_url,
                    file_path:response.profile_photo_path ?? 'not found'
                };
                this.usr.roleList = _.map(response.roles,item=>_.toString(item.id));
                console.log('this user', this.usr);
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
                    }).then(()=>{
                        this.show(this.usr.id);
                        $dispatch('reload-data-table');
                    });
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
                <select x-model="usr.detail.edu_lvl" class="select select-bordered">
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
                <input x-model="usr.email" type="text" readonly class="w-full input input-bordered">
            </div>
            <div class="flex gap-5">
                <div class="space-y-3">
                    <label class="block label-text-alt" for="">Gender</label>
                    <div class="flex gap-3">
                        <button @click="usr.detail.is_female=0" :class="{'btn-active':!usr.detail.is_female}" class="btn btn-sm btn-primary btn-outline">M</button>
                        <button @click="usr.detail.is_female=1" :class="{'btn-active':usr.detail.is_female}" class="btn btn-sm btn-primary btn-outline">F</button>
                    </div>
                </div>
                <div class="space-y-3">
                    <label class="block label-text-alt" for="">Date of Birth</label>
                    <x-flatpickr model="usr.detail.dob" />
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
            <x-single-file-upload disk="" model="usr.photo" />
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Marry Status</label>
                <div class="flex gap-3">
                    <button @click="usr.detail.is_married=0" :class="{'btn-active':!usr.detail.is_married}" class="btn btn-sm btn-primary btn-outline">Single</button>
                    <button @click="usr.detail.is_married=1" :class="{'btn-active':usr.detail.is_married}" class="btn btn-sm btn-primary btn-outline">Married</button>
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
                            <select x-model="usr.detail.lvl" class="select select-bordered">
                                <option value="">-</option>
                                <template x-for="i in levels" :key="i">
                                    <option :value="i" x-text="i" :key="i==usr.detail.lvl"></option>
                                </template>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-7">
        <template x-for="address in usr.addresses">
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
                <template x-for="elem in usr.relatives">
                    <div>
                        <div class="space-y-3">
                            <label class="block label-text-alt" for="">Is Current?</label>
                            <input x-model="elem.is_current" type="checkbox" :checked="usr.relatives?.some(r => r.is_current === elem.is_current)" class="checkbox checkbox-primary">
                            <label class="block label-text-alt" for=""><p x-text="elem.who_they.text"></p></label>
                            <input x-model="elem.name" type="text" class="w-full input input-bordered">
                        </div>
                        <div class="space-y-3">
                            <label class="block label-text-alt" for="">Job/Career</label>
                            <input x-model="elem.career" type="text" class="w-full input input-bordered">
                        </div>
                        <label class="block label-text-alt" for="">Phone Numbers</label>
                        <div class="space-y-3">
                            <template x-for="phone in elem.phonenumbers">
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
