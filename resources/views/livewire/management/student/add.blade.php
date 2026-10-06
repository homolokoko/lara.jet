<div>
    <div id="create" class="p-5 ">
        <table class="table w-full">
            <tr>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Kh Name</label>
                    <input type="text" x-model="result.name_kh" class="block w-full input input-bordered">
                </td>
                <td class="row-span-2 space-y-3">
                    <label for="" class="label-text-alt">En Name</label>
                    <input type="text" x-model="result.name_en" class="block w-full input input-bordered">
                </td>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Female?</label>
                    <div><input type="checkbox" x-model="result.is_female" class="checkbox checkbox-accent"></div>
                </td>
            </tr>
            <tr>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Date of Birth</label>
                    <x-flatpickr model="result.dob" />
                </td>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Indentity</label>
                    <input type="text" x-model="result.identity" class="block w-full input input-bordered">
                </td>
                <td rowspan="2" class="space-y-3">
                    <label for="" class="label-text-alt">Shift</label>
                    <div class="flex flex-col gap-2">
                        <template x-for="item in data.shifts" :key="item.value">
                            <button @click="result.shift=item.value"
                                x-text="item.text"
                                :class="{'btn-active':result.shift===item.value}"
                                class="btn btn-sm btn-ghost">
                            </button>
                        </template>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Class Room</label>
                    <div>
                        <select x-model="result.room" class="w-full select select-bordered">
                            <option selected>Room</option>
                            <template x-for="i in 10" :key="i">
                                <option :value="i" x-text="i"></option>
                            </template>
                        </select>
                    </div>
                </td>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Person in Charge</label>
                    <div>
                        <select x-model="result.staff" class="w-full select select-bordered">
                            <option selected>Please Select Mentor</option>
                            <template x-for="(elem, index) in data.staffs" :key="elem.value">
                                <option :value="elem.value" x-text="elem.text"></option>
                            </template>
                        </select>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div id="create" class="p-5 ">
        <h3>Birth Place</h3>
        <table class="table w-full">
            <tr>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Village</label>
                    <input type="text" x-model="result.birth.street" class="block w-full input input-bordered">
                </td>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Commune</label>
                    <input type="text" x-model="result.birth.city" class="block w-full input input-bordered">
                </td>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">District</label>
                    <input type="text" x-model="result.birth.state" class="block w-full input input-bordered">
                </td>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Proving</label>
                    <div>
                        <select x-model="result.birth.zip" class="w-full select select-bordered">
                            <option selected>Please Select Proving</option>
                            <template x-for="(elem, index) in data.zips" :key="elem.value">
                                <option :value="elem.value" x-text="elem.text"></option>
                            </template>
                        </select>
                    </div>
                </td>
            </tr>
        </table>
        <h3>Current Place</h3>
        <table class="table w-full">
            <tr>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Village</label>
                    <input type="text" x-model="result.cur.street" class="block w-full input input-bordered">
                </td>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Commune</label>
                    <input type="text" x-model="result.cur.city" class="block w-full input input-bordered">
                </td>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">District</label>
                    <input type="text" x-model="result.cur.state" class="block w-full input input-bordered">
                </td>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Proving</label>
                    <div>
                        <select x-model="result.cur.zip" class="w-full select select-bordered">
                            <option selected>Please Select Proving</option>
                            <template x-for="(elem, index) in data.zips" :key="elem.value">
                                <option :value="elem.value" x-text="elem.text"></option>
                            </template>
                        </select>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div id="create" class="p-5 ">
        <table class="table w-full">
            <tr>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Father's Name</label>
                    <input type="text" x-model="result.father.name" class="block w-full input input-bordered">
                </td>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Occupation</label>
                    <input type="text" x-model="result.father.job" class="block w-full input input-bordered">
                </td>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Main Phonenumber</label>
                    <input type="text" x-model="result.father.main_number" class="block w-full input input-bordered">
                </td>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Subs Phonenumber</label>
                    <input type="text" x-model="result.father.subs_number" class="block w-full input input-bordered">
                </td>
            </tr>
            <tr>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Mother's Name</label>
                    <input type="text" x-model="result.mother.name" class="block w-full input input-bordered">
                </td>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Occupation</label>
                    <input type="text" x-model="result.mother.job" class="block w-full input input-bordered">
                </td>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Main Phonenumber</label>
                    <input type="text" x-model="result.mother.main_number" class="block w-full input input-bordered">
                </td>
                <td class="space-y-3">
                    <label for="" class="label-text-alt">Subs Phonenumber</label>
                    <input type="text" x-model="result.mother.subs_number" class="block w-full input input-bordered">
                </td>
            </tr>
        </table>
    </div>
    <div class="flex justify-center p-5"><button @click="create()" class="btn"> Submit </button>
    </div>
</div>
