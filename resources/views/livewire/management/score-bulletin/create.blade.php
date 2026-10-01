<div wire:ignore>
    <div x-data="{
        formData:{
            student:null,
            course:null,
            shift:null,
            presented:null,
            missed:null,
            subjects:[]
        },
        sourceData:{},
        addItem(){
            this.formData.subjects.push({
                subject:'',
                full_marks:'',
                actual_marks:''
            });
        },
        deleteItem(index){
            _.pullAt(this.formData.subjects,index);
        },
        async retrieveData(){
            this.$wire.retrieveData()
                .then(response=>this.sourceData=response);
        },
        async saveItems(){
            this.$wire.saveItems(this.formData)
                .then(()=>{console.log('Done!')})
        }
    }" x-init="retrieveData">
        <table class="table table-compact table-zebra w-full">
            <tr>
                <td><span class="uppercase font-semibold label-text-alt">Name</span></td>
                <td><span class="uppercase font-semibold label-text-alt">Course</span></td>
                <td><span class="uppercase font-semibold label-text-alt">Shift</span></td>
                <td><span class="uppercase font-semibold label-text-alt">Presented</span></td>
            </tr>
            <tr>
                <td>
                    <select x-model="formData.student" class="select select-xs select-bordered w-full">
                        <option>-</option>
                        <template x-for="item in sourceData.students" :key="item.value">
                            <option :value="item.value" x-text="item.text"></option>
                        </template>
                    </select>
                </td>
                <td>
                    <select x-model="formData.course" class="select select-xs select-bordered w-full">
                        <option>-</option>
                        <template x-for="item in sourceData.courses" :key="item.value">
                            <option :value="item.value" x-text="item.text"></option>
                        </template>
                    </select>
                </td>
                <td>
                    <select x-model="formData.shift" class="select select-xs select-bordered w-full">
                        <option>-</option>
                        <template x-for="item in sourceData.shifts" :key="item.value">
                            <option :value="item.value" x-text="item.text"></option>
                        </template>
                    </select>
                </td>
                <td></td>
            </tr>
            <tr>
                <td><span class="uppercase font-semibold label-text-alt">Type</span></td>
                <td><span class="uppercase font-semibold label-text-alt">Month</span></td>
                <td><span class="uppercase font-semibold label-text-alt">Year</span></td>
                <td><span class="uppercase font-semibold label-text-alt">Missed</span></td>
            </tr>
            <tr>
                <td>
                    <select x-model="formData.type" class="select select-xs select-bordered w-full">
                        <template x-for="(item, index) in sourceData.types" :key="index">
                            <option :value="index" x-text="item"></option>
                        </template>
                    </select>
                </td>
                <td>
                    <select x-model="formData.month" class="select select-xs select-bordered w-full">
                        <option>-</option>
                        <template x-for="item in sourceData.months" :key="item.value">
                            <option :value="item.value" x-text="item.text"></option>
                        </template>
                    </select>
                </td>
                <td>
                    <select x-model="formData.year" class="select select-xs select-bordered w-full">
                        <option>-</option>
                        <template x-for="i in sourceData.years" :key="i">
                            <option :value="i" x-text="i"></option>
                        </template>
                    </select>
                </td>
                <td></td>
            </tr>
            <tr>
                <td class="border"><span class="uppercase font-semibold label-text-alt">Subject</span></td>
                <td class="border"><span class="uppercase font-semibold label-text-alt">Full Marks</span></td>
                <td class="border"><span class="uppercase font-semibold label-text-alt">Actual Marks</span></td>
                <td class="border">
                    <button @click="addItem" class="btn btn-xs btn-outline btn-primary">Add</button>
                </td>
            </tr>
            <template x-for="(elem, index) in formData.subjects" :key="index">
                <tr>
                    <td class="border"><input x-model="elem.subject" type="text" class="input input-xs input-bordered w-full" /></td>
                    <td class="border"><input x-model="elem.full_marks" type="text" class="input input-xs input-bordered w-full" /></td>
                    <td class="border"><input x-model="elem.actual_marks" type="text" class="input input-xs input-bordered w-full" /></td>
                    <td class="border">
                        <button @click="deleteItem(index)" class="btn btn-xs btn-outline btn-error">Delete</button>
                    </td>
                </tr>
            </template>
            <tr>
                <td colspan="4" class="border">
                    <div class="flex justify-center items-center p-5">
                        <button @click="saveItems" class="btn btn-sm btn-success">Save</button>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
