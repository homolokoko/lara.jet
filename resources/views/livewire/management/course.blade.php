<div x-data="{
    page:1,
    per_page:10,
    filter:{},
    datatable:{},
    course_years:[],
    goPage(page){
        this.page=page;
        this.retrive();
    },
    create_data:{


    },
    async remove(id){
        swal.fire({
            icon:'question',
            title: 'Delete This Staff',
            text: 'Are you sure to delete this staff',
            showDenyButton:true
        }).then(async (result)=>{
            if(result.isConfirmed)
                await this.$wire.remove(id)
                    .then(()=>{
                        swal.fire({
                            icon: 'success',
                            title: 'Remove Staff Successfully',
                            text: 'Closing ....',
                            showConfirmButton: false,
                            timer: 1000,
                            timerProgressBar: true,
                        }).then(()=>{ this.retrive(); });
                    });
            else
                swal.fire({
                    icon: 'info',
                    title: 'Nothing Happen!',
                    timer: 1000,
                    timerProgressBar: true,
                    toast:true,
                    position: 'top-right',
                    showConfirmButton: false
                });
        })
    },
    async retrive(){
        let current_year = new Date().getFullYear();
        this.course_years = _.range(current_year-4,current_year+6);
        console.log('course_years',this.course_years);
        await this.$wire.datatable(this.page,this.per_page,this.filter)
            .then(async (response)=>{ this.datatable = await response; })
    }
}" x-init="retrive()" @reload-data-table.window="retrive()">

    <table class="table w-full">
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Gender</td>
                <td>Married Status</td>
                <td>Date of Birth</td>
                <td>Education Attainment</td>
                <td>Position&Level</td>
                <td>
                    <x-modal title="Create Course">
                        <x-slot name="trigger">
                            <button class="btn btn-sm btn-primary" @click="modalOpen=true">Create</button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="grid grid-cols-3 gap-5">
                                <div class="flex flex-col gap-5">
                                    <div class="space-y-3">
                                        <label class="block label-text-alt" for="">Course Year</label>
                                        <div class="flex">
                                            <select x-model="create_data.start_course" class="select select-bordered">
                                                <option selected>Please Start Year</option>
                                                <template x-for="i in course_years" :key="i">
                                                    <option value="i" x-text="i"></option>
                                                </template>
                                            </select>
                                             <select x-model="create_data.end_course" class="select select-bordered">
                                                <option selected>Please End Year</option>
                                                <template x-for="i in course_years" :key="i">
                                                    <option value="i" x-text="i"></option>
                                                </template>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="space-y-3">
                                        <label class="block label-text-alt" for="">Name (English)</label>
                                        <input x-model="usr.name_en" type="text" class="w-full input input-bordered">
                                    </div>
                                    <div class="space-y-3">
                                        <label class="block label-text-alt" for="">Education Attainment</label>
                                        <select x-model="usr.edu_lvl" class="select select-bordered">
                                            <option selected>Please Select Level</option>
                                            <option value="i">Secondary Education (Grades 7-9)</option>
                                            <option value="ii">Upper Secondary (Grades 10-12)</option>
                                            <option value="iii">Diploma</option>
                                            <option value="iv">Associate Degree</option>
                                            <option value="v">Bachelor's Degree</option>
                                            <option value="vi">Master's Degree</option>
                                            <option value="vii">Doctorate/Ph.D.</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </x-slot>
                    </x-modal>
                </td>
            </tr>
        </thead>
        <tbody>
            <template x-for="(elem, index) in datatable.data" :key="elem.id">
                <tr>
                <td x-text="elem.email"></td>
                <td x-text="elem.staff.name_en"></td>
                <td x-text="elem.staff.is_female ? 'F':'M'"></td>
                <td x-text="elem.staff.is_married ? 'Married':'Single'"></td>
                <td x-text="elem.staff.date_of_birth"></td>
                <td x-text="elem.staff.education_level"></td>
                <td>
                    <div x-show="!_.isEmpty(elem.staff.position)" class="flex items-center gap-2">
                        <span class="uppercase" x-text="elem.staff.position.name"></span>
                        <div class=" badge badge-secondary badge-xs">lvl : <span class="uppercase" x-text="elem.staff.level"></span></div>
                    </div>
                </td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-accent btn-xs">detail</button>
                        <button @click="$dispatch('edit-usr-info',elem.id)" class="btn btn-info btn-xs">edit</button>
                        <button @click="remove(elem.id)" class="btn btn-error btn-xs">delete</button>
                    </div>
                </td>
            </tr>
            </template>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8">
                    <div class="flex justify-between">
                        <div class="btn-group"></div>
                        <div class="btn-group">
                            <button :disabled="datatable.current_page===1" @click="goPage(1)" class="btn btn-xs btn-secondary">First Page</button>
                            <template x-for="(link, indx) in datatable.links">
                                <button @click="goPage(link.page)" :disabled="link.active" class="btn btn-xs btn-secondary" x-html="link.label"></button>
                            </template>
                            <button :disabled="datatable.current_page===datatable.last_page" @click="goPage(datatable.last_page)" class="btn btn-xs btn-secondary">Last Page</button>
                        </div>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>

</div>
