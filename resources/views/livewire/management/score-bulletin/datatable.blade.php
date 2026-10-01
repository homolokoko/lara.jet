<div wire:ignore>
    <div x-data="{
        page:1,
        perpage:15,
        filter:{},
        datatable:{},
        async retrievedata(){
            this.datatable.data = [];
            this.$wire.retrievedata(this.page,this.perpage,this.filter)
                .then(response=>this.datatable=response);
        },
        choosePage(page){
            this.page = page;
            this.retrievedata();
        }
    }" x-init="retrievedata">

        <table class="table table-compact w-full table-zebra">
            <tr>
                <td><span class="uppercase font-semibold">Id</span></td>
                <td><span class="uppercase font-semibold">Name</span></td>
                <td><span class="uppercase font-semibold">A/P</span></td>
                <td><span class="uppercase font-semibold">Course</span></td>
                <td><span class="uppercase font-semibold">Shift</span></td>
                <td><span class="uppercase font-semibold">Type</span></td>
                <td><span class="uppercase font-semibold">Month</span></td>
                <td><span class="uppercase font-semibold">Year</span></td>
            </tr>
            <template x-for="(elem, index) in datatable.data" :key="elem.id">
                <tr>
                    <td class="border"><span x-text="elem.student.id">Id</span></td>
                    <td class="border"><span x-text="`${elem.student.name_kh} ${elem.student.name_en}`">Name</span></td>
                    <td class="border"><span x-text="`${elem.missed} / ${elem.presented}`">A/P</span></td>
                    <td class="border"><span x-text="elem.course.name">Course</span></td>
                    <td class="border"><span x-text="elem.shift_label">Shift</span></td>
                    <td class="border"><span x-text="elem.type_label">Type</span></td>
                    <td class="border"><span x-text="elem.month_label">Month</span></td>
                    <td class="border"><span x-text="elem.year">Year</span></td>
                </tr>
            </template>
            <tr>
                <td colspan="8" class="border">
                    <div class="flex items-center">
                        <div class="btn-group">
                            <template x-for="link in datatable.links">
                                <button @click="choosePage(link.page)" :disabled="link.active" :class="{'btn-active':link.active}" class="btn btn-xs btn-outline" x-text="link.label"></button>
                            </template>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

    </div>
</div>
