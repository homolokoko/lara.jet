<div class="space-y-5 divide-y ">
    <div class="grid grid-cols-3 gap-5 p-5 border">
        <div class="flex flex-col gap-5">
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Course Year</label>
                <div class="flex gap-5">
                    <select x-model="createData.start_course" class="select select-bordered">
                        <option selected>Please Start Year</option>
                        <template x-for="i in course_years" :key="i">
                            <option :value="i" x-text="i"></option>
                        </template>
                    </select>
                    <select x-model="createData.finish_course" class="select select-bordered">
                        <option selected>Please End Year</option>
                        <template x-for="i in course_years" :key="i">
                            <option :value="i" x-text="i"></option>
                        </template>
                    </select>
                </div>
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Level/Grade (KH)</label>
                <select x-model="createData.kh_lvl" class="w-full select select-bordered">
                    <option selected>Level/Grade</option>
                    <template x-for="i in 10" :key="i">
                        <option :value="i" x-text="i"></option>
                    </template>
                </select>
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Level/Grade (EN)</label>
                <select x-model="createData.en_lvl" class="w-full select select-bordered">
                    <option selected>Level/Grade</option>
                    <template x-for="i in 10" :key="i">
                        <option :value="i" x-text="i"></option>
                    </template>
                </select>
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Monthly Payment</label>
                <input x-model="createData.monthly_payment" type="text" class="w-full input input-bordered">
            </div>
            <div class="flex justify-between">
                <div class="space-y-3">
                    <label class="block label-text-alt" for="">Time Period</label>
                    <div class="input-group">
                        <input x-model="createData.start_session" type="time" class="input input-bordered">
                        <input x-model="createData.finish_session" type="time" class="input input-bordered">
                    </div>
                </div>
                <div class="space-y-3">
                    <label class="block label-text-alt" for="">Room</label>
                    <select x-model="createData.class_room" class="w-full select select-bordered">
                        <option selected>Room</option>
                        <template x-for="i in 10" :key="i">
                            <option :value="i" x-text="i"></option>
                        </template>
                    </select>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-5">
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Staff</label>
                <select x-model="createData.staff_id" class="w-full select select-bordered">
                    <option selected>Select Staff</option>
                    <template x-for="staff in staffs" :key="staff.value">
                        <option :value="staff.value" x-text="staff.text"></option>
                    </template>
                </select>
            </div>
            <div class="flex justify-between gap-3">
                <div class="space-y-3">
                    <label class="block label-text-alt" for="">Enroll Date</label>
                    <x-flatpickr model="createData.enroll_date" />
                    {{--
                    <x-flatpickr model="usr.dob" /> --}}
                </div>
                <div class="space-y-3">
                    <label class="block label-text-alt" for="">Debt</label>
                    <input x-model="createData.debt" type="text" class="w-full input input-bordered" disabled>
                </div>
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">As Salary</label>
                <input x-model="createData.as_salary" type="text" class="w-full input input-bordered" disabled>
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">As Percentage</label>
                <input x-model="createData.as_percentage" type="text" class="w-full input input-bordered" disabled>
            </div>
        </div>
        <div class="flex flex-col gap-5">
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Status</label>
                <div class="flex gap-5">
                    <button @click="createData.status=true" :class="{'btn-outline':!createData.status}"
                        class="btn btn-sm btn-success">Active</button>
                    <button @click="createData.status=false" :class="{'btn-outline':createData.status}"
                        class="btn btn-sm btn-error">Inactive</button>
                </div>
            </div>
            <div class="space-y-3">
                <label class="block label-text-alt" for="">Year Book</label>
                <input x-model="createData.name" type="text" class="w-full input input-bordered">
            </div>
        </div>
    </div>
    <div class="p-5 space-y-5 border divide-y ">
        <h3 class="text-lg font-bold">
            Subjects &Score For the Test
            <button @click="addCreateSubject" class="btn btn-xs btn-success">
                <x-heroicon-o-plus class="w-5 h-5" />Add Subject
            </button>
        </h3>
        <div class="grid grid-cols-3 gap-5">
            <template x-for="(subject, index) in createSubjects" :key="index">
                <div class="flex gap-1">
                    <div class="space-y-3">
                        <label class="block label-text-alt">Subject</label>
                        <input x-model="subject.name" type="text" class="input input-xs input-bordered">
                    </div>
                    <div class="space-y-3">
                        <label class="block label-text-alt">Full Score</label>
                        <input x-model="subject.max_score" type="text" class="input input-xs input-bordered">
                    </div>
                    <div class="space-y-3">
                        <label class="block label-text-alt">Delete</label>
                        <button @click="deleteCreateSubject(index)">
                            <x-heroicon-o-trash class="w-5 h-5" />
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>
    <div class="w-full p-5 text-center align-middle border">
        <button @click="submitCreate()" class="btn btn-primary">Submit</button>
    </div>
</div>
