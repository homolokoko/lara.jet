<table class="table table-compact">
    <thead>
        <tr>
            <td class="border border-black">Id</td>
            <td class="border border-black">Name</td>
            <td class="border border-black">Sex</td>
            <td class="border border-black">Level/Course</td>
            <td class="border border-black">Shift/Room</td>
            <td class="border border-black">Person In Charge</td>
            <td class="border border-black">Bus</td>
            <td class="border border-black">Paid</td>
            <td class="border border-black">Last Time</td>
            <td class="border border-black">Next Time</td>
            <td class="border border-black">Action</td>
        </tr>
    </thead>
    <tbody>
        <template x-for="(elem, index) in datatable.data" x-bind:key="elem.id">
            <tr>
                <td class="border border-black"><span x-text="elem.id"></span></td>
                <td class="border border-black">
                    <div>
                        <h3><span class="font-bold text-lg text-blue-400 block" x-text="elem.name_kh"></span>
                        </h3>
                        <h3><span class="font-bold text-md block" x-text="elem.name_en"></span></h3>
                    </div>
                </td>
                <td class="border border-black">
                    <span x-show="elem.gender === 'f'" class="badge badge-error">👧 Female</span>
                    <span x-show="elem.gender === 'm'" class="badge badge-info">🧒 Male</span>
                </td>
                <td class="border border-black">
                    <div class="text-center">
                        <h3><span class="font-bold text-lg text-blue-400 block"
                                x-text="elem.tuition_fee.course.detail.name"></span></h3>
                        <h3><span class="font-bold text-md block" x-text="elem.tuition_fee.course.detail.en_lvl"></span>
                        </h3>
                    </div>
                </td>
                <td class="border border-black">
                    <div class="text-center">
                        <h3><span class="font-bold text-lg text-blue-400 block" x-text="elem.room"></span></h3>
                        <h3><span class="font-bold text-md block" x-text="elem.shift_period"></span></h3>
                    </div>
                </td>
                <td class="border border-black"><span x-text="elem.tuition_fee.course.detail.staff.name_en"></span></td>
                <td class="border border-black">
                    <span :class="elem.tuition_fee.is_by_bus ? 'text-success':'text-error'"
                        x-text="elem.tuition_fee.is_by_bus ? '✓':'✗'"></span>
                </td>
                <td class="border border-black">
                    <span :class="elem.tuition_fee.is_paid ? 'text-success':'text-error'"
                        x-text="elem.tuition_fee.is_paid ? '✓':'✗'"></span>
                </td>
                <td class="border border-black"> <span
                        x-text="elem.tuition_fee.is_paid ? elem.tuition_fee.last_time:''"></span></td>
                <td class="border border-black"><span
                        x-text="elem.tuition_fee.is_paid ? elem.tuition_fee.next_time:''"></span></td>
                <td class="border border-black">
                    <button @click="viewRecord(elem.id)" class="btn btn-xs btn-ghost border border-black">👀</button>
                    <button @click="editRecord(elem.id)" class="btn btn-xs btn-ghost border border-black">✏️</button>
                    <button @click="deleteRecord(elem.id)" class="btn btn-xs btn-ghost border border-black">🗑</button>
                </td>
            </tr>
        </template>
    </tbody>
</table>