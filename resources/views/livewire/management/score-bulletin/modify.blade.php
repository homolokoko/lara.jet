<div>
    <div x-data="{
        bulletMark:{
            course:{},
            student:{},
            subjects:[]
        },
        deletedItems:[],
        addItem(){
            let item = {
                id:-1*_.random(1,999),
                subject:'',
                full_marks:'',
                actual_marks:''
            };
            this.bulletMark.subjects.push(item);
        },
        async chosenMark(id){
            this.$wire.chosenMark(id)
                .then(response=>this.bulletMark=response);
        },
        async submitItems(){
            await this.$wire.submitItems(
                this.deletedItems,
                this.bulletMark.id,
                this.bulletMark.subjects
            ).then(()=>{
                swal.fire({
                    icon:'success',
                    title:'Updated',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true
                }).then(()=>{});
            });
        },
    }" @display-bullet-mark-modify.window="chosenMark(event.detail)">

        <table class="table table-compact">
            <tr>
                <td class="border"><p class="uppercase text-xs">Id</p></td>
                <td class="border"><p class="uppercase font-semibold text-xs" x-text="bulletMark.student.identity"></p></td>
                <td class="border"><p class="uppercase text-xs">Cause</p></td>
                <td class="border"><p class="uppercase font-semibold text-xs" x-text="bulletMark.course.name"></p></td>
                <td class="border"><p class="uppercase text-xs">Type</p></td>
                <td class="border"><p class="uppercase font-semibold text-xs" x-text="bulletMark.type_label"></p></td>
                <td class="border"><p class="uppercase text-xs">Leave</p></td>
                <td class="border"><p class="uppercase font-semibold text-xs" x-text="bulletMark.time_of_leave"></p></td>
                <td class="border"><p class="uppercase text-xs">Absence</p></td>
                <td class="border"><p class="uppercase font-semibold text-xs" x-text="bulletMark.time_of_absence"></p></td>
                <td class="border"><p class="uppercase text-xs">Year</p></td>
                <td class="border"><p class="uppercase font-semibold text-xs" x-text="bulletMark.year"></p></td>
            </tr>
            <tr>
                <td class="border" colspan=""><p class="uppercase text-xs">Name</p></td>
                <td class="border" colspan="3"><p class="uppercase font-semibold text-xs" x-text="`${bulletMark.student.name_kh} ${bulletMark.student.name_en}`"></p></td>
                <td class="border" colspan="2"><p class="uppercase text-xs">Shift</p></td>
                <td class="border" colspan="2"><p class="uppercase font-semibold text-xs" x-text="bulletMark.shift_label"></p></td>
                <td class="border" colspan="2"><p class="uppercase text-xs">Month</p></td>
                <td class="border" colspan="2"><p class="uppercase font-semibold text-xs" x-text="bulletMark.month_label"></p></td>
            </tr>
            <tr class="active">
                <td><p class="uppercase font-semibold text-xs">Delete</p></td>
                <td colspan="6"><p class="uppercase font-semibold text-xs">Subject</p></td>
                <td colspan="2"><p class="uppercase font-semibold text-xs">Full Marks</p></td>
                <td colspan="2"><p class="uppercase font-semibold text-xs">Actual Marks</p></td>
                <td>
                    <button @click="addItem" class="btn btn-xs btn-info btn-outline btn-circle">+</button>
                    <button @click="submitItems" class="btn btn-xs btn-accent btn-outline btn-circle">💾</button>
                </td>
            </tr>
            <template x-for="(elem, index) in bulletMark.subjects" :key="elem.id">
                <tr>
                    <td class="border" :class="{'bg-error':_.includes(_.map(deletedItems,item=>_.toInteger(item)),elem.id)}"><p class="uppercase font-semibold text-xs" x-text="`#${index+1}`"></p></td>
                    <td class="border" :class="{'bg-error':_.includes(_.map(deletedItems,item=>_.toInteger(item)),elem.id)}" colspan="6"><input :disabled="!elem.isEditing" type="text" x-model="elem.subject" class="input input-xs input-bordered w-full"></td>
                    <td class="border" :class="{'bg-error':_.includes(_.map(deletedItems,item=>_.toInteger(item)),elem.id)}" colspan="2"><input :disabled="!elem.isEditing" type="text" x-model="elem.full_marks" class="input input-xs input-bordered w-full"></td>
                    <td class="border" :class="{'bg-error':_.includes(_.map(deletedItems,item=>_.toInteger(item)),elem.id)}" colspan="2"><input :disabled="!elem.isEditing" type="text" x-model="elem.actual_marks" class="input input-xs input-bordered w-full"></td>
                    <td class="border" :class="{'bg-error':_.includes(_.map(deletedItems,item=>_.toInteger(item)),elem.id)}">
                        <button @click="elem.isEditing=!elem.isEditing" class="btn btn-xs btn-success btn-outline btn-circle">🖋️</button>
                        <label :for="`item-${elem.id}`" class="btn btn-xs btn-error btn-outline btn-circle">🗑</label>
                        <input class="hidden" type="checkbox" x-model="deletedItems" :id="`item-${elem.id}`" :value="elem.id" />
                    </td>
                </tr>
            </template>
        </table>

    </div>
</div>
