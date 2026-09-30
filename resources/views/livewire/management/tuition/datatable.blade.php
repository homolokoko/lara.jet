<div wire:ignor>
    <div x-data="{
        page:1,
        perpage:15,
        filter:{
            user_id:null,
            course_id:null,
            mentor_id:null,
            student_name:null,
            phonenumber:null,
        },
        datatable:{},
        async retrievedata(){
            this.datatable.data = [];
            await this.$wire.retrievedata(this.page,this.perpage,this.filter)
                .then((response) => {
                        swal.fire({
                            icon:'success',
                            title:'Pulled Data',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            position: 'top-end',
                            toast: true
                        }).then(()=>(this.datatable = response))
                    });

        }

    }" x-init="retrievedata" @refresh-tuition-info-table.window="retrievedata">

        <table class="table table-compact table-zebra">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Course</th>
                <th>Mentor</th>
                <th>Approved By</th>
                <th>Phone Number</th>
                <th>Action</th>
            </tr>
            <template x-for="(elem, index) in datatable.data" :key="elem.id">
                <tr>
                    <td class="border"><span x-text="elem.student.identity"></span></td>
                    <td class="border"><span x-text="`${elem.student.name_kh} ${elem.student.name_en}`"></span></td>
                    <td class="border"><span x-text="elem.course.name"></span></td>
                    <td class="border"><span x-text="elem.staff.name"></span></td>
                    <td class="border"><span x-text="elem.user.name"></span></td>
                    <td class="border"><span x-text="elem.phonenumber"></span></td>
                    <td class="border">
                        <button class="btn btn-xs btn-outline btn-warning">Edit</button>
                        <button class="btn btn-xs btn-outline btn-error">Delete</button>
                    </td>
                </tr>
            </template>
            <tr>
                <td colspan="7">
                    <div class="flex justify-between items-center">
                        <span x-text="`Page: ${datatable.current_page}`"></span>
                        <select x-model="perpage" class="select select-xs select-bordered">
                            <option value="0">-</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <div class="flex overflow-hidden rounded-lg border border-black">
                            <template x-for="link in datatable.links">
                                <button class="btn btn-outline btn-xs rounded-none" x-text="link.label"></button>
                            </template>
                        </div>
                        <div class="flex gap-5">
                            <span x-text="`From: ${datatable.from}`"></span>
                            <span x-text="`To: ${datatable.to}`"></span>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

    </div>
</div>
