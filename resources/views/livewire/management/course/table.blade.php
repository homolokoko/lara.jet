<div x-data="{
    page:1,
    per_page:10,
    filter:{},
    datatable:{},
    goPage(page){
        this.page=page;
        this.retrive();
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
                <td></td>
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
