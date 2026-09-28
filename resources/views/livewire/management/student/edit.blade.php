<div class="border rounded gap-5 divide-y">
    <div class="flex p-5 justify-between">
        <h3 class="font-bold text-xl">EDIT PERSONAL INFORMATION</h3>
        <button @click="closeEditView()" class="btn btn-circle btn-sm btn-error">
            <x-heroicon-o-x class="w-5 h-5" />
        </button>
    </div>
    <table class="table table-normal w-full">
        <tbody>
            <tr>
                <td>
                    <ul class="space-y-4">
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">KH Name</label>
                                <input type="text" x-model="editInfo.name_kh" class="input input-bordered w-full">
                            </div>
                        </li>
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">EN Name</label>
                                <input type="text" x-model="editInfo.name_en" class="input input-bordered w-full">
                            </div>
                        </li>
                        <li class="space-y-3">
                            <label for="" class="label-text-alt uppercase block">Shift</label>
                            <div>
                                <div class="flex items-center gap-4">
                                    <input id="i" x-model="editInfo.shift" value="i"
                                        class=" radio radio-primary radio-md" type="radio" name="shift">
                                    <label for="i" class=" badge badge-outline badge-ghost">07:30-10:30</label>
                                </div>
                                <div class="flex items-center gap-4">
                                    <input id="ii" x-model="editInfo.shift" value="ii"
                                        class=" radio radio-primary radio-md" type="radio" name="shift">
                                    <label for="ii" class=" badge badge-outline badge-ghost">01:30-04:30</label>
                                </div>
                                <div class="flex items-center gap-4">
                                    <input id="iii" x-model="editInfo.shift" value="iii"
                                        class=" radio radio-primary radio-md" type="radio" name="shift">
                                    <label for="iii" class=" badge badge-outline badge-ghost">05:30-06:30</label>
                                </div>
                                <div class="flex items-center gap-4">
                                    <input id="iv" x-model="editInfo.shift" value="iv"
                                        class=" radio radio-primary radio-md" type="radio" name="shift">
                                    <label for="iv" class=" badge badge-outline badge-ghost">06:30-07:30</label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <label for="" class="label-text-alt uppercase block">Class Room</label>
                            <div>
                                <select x-model="editInfo.room" class="w-full select select-bordered">
                                    <option disabled>Room</option>
                                    <template x-for="i in 10" :key="i">
                                        <option :value="i" x-text="i" :selected="i==editInfo.room"></option>
                                    </template>
                                </select>
                            </div>
                        </li>
                        <li class="space-y-2">
                            <label for="" class="label-text-alt uppercase block">Person in Charge</label>
                            <div>
                                <select x-model="editInfo.staff" class="w-full select select-bordered">
                                    <option selected>Please Select Mentor</option>
                                    <template x-for="(elem, index) in data.staffs" :key="elem.value">
                                        <option :value="elem.value" x-text="elem.text"
                                            :selected="elem.value==editInfo.staff_id"></option>
                                    </template>
                                </select>
                            </div>
                        </li>
                    </ul>
                </td>
                <td>
                    <ul class="space-y-4">
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block"
                                    x-text="`Sex : ${editInfo.gender}`"></label>
                                <div>
                                    <div class="flex items-center gap-4">
                                        <input id="male" x-model="editInfo.gender" value="m"
                                            class=" radio radio-primary radio-md" type="radio" name="gender">
                                        <label for="male" class=" badge badge-outline badge-ghost">Male</label>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <input id="female" x-model="editInfo.gender" value="f"
                                            class=" radio radio-primary radio-md" type="radio" name="gender">
                                        <label for="female" class=" badge badge-outline badge-ghost">Female</label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block"
                                    x-text="`Date Of Birth : ${editInfo.official_dob}`"></label>
                                <x-flatpickr model="editInfo.dob" />
                            </div>
                        </li>
                        <li>
                            <label for="" class="label-text-alt uppercase block">Other</label>
                            <textarea x-model="editInfo.other" cols="30" rows="5"
                                class="textarea textarea-bordered w-full"></textarea>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>BIRTH PLACE</th>
                <th>CURRENT PLACE</th>
            </tr>
            <tr>
                <td>
                    <ul class="space-y-4">
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">Village/Street</label>
                                <input type="text" x-model="editInfo.birth_address.name"
                                    class="input input-bordered w-full">
                            </div>
                        </li>
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">Commune/City</label>
                                <input type="text" x-model="editInfo.birth_address.city.name"
                                    class="input input-bordered w-full">
                            </div>
                        </li>
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">District/State</label>
                                <input type="text" x-model="editInfo.birth_address.state.name"
                                    class="input input-bordered w-full">
                            </div>
                        </li>
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">Proving/Zip</label>
                                <select x-model="editInfo.birth_address.zip" class="w-full select select-bordered">
                                    <option selected>Please Select Proving</option>
                                    <template x-for="(elem, index) in data.zips" :key="elem.value">
                                        <option :value="elem.value" x-text="elem.text"
                                            :selected="elem.value==editInfo.birth_address.zip.id">
                                        </option>
                                    </template>
                                </select>
                            </div>
                        </li>
                    </ul>
                </td>
                <td>
                    <ul class="space-y-4" <li>
                        <div class="space-y-2">
                            <label class="label-text-alt uppercase block">Village/Street</label>
                            <input type="text" x-model="editInfo.current_address.name"
                                class="input input-bordered w-full">
                        </div>
                        </li>
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">Commune/City</label>
                                <input type="text" x-model="editInfo.current_address.city.name"
                                    class="input input-bordered w-full">
                            </div>
                        </li>
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">District/State</label>
                                <input type="text" x-model="editInfo.current_address.state.name"
                                    class="input input-bordered w-full">
                            </div>
                        </li>
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">Proving/Zip</label>
                                <select x-model="editInfo.current_address.zip" class="w-full select select-bordered">
                                    <option selected>Please Select Proving</option>
                                    <template x-for="(elem, index) in data.zips" :key="elem.value">
                                        <option :value="elem.value" x-text="elem.text"
                                            :selected="elem.value==editInfo.current_address.zip.id">
                                        </option>
                                    </template>
                                </select>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>FATHER INFORMATION</th>
                <th>MOTHER INFORMATION</th>
            </tr>
            <tr>
                <td>
                    <ul class="space-y-4">
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">Name</label>
                                <input type="text" x-model="editInfo.father_info.name"
                                    class="input input-bordered w-full">
                            </div>
                        </li>
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">Career</label>
                                <input type="text" x-model="editInfo.father_info.job"
                                    class="input input-bordered w-full">
                            </div>
                        </li>
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">Main Number</label>
                                <input type="text" x-model="editInfo.father_info.main_number"
                                    class="input input-bordered w-full">
                            </div>
                        </li>
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">Secondary Number</label>
                                <input type="text" x-model="editInfo.father_info.subs_number"
                                    class="input input-bordered w-full">
                            </div>
                        </li>
                    </ul>
                </td>
                <td>
                    <ul class="space-y-4">
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">Name</label>
                                <input type="text" x-model="editInfo.mother_info.name"
                                    class="input input-bordered w-full">
                            </div>
                        </li>
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">Career</label>
                                <input type="text" x-model="editInfo.mother_info.job"
                                    class="input input-bordered w-full">
                            </div>
                        </li>
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">Main Number</label>
                                <input type="text" x-model="editInfo.mother_info.main_number"
                                    class="input input-bordered w-full">
                            </div>
                        </li>
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">Secondary Number</label>
                                <input type="text" x-model="editInfo.mother_info.subs_number"
                                    class="input input-bordered w-full">
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="flex justify-center items-center p-5 gap-7">
        <button @click="closeEditView()" class="btn btn-ghost">Close</button>
        <button @click="updateRecord()" class="btn btn-info">Update</button>
    </div>
</div>