<div wire:ignore>
    <div x-data="{
        page:1,
        perpage:10,
        filter:{},
        datatable:{},
        source:{},
        isLoading: false,
        choosePage(page){
            this.page = page;
            this.retrievedata();
        },
        filtering(){
            this.page = 1;
            this.retrievedata();
        },
        async retrievedata(){
            this.isLoading = true;
            this.$wire.retrievedata(this.page,this.perpage,this.filter)
                .then((response)=>{
                    this.isLoading=false;
                    this.datatable=response;
                });
        },
        async getSourceFilter(){
            this.$wire.getSourceFilter()
                .then(response=>this.source=response)
        },
        async deleteItem(id){
            await swal.fire({
                icon:'question',
                title:'Delete this item!',
                text:'Are you sure, must delete this item ?',
                showDenyButton: true
            }).then(async (result)=>{
                if(result.isConfirmed){
                    await this.$wire.deleteItem(id)
                        .then(()=>{
                            swal.fire({
                                icon: 'success',
                                title: 'Deleted',
                                timer: 1500,
                                timerProgressBar: true,
                                showConfirmButton: false
                            }).then(()=>{ this.retrievedata() });
                        });
                }
            });
        },
        init(){
            this.retrievedata();
            this.getSourceFilter();
        }
    }" @display-bullet-mark-delete.window="deleteItem(event.detail)">

        <table class="table table-compact w-full table-zebra">
            <thead>
                <tr>
                    <td><span class="uppercase font-semibold">Id</span></td>
                    <td><span class="uppercase font-semibold">Name</span></td>
                    <td><span class="uppercase font-semibold">L/A</span></td>
                    <td><span class="uppercase font-semibold">Course</span></td>
                    <td><span class="uppercase font-semibold">Shift</span></td>
                    <td><span class="uppercase font-semibold">Type</span></td>
                    <td><span class="uppercase font-semibold">Month</span></td>
                    <td><span class="uppercase font-semibold">Year</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input @blur="filtering" x-model="filter.name" class="input input-xs input-bordered w-full"></td>
                    <td></td>
                    <td>
                        <select @change="filtering" x-model="filter.course" class="select select-xs select-bordered w-full">
                            <option value="">-</option>
                            <template x-for="item in source.courses" :key="item.value">
                                <option :value="item.value" x-text="item.text"></option>
                            </template>
                        </select>
                    </td>
                    <td>
                        <select @change="filtering" x-model="filter.shift" class="select select-xs select-bordered w-full">
                            <option value="">-</option>
                            <template x-for="item in source.shifts" :key="item.value">
                                <option :value="item.value" x-text="item.text"></option>
                            </template>
                        </select>
                    </td>
                    <td>
                        <select @change="filtering" x-model="filter.type" class="select select-xs select-bordered w-full">
                            <template x-for="(item, index) in source.types" :key="index">
                                <option :value="index" x-text="item"></option>
                            </template>
                        </select>
                    </td>
                    <td>
                        <select @change="filtering" x-model="filter.month" class="select select-xs select-bordered w-full">
                            <option value="">-</option>
                            <template x-for="item in source.months" :key="item.value">
                                <option :value="item.value" x-text="item.text"></option>
                            </template>
                        </select>
                    </td>
                    <td>
                        <select @change="filtering" x-model="filter.year" class="select select-xs select-bordered w-full">
                            <option value="">-</option>
                            <template x-for="item in source.years" :key="item">
                                <option :value="item" x-text="item"></option>
                            </template>
                        </select>
                    </td>
                </tr>
            </thead>
            <tbody x-show="isLoading" class=" animate-pulse">
                <template x-for="i in 15">
                    <tr>
                        <td class="p-3 border"></td>
                        <td class="p-3 border"></td>
                        <td class="p-3 border"></td>
                        <td class="p-3 border"></td>
                        <td class="p-3 border"></td>
                        <td class="p-3 border"></td>
                        <td class="p-3 border"></td>
                        <td class="p-3 border"></td>
                    </tr>
                </template>
            </tbody>
            <tbody x-show="!isLoading">
                <template x-for="(elem, index) in datatable.data" :key="elem.id">
                    <tr>
                        <th class="border">
                            <div class="flex gap-1">
                                <button @click="$dispatch('display-bullet-mark-detail',elem.id)" class="btn btn-xs btn-accent btn-outline btn-circle">👁</button>
                                <button @click="$dispatch('display-bullet-mark-modify',elem.id)" class="btn btn-xs btn-success btn-outline btn-circle">🖋️</button>
                                <button @click="$dispatch('display-bullet-mark-delete',elem.id)" class="btn btn-xs btn-error btn-outline btn-circle">🗑</button>
                            </div>
                            <span x-text="`#${elem.student.identity}`" class="label-text-alt text-center">Id</span>
                        </th>
                        <td class="border"><span x-text="`${elem.student.name_kh} ${elem.student.name_en}`">Name</span></td>
                        <td class="border"><span x-text="`${elem.time_of_leave} / ${elem.time_of_absence}`">A/P</span></td>
                        <td class="border"><span x-text="elem.course.name">Course</span></td>
                        <td class="border"><span x-text="elem.shift_label">Shift</span></td>
                        <td class="border"><span x-text="elem.type_label">Type</span></td>
                        <td class="border"><span x-text="elem.month_label">Month</span></td>
                        <td class="border"><span x-text="elem.year">Year</span></td>
                    </tr>
                </template>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" class="border">
                        <div class="flex items-center">
                            <div class="btn-group">
                                <template x-for="link in datatable.links">
                                    <button @click="choosePage(link.page)" :disabled="link.active || !link.url" :class="{'btn-active':link.active || !link.url}" class="btn btn-xs btn-outline" x-text="link.label"></button>
                                </template>
                            </div>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>

    </div>
</div>
