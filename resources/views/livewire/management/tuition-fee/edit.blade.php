<div>

    <div class="px-7 py-5 shadow-lg">
        <div class=" grid grid-cols-3 gap-5">

            <div class="space-x-4 space-y-5">
                <label for="id" class="label-text-alt block">ID</label>
                <p class="text-xl font-bold text-primary" x-text="data.no"></p>
            </div>

            <div class="space-x-4 space-y-5">
                <label for="id" class="label-text-alt block">Name</label>
                <div class="text-center">
                    <p class="text-xl font-bold text-primary" x-text="data.name_kh"></p>
                    <p class="text-xl font-semibold text-base-content" x-text="data.name_en"></p>
                </div>
            </div>

            <div class="space-x-4 space-y-5">
                <label for="id" class="label-text-alt block">Sex</label>
                <span class="flex px-4 py-1">
                    <span :class="{'opacity-0':data.gender==='m'}">✅</span>
                    <div>👩 Female</div>
                </span>
                <span class="flex px-4 py-1">
                    <span :class="{'opacity-0':data.gender==='f'}">✅</span>
                    <div>👨 Male</div>
                </span>
            </div>

            <div class="space-x-4 space-y-5">
                <label for="course" class="label-text-alt block">Level&Course</label>
                <select x-model="data.course" id="course" class="select select-bordered">
                    <option :selected="!data.tuition_fee" disabled>Select a course</option>
                    <template x-for="(item, index) in referCourses">
                        <option :value="item.value" x-text="item.text"
                            :selected="item.value==data.tuition_fee.course.id"></option>
                    </template>
                </select>
            </div>

            <div class="space-x-4 space-y-5">
                <label for="id" class="label-text-alt block">Shift&Room</label>
                <div class="text-center">
                    <p class="text-xl font-bold text-primary" x-text="data.room"></p>
                    <p class="text-lg font-semibold text-base-content" x-text="data.shift_period"></p>
                </div>
            </div>

            <div class="space-x-4 space-y-5">
                <label for="id" class="label-text-alt block">Person In Charge</label>
                <p class="text-lg font-semibold text-base-content"
                    x-text="data.tuition_fee.course.detail.staff.name_en">
                </p>
            </div>

            <div class="space-x-4 space-y-5">
                <div>
                    <label for="id" class="label-text-alt block">Is By Bus</label>
                    <div x-data class="flex gap-4">
                        <label @click="data.tuition_fee.is_by_bus=1" class="badge badge-lg" for="by_bus"
                            :class="data.tuition_fee.is_by_bus ? 'badge-success':'badge-ghost'">✓ Yes</label>
                        <label @click="data.tuition_fee.is_by_bus=0" class="badge badge-lg" for="no_bus"
                            :class="!data.tuition_fee.is_by_bus ? 'badge-error':'badge-ghost'">✗ No</label>
                    </div>
                </div>
                <div>
                    <label for="id" class="label-text-alt block">Paid ?</label>
                    <div class="flex gap-4">
                        <label @click="data.tuition_fee.is_paid=1" class="badge badge-lg" for="by_paid"
                            :class="data.tuition_fee.is_paid ? 'badge-success':'badge-ghost'">✓ Yes</label>
                        <label @click="data.tuition_fee.is_paid=0" class="badge badge-lg" for="no_paid"
                            :class="!data.tuition_fee.is_paid ? 'badge-error':'badge-ghost'">✗ No</label>
                    </div>
                </div>
            </div>

            <div class="space-x-4 space-y-5">
                <label for="id" class="label-text-alt block">Last Fee</label>
                <input x-model="data.tuition_fee.last_time" class="input input-bordered" disabled>
            </div>

            <div class="space-x-4 space-y-5">
                <label for="id" class="label-text-alt block">Next Fee</label>
                <input x-model="data.tuition_fee.next_time" class="input input-bordered" disabled>
            </div>

        </div>
        <div class="w-full p-5 text-center">
            <button @click="updateRecord" class="btn btn-primary">update</button>
        </div>
    </div>
</div>