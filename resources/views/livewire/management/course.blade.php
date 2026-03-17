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
            .then(async (response)=>{ this.datatable = await response; console.log('datatable',this.datatable) })
    }
}" x-init="retrive()"
@reload-data-table.window="retrive()"
@update-course-datatable.window="retrive()">

    <table class="table w-full">
        <thead>
            <tr>
                <td>ID</td>
                <td>Classroom Teacher</td>
                <td>Year Book</td>
                <td>Program Period</td>
                <td>Time Period</td>
                <td>Class Room</td>
                <td>Program Subjects</td>
                <td>
                    <x-large-modal title="Create Course">
                        <x-slot name="trigger">
                            <button class="btn btn-sm btn-primary" @click="modalOpen=true">Create</button>
                        </x-slot>
                        <x-slot name="content">
                            @include('livewire.management.course.create')
                        </x-slot>
                    </x-large-modal>
                </td>
            </tr>
        </thead>
        <tbody>
            <template x-for="(elem, index) in datatable.data" :key="elem.id">
            <tr>
                <td x-text="elem.id"></td>
                <td x-text="`${elem.detail.staff.name_en} (${elem.detail.staff.name_kh})`"></td>
                <td x-text="elem.name"></td>
                <td x-text="`${elem.detail.start_course}-${elem.detail.finish_course}`"></td>
                <td x-text="`${elem.detail.start_session}-${elem.detail.finish_session}`"></td>
                <td x-text="elem.detail.class_room"></td>
                <td>
                    <div class="flex flex-wrap gap-5 p-4">
                        <template x-for="subject in elem.subjects" :key="subject.id">
                            <span class="badge badge-sm badge-info" x-text="`${subject.title.official_name} : ${subject.max_score}`"></span>
                        </template>
                    </div>
                </td>
                <td>
                    <div class="p-4">
                        <div class="flex overflow-hidden rounded-lg">
                            <button class="rounded-none btn btn-accent btn-xs">detail</button>
                            <x-large-modal title="Create Course">
                                <x-slot name="trigger">
                                    <button @click="$dispatch('edit-course-info',elem.id)" class="rounded-none btn btn-info btn-xs">edit</button>
                                </x-slot>
                                <x-slot name="content">
                                    @include('livewire.management.course.edit')
                                </x-slot>
                            </x-large-modal>
                            <button @click="remove(elem.id)" class="rounded-none btn btn-error btn-xs">delete</button>
                        </div>
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
