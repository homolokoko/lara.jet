<div>
    <div x-data="{
        bulletMark:{
            year:0,
            time_of_leave:0,
            time_of_absence:0,
            month_label:'',
            shift_label:'',
            type_label:'',
            course:{
                name:'',
            },
            student: {
                name_en:'',
                name_kh:''
            }
        },
        async chosenMark(id){
            await this.$wire.chosenMark(id)
                .then(response=>this.bulletMark=response)
        }
    }" @display-bullet-mark-detail.window="chosenMark(event.detail)">
        <table class="table">
            <tr>
                <td><p class="uppercase text-xs">Shift</p></td>
                <td><p class="uppercase font-semibold text-xs" x-text="bulletMark.shift_label"></p></td>
                <td><p class="uppercase text-xs">Leave</p></td>
                <td><p class="uppercase font-semibold text-xs" x-text="bulletMark.time_of_leave"></p></td>
                <td><p class="uppercase text-xs">Type</p></td>
                <td><p class="uppercase font-semibold text-xs" x-text="bulletMark.type_label"></p></td>
            </tr>
            <tr>
                <td><p class="uppercase text-xs">Month</p></td>
                <td><p class="uppercase font-semibold text-xs" x-text="bulletMark.month_label"></p></td>
                <td><p class="uppercase text-xs">Absence</p></td>
                <td><p class="uppercase font-semibold text-xs" x-text="bulletMark.time_of_absence"></p></td>
                <td><p class="uppercase text-xs">Year</p></td>
                <td><p class="uppercase font-semibold text-xs" x-text="bulletMark.year"></p></td>
            </tr>
            <tr>
                <td><p class="uppercase text-xs">Name</p></td>
                <td><p class="uppercase font-semibold text-xs" x-text="`${bulletMark.student.name_kh} ${bulletMark.student.name_en}`"></p></td>
                <td><p class="uppercase text-xs">Id</p></td>
                <td><p class="uppercase font-semibold text-xs" x-text="bulletMark.student.identity"></p></td>
                <td><p class="uppercase text-xs">Cause</p></td>
                <td><p class="uppercase font-semibold text-xs" x-text="bulletMark.course.name"></p></td>
            </tr>
            <tr class="active">
                <td colspan="2"><p class="uppercase font-semibold text-xs">Subject</p></td>
                <td colspan="2"><p class="uppercase font-semibold text-xs text-center">Full Mark</p></td>
                <td colspan="2"><p class="uppercase font-semibold text-xs text-center">Actual Mark</p></td>
            </tr>
            <template x-for="(elem, index) in bulletMark.subjects" :key="elem.id">
                <tr>
                    <td colspan="2"><p class="text-xs" x-text="elem.subject">Subject</p></td>
                    <td colspan="2"><p class="font-semibold text-xs text-center text-error" x-text="elem.full_marks">Full Mark</p></td>
                    <td colspan="2"><p class="font-semibold text-xs text-center text-success" x-text="elem.actual_marks">Actual Mark</p></td>
                </tr>
            </template>
        </table>
    </div>
</div>
