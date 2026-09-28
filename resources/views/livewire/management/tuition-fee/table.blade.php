<table class="table w-full">
    <thead>
        <tr>
            <td class="">Id</td>
            <td class="">Name</td>
            <td class="">Sex</td>
            <td class="">Level/Course</td>
            <td class="">Shift/Room</td>
            <td class="">Person In Charge</td>
            <td class="">Bus</td>
            <td class="">Paid</td>
            <td class="">Last Time</td>
            <td class="">Next Time</td>
            <td class="">Action</td>
        </tr>
    </thead>
    <tbody>
        <template x-for="(elem, index) in datatable.data" x-bind:key="elem.id">
            <tr>
                <td class=""><span x-text="elem.id"></span></td>
                <td class="">
                    <div>
                        <h3><span class="font-bold text-lg text-primary block" x-text="elem.name_kh"></span>
                        </h3>
                        <h3><span class="font-bold text-md block" x-text="elem.name_en"></span></h3>
                    </div>
                </td>
                <td class="">
                    <span x-show="elem.gender === 'f'" class="badge badge-error">👧 Female</span>
                    <span x-show="elem.gender === 'm'" class="badge badge-info">🧒 Male</span>
                </td>
                <td class="">
                    <div class="text-center">
                        <h3><span class="font-bold text-lg text-primary block"
                                x-text="elem.tuition_fee.course.detail.name"></span></h3>
                        <h3><span class="font-bold text-md block" x-text="elem.tuition_fee.course.detail.en_lvl"></span>
                        </h3>
                    </div>
                </td>
                <td class="">
                    <div class="text-center">
                        <span class="font-bold text-lg text-primary block" x-text="elem.room"></span>
                        <span class="badge badge-secondary"
                            x-text="`From : ${elem.tuition_fee.course.detail.start_session}`"></span>
                        <span class="badge badge-accent"
                            x-text="`Until : ${elem.tuition_fee.course.detail.finish_session}`"></span>
                    </div>
                </td>
                <td class=""><span x-text="elem.tuition_fee.course.detail.staff.name_en"></span></td>
                <td class="">
                    <span :class="elem.tuition_fee.is_by_bus ? 'text-success':'text-error'"
                        x-text="elem.tuition_fee.is_by_bus ? '✓':'✗'"></span>
                </td>
                <td class="">
                    <span :class="elem.tuition_fee.is_paid ? 'text-success':'text-error'"
                        x-text="elem.tuition_fee.is_paid ? '✓':'✗'"></span>
                </td>
                <td class=""> <span
                        x-text="elem.tuition_fee.is_paid ? elem.tuition_fee.last_time:''"></span></td>
                <td class=""><span
                        x-text="elem.tuition_fee.is_paid ? elem.tuition_fee.next_time:''"></span></td>
                <td class="">
                    <button @click="viewRecord(elem.id)" class="btn btn-xs btn-ghost ">👀</button>
                    <button x-show="!elem.tuition_fee" @click="addRecord(elem.id)"
                        class="btn btn-xs btn-ghost ">❓</button>
                    <button x-show="elem.tuition_fee" @click="editRecord(elem.id)"
                        class="btn btn-xs btn-ghost ">✏️</button>
                    <button @click="deleteRecord(elem.id)" class="btn btn-xs btn-ghost ">🗑</button>
                </td>
            </tr>
        </template>
        <tfoot>
            <tr>
                <td colspan="11">
                    <div class="btn-group">
                        <template x-for="link in datatable.links">
                            <button class="btn btn-sm" x-text="link.label"></button>
                        </template>
                    </div>
                </td>
            </tr>
        </tfoot>
    </tbody>
</table>
