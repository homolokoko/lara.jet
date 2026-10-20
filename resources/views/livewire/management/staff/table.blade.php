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
}" x-init="retrive()" @reload-data-table.window="retrive()" class="w-full overflow-auto">

    <table class="table w-full table-compact">
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Gender</td>
                <td>Married Status</td>
                <td>Date of Birth</td>
                <td>Education Attainment</td>
                <td>Position&Level</td>
                <td>Level</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            <template x-for="(elem, index) in datatable.data" :key="elem.id">
                <tr>
                    <td x-text="elem.email">ID</td>
                    <td x-text="`${elem.name} ${elem.locale}`">Name</td>
                    <td x-text="elem.detail.is_female ? 'F':'M'">Is Female</td>
                    <td x-text="elem.detail.is_married ? 'Married':'Single'">Is Married</td>
                    <td x-text="elem.detail.dob">DOB</td>
                    <td x-text="elem.detail.edu_lvl">Education Level</td>
                    <td><p class="capitalize" x-text="_.first(elem.roles).name">position</p></td>
                    <td><p x-text="elem.detail.lvl">Level</p></td>
                    <td>
                        <button @click="viewRecord(elem.id)" class="btn btn-xs btn-ghost border border-black">👀</button>
                        <button @click="$dispatch('edit-usr-info',elem.id)" class="btn btn-xs btn-ghost border border-black">✏️</button>
                        <button @click="remove(elem.id)" class="btn btn-xs btn-ghost border border-black">🗑</button>
                    </td>
                </tr>
            </template>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="9">
                    <div class="flex justify-between">
                        <div class="btn-group"></div>
                        <div class="btn-group">
                            <button :disabled="datatable.current_page===1" @click="goPage(1)"
                                class="btn btn-xs btn-secondary">First Page</button>
                            <template x-for="(link, indx) in datatable.links">
                                <button @click="goPage(link.page)" :disabled="link.active"
                                    class="btn btn-xs btn-secondary" x-html="link.label"></button>
                            </template>
                            <button :disabled="datatable.current_page===datatable.last_page"
                                @click="goPage(datatable.last_page)" class="btn btn-xs btn-secondary">Last Page</button>
                        </div>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>

</div>
