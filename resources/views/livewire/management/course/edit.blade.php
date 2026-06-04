<div class="space-y-5">
    <div class="grid grid-cols-3 gap-5 p-3 border">
        <div class="flex flex-col gap-5">
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Course Year</label>
                <div class="flex gap-5">
                    <select x-model="editData.start_course" class="select select-bordered">
                        <option selected>Please Start Year</option>
                        <template x-for="i in course_years" :key="i">
                            <option :value="i" x-text="i" :selected="editData.detail.start_course==i"></option>
                        </template>
                    </select>
                    <select x-model="editData.finish_course" class="select select-bordered">
                        <option selected>Please End Year</option>
                        <template x-for="i in course_years" :key="i">
                            <option :value="i" x-text="i" :selected="editData.detail.finish_course==i"></option>
                        </template>
                    </select>
                </div>
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Level/Grade (KH)</label>
                <select x-model="editData.kh_lvl" class="w-full select select-bordered">
                    <option selected>Level/Grade</option>
                    <template x-for="i in 10" :key="i">
                        <option :value="i" x-text="i" :selected="editData.detail.kh_lvl==i"></option>
                    </template>
                </select>
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Level/Grade (EN)</label>
                <select x-model="editData.en_lvl" class="w-full select select-bordered">
                    <option selected>Level/Grade</option>
                    <template x-for="i in 10" :key="i">
                        <option :value="i" x-text="i" :selected="editData.detail.en_lvl==i"></option>
                    </template>
                </select>
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Monthly Payment</label>
                <input x-model="editData.detail.monthly_payment" type="text" class="w-full input input-bordered">
            </div>
            <div class="flex justify-between">
                <div class="space-y-3">
                    <label class="block label-text-alt" for="">Time Period</label>
                    <div class="input-group">
                        <input x-model="editData.detail.start_session" type="time" class="input input-bordered">
                        <input x-model="editData.detail.finish_session" type="time" class="input input-bordered">
                    </div>
                </div>
                <div class="space-y-3">
                    <label class="block label-text-alt" for="">Room</label>
                    <select x-model="editData.class_room" class="w-full select select-bordered">
                        <option selected>Room</option>
                        <template x-for="i in 10" :key="i">
                            <option :value="i" x-text="i" :selected="editData.detail.class_room==i"></option>
                        </template>
                    </select>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-5">
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Staff</label>
                <select x-model="editData.staff_id" class="w-full select select-bordered">
                    <option selected>Select Staff</option>
                    <template x-for="staff in staffs" :key="staff.value">
                        <option :value="staff.value" x-text="staff.text"
                            :selected="editData.detail.staff.id==staff.value"></option>
                    </template>
                </select>
            </div>
            <div class="flex justify-between gap-3">
                <div class="space-y-3">
                    <label class="block label-text-alt" for="">Enroll Date <span x-text="editData.detail.enroll_date"></span></label>
                    <x-flatpickr model="editData.enroll_date" />
                    {{--
                    <x-flatpickr model="usr.dob" /> --}}
                </div>
                <div class="space-y-3">
                    <label class="block label-text-alt" for="">Debt</label>
                    <input x-model="editData.debt" type="text" class="w-full input input-bordered" disabled>
                </div>
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">As Salary</label>
                <input x-model="editData.as_salary" type="text" class="w-full input input-bordered" disabled>
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">As Percentage</label>
                <input x-model="editData.as_percentage" type="text" class="w-full input input-bordered" disabled>
            </div>
        </div>
        <div class="flex flex-col gap-5">
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Status</label>
                <div class="flex gap-5">
                    <button @click="editData.status=true" :class="{'btn-outline':!editData.detail.status}"
                        class="btn btn-sm btn-success">Active</button>
                    <button @click="editData.status=false" :class="{'btn-outline':editData.detail.status}"
                        class="btn btn-sm btn-error">Inactive</button>
                </div>
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Year Book</label>
                <input x-model="editData.name" type="text" class="w-full input input-bordered">
            </div>
        </div>
    </div>
    <div class="p-3 space-y-5 border divide-y ">
        <h3 class="block text-lg font-bold">
            Subjects &Score For the Test
            <button @click="addEditSubject" class="btn btn-xs btn-success">
                <x-heroicon-o-plus class="w-5 h-5" />Add Subject
            </button>
        </h3>
        <div class="grid grid-cols-3 gap-5">
            <template x-for="(subject, index) in editData.subjects" :key="index">
                <div class="flex gap-1">
                    <div class="space-y-3">
                        <label class="block label-text-alt">Subject</label>
                        <input x-model="subject.title.name" type="text" class="input input-xs input-bordered">
                    </div>
                    <div class="space-y-3">
                        <label class="block label-text-alt">Full Score</label>
                        <input x-model="subject.max_score" type="text" class="input input-xs input-bordered">
                    </div>
                    <div class="space-y-3">
                        <label class="block label-text-alt">Delete</label>
                        <button @click="deleteEditSubject(index)">
                            <x-heroicon-o-trash class="w-5 h-5" />
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>
    <div class="w-full p-3 text-center align-middle border gap-7">
        <button @click="tab='table'" class="border border-black btn btn-ghost">Close</button>
        <button @click="submitEdit()" class="btn btn-primary">Submit</button>
    </div>
</div>
