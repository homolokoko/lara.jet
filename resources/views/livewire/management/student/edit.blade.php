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
                                <label for="" class="label-text-alt uppercase block">Id</label>
                                <input x-model="editInfo.email" readonly class="input input-bordered w-full" />
                            </div>
                        </li>
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">Official</label>
                                <input type="text" x-model="editInfo.locale" class="input input-bordered w-full">
                            </div>
                        </li>
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">Name</label>
                                <input type="text" x-model="editInfo.name" class="input input-bordered w-full">
                            </div>
                        </li>
                        <li>
                            <div class="space-y-2">
                                <label class="label-text-alt uppercase block">Date Of Birth</label>
                                <x-flatpickr model="editInfo.detail.dob" />
                            </div>
                        </li>
                    </ul>
                </td>
                <td>
                    <ul class="space-y-4">
                        <li>
                            <div class="space-y-5">
                                <label for="" class="label-text-alt">Female?</label>
                                <div><input type="checkbox" x-model="result.detail.is_female" :checked="editInfo.detail.is_female" class="checkbox checkbox-accent"></div>
                            </div>
                        </li>
                        <li class="space-y-2">
                            <label for="" class="label-text-alt uppercase block">Shift</label>
                            <select x-model="editInfo.detail.shift" class="select select-bordered w-full">
                                <option value="">-</option>
                                <template x-for="item in data.shifts" :key="item.value">
                                    <option :value="item.value" x-text="item.text"></option>
                                </template>
                            </select>
                        </li>
                        <li>
                            <div class="space-y-2">
                                <label for="" class="label-text-alt uppercase block">Class Room</label>
                                <select x-model="editInfo.detail.room" class="w-full select select-bordered">
                                    <option value="">-</option>
                                    <template x-for="i in 10" :key="i">
                                        <option :value="i" x-text="i"></option>
                                    </template>
                                </select>
                            </div>
                        </li>
                        <li class="space-y-2">
                            <label for="" class="label-text-alt uppercase block">Person in Charge</label>
                            <div>
                                <select x-model="editInfo.parent_id" class="w-full select select-bordered">
                                    <option selected>Please Select Mentor</option>
                                    <template x-for="(elem, index) in data.staffs" :key="elem.value">
                                        <option :value="elem.value" x-text="elem.text"
                                            :selected="elem.value==editInfo.parent_id"></option>
                                    </template>
                                </select>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
            {{-- <tr>
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
            </tr> --}}
        </tbody>
    </table>

    <div class="grid grid-cols-2 gap-5 p-4">
        <template x-for="address in editInfo.addresses">
            <div class="space-y-5">
                <h3 class="text-xs font-semibold uppercase" x-text="address.is_current ? 'Current Place':'Birth Place'"></h3>
                <div class="space-y-3">
                    <label for="" class="label-text-alt">Street</label>
                    <input type="text" x-model="address.street.name" class="input input-bordered w-full">
                </div>
                <div class="space-y-3">
                    <label for="" class="label-text-alt">City</label>
                    <input type="text" x-model="address.street.name" class="input input-bordered w-full">
                </div>
                <div class="space-y-3">
                    <label for="" class="label-text-alt">State</label>
                    <input type="text" x-model="address.street.name" class="input input-bordered w-full">
                </div>
                <div class="space-y-3">
                    <label for="" class="label-text-alt">Zip</label>
                    <select class="select select-bordered w-full">
                        <option value="">-</option>
                        <template x-for="item in data.zips" :key="item.value">
                            <option :value="item.value" x-text="item.text">-</option>
                        </template>
                    </select>
                </div>
            </div>
        </template>
    </div>

    <div class="grid grid-cols-2 gap-5 p-4">
        <template x-for="relative in editInfo.relatives">
            <div class="space-y-5">
                <h3 class="text-xs font-semibold uppercase" x-text="relative.who_they.text"></h3>
                <div class="space-y-3">
                    <label for="" class="label-text-alt">Name</label>
                    <input type="text" x-model="relative.name" class="input input-bordered w-full">
                </div>
                <div class="space-y-3">
                    <label for="" class="label-text-alt">Career</label>
                    <input type="text" x-model="relative.career" class="input input-bordered w-full">
                </div>
                <h3 class="text-xs font-semibold uppercase">Phone Numbers</h3>
                <template x-for="phone in relative.phonenumbers">
                    <input type="text" x-model="phone.number" class="input input-bordered w-full">
                </template>
            </div>
        </template>
    </div>

    <div class="flex justify-center items-center p-5 gap-7">
        <button @click="closeEditView()" class="btn btn-ghost">Close</button>
        <button @click="updateRecord()" class="btn btn-info">Update</button>
    </div>
</div>
