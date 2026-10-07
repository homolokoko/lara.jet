<x-slot name="title">
    <span class="uppercase">Certificate Scoring</span>
</x-slot>

<div wire:ignore
    x-data="{
        formData:[],
        filterData:{
            lvl:null,
            final_at:null,
            shift:1,
            month: new Date().getMonth(),
            year: new Date().getFullYear()
        },
        sourceData:{},
        async getSourceData(){
            await this.$wire.getSourceData()
                .then(response=>this.sourceData=response);
        },
        async getReletedStudent(){
            this.formData = [];
            await this.$wire.getRelatedStudent(this.filterData)
                .then(response=>this.formData=response);
        },
        async submitItem(){
            await this.$wire.submitItem(this.filterData,this.formData)
                .then(()=>{
                    swal.fire({
                        icon:'success',
                        title:'Success',
                        showConfirmButton:false,
                        timer:1500,
                        timerProgressBar: true
                    }).then(()=>{this.getReletedStudent()});
                });
        },
        async updateDetail(student_id,is_absent){
            await this.$wire.updateDetail(student_id,is_absent)
                .then(()=>{
                    swal.fire({
                        icon:'success',
                        title:'Updated',
                        timer: 1500,
                        timerProgressBar: true,
                        showConfirmButton: false
                    })
                });
        },
        async init(){
            this.getSourceData();
            this.getReletedStudent();
        }
    }" class="flex justify-center">
    <table class="table table-compact">
        <tr>
            <td class="border bg-accent"><p class="uppercase text-xs">Level</p></td>
            <td class="border bg-accent">
                <select x-model="filterData.lvl" @change="getReletedStudent()" class="select select-xs select-bordered w-full">
                    <option value="">-</option>
                    <template x-for="value in sourceData.levels" :key="value">
                        <option :value="value" x-text="value"></option>
                    </template>
                </select>
            </td>
            <td class="border bg-accent"><p class="uppercase text-xs">Final Graded</p></td>
            <td class="border bg-accent">
                <select x-model="filterData.final_at" @change="getReletedStudent()" class="select select-bordered select-xs w-full">
                    <option value="">-</option>
                    <template x-for="item in sourceData.months" :key="item.value">
                        <option :value="item.value" x-text="item.text"></option>
                    </template>
                </select>
            </td>
            <td class="border bg-accent"><p class="uppercase text-xs">Shift</p></td>
            <td class="border bg-accent">
                <select x-model="filterData.shift" @change="getReletedStudent()" x-model="filterData.shift" class="select select-bordered select-xs w-full">
                    <option value="">-</option>
                    <template x-for="item in sourceData.shifts" :key="item.value">
                        <option :value="item.value" x-text="item.text" :selected="item.value==filterData.shift"></option>
                    </template>
                </select>
            </td>
            <td class="border bg-accent"><p class="uppercase text-xs">Month</p></td>
            <td class="border bg-accent">
                <select x-model="filterData.month" class="select select-bordered select-xs w-full">
                    <option value="">-</option>
                    <template x-for="item in sourceData.months" :key="item.value">
                        <option :value="item.value" x-text="item.text" :selected="item.value==filterData.month"></option>
                    </template>
                </select>
            </td>
            <td class="border bg-accent"><p class="uppercase text-xs">Current Year</p></td>
            <td class="border bg-accent">
                <select x-model="filterData.year" class="select select-bordered select-xs w-full">
                    <option value="">-</option>
                    <template x-for="value in sourceData.years" :key="value">
                        <option :value="value" x-text="value" :selected="value==filterData.year"></option>
                    </template>
                </select>
            </td>
            <td class="border bg-accent"><p class="uppercase text-xs">Institution</p></td>
            <td class="border bg-accent">
                <input type="text" x-model="filterData.institution" class="input input-bordered input-xs w-full">
            </td>
        </tr>
        <tr>
            <td colspan="2" class="border bg-accent"><p class="uppercase text-xs">Date of Examination</p></td>
            <td colspan="4" class="border bg-accent"><x-flatpickr model="filterData.date_of_examination" /></td>
            <td colspan="2" class="border bg-accent"><p class="uppercase text-xs">Date of Signature off</p></td>
            <td colspan="4" class="border bg-accent"><x-flatpickr model="filterData.date_of_signature" /></td>
        </tr>
        <tr>
            <td><p class="uppercase font-semibold text-xs">Absent?</p></td>
            <td colspan="2"><p class="uppercase font-semibold text-xs">Id</p></td>
            <td colspan="2"><p class="uppercase font-semibold text-xs">Name</p></td>
            <td><p class="uppercase font-semibold text-xs">Gender</p></td>
            <td><p class="uppercase font-semibold text-xs">Level</p></td>
            <td><p class="uppercase font-semibold text-xs">Shift</p></td>
            <td colspan="2"><p class="uppercase font-semibold text-xs">Responsible Person</p></td>
            <td><p class="uppercase font-semibold text-xs">Final Graded</p></td>
            <td><p class="uppercase font-semibold text-xs">Status</p></td>
        </tr>
        <template x-for="(elem, index) in formData" :key="elem.id">
            <tr>
                <td><input @change="updateDetail(elem.id,elem.is_absent)" type="checkbox" x-model="elem.is_absent" :checked="elem.is_absent" class="checkbox checkbox-xs checkbox-accent"></td>
                <td colspan="2"><p class="uppercase text-xs" x-text="elem.identity">Id</p></td>
                <td colspan="2"><p class="uppercase text-xs" x-text="`${elem.name_en} ${elem.name_kh}`">Name</p></td>
                <td><p class="uppercase text-xs" x-text="elem.is_female ? 'F':'M'">Gender</p></td>
                <td><p class="uppercase text-xs" x-text="filterData.lvl">Id</p></td>
                <td><p class="uppercase text-xs" x-text="elem.shift_period">Gender</p></td>
                <td colspan="2"><p class="uppercase text-xs" x-text="elem.staff.name">Id</p></td>
                <td><p class="uppercase text-xs" x-text="_.find(sourceData.months,i=>i.value==filterData.final_at).text">Id</p></td>
                <td><p class="badge text-xs" :class="{
                        'badge-error': elem.is_empty,
                        'badge-success': !elem.is_empty,
                    }" x-text="elem.is_empty ? 'Incomeplete':'Complete'">Status</p>
                </td>
            </tr>
        </template>
        <tr>
            <td colspan="12">
                <button @click="submitItem()" class="btn btn-sm btn-accent w-full">Submit</button>
            </td>
        </tr>
    </table>
</div>
