<div class="border rounded gap-5 divide-y">
    <div class="flex p-5 justify-between">
        <h3 class="font-bold text-xl">EDIT PERSONAL INFORMATION</h3>
        <button @click="closeEditView()" class="btn btn-circle btn-sm btn-error">
            <x-heroicon-o-x class="w-5 h-5" />
        </button>
    </div>
    <div class="grid grid-cols-2 gap-5 p-4">
        <div class="space-y-5">
            <div>
                <label for="" class="label-text-alt uppercase block">Id</label>
                <input x-model="editInfo.email" readonly class="input input-bordered w-full" />
            </div>
            <div>
                <label class="label-text-alt uppercase block">KH Name</label>
                <input type="text" x-model="editInfo.locale" class="input input-bordered w-full">
            </div>
            <div>
                <label class="label-text-alt uppercase block">EN Name</label>
                <input type="text" x-model="editInfo.name" class="input input-bordered w-full">
            </div>
            <div>
                <label class="label-text-alt uppercase block">Date Of Birth</label>
                <x-flatpickr model="editInfo.detail.dob" />
            </div>
        </div>
        <div class="space-y-5">
            <div class="flex justify-between">
                <div>
                    <label for="" class="label-text-alt block">Female?</label>
                    <input type="checkbox" x-model="editInfo.detail.is_female" :checked="editInfo.detail.is_female" :value="true" class="checkbox checkbox-md checkbox-accent">
                </div>
                <div class="avatar">
                    <div class="mb-8 rounded-full w-24 h-24">
                        <img :src="editInfo.profile_photo_url">
                    </div>
                </div>
            </div>
            <div>
                <label for="" class="label-text-alt uppercase block">Shift</label>
                <select x-model="editInfo.detail.shift" class="w-full select select-bordered">
                    <option selected>-</option>
                    <template x-for="item in data.shifts" :key="item.value">
                        <option :value="item.value" x-text="item.text" :selected="item.value==editInfo.detail.shift"></option>
                    </template>
                </select>
            </div>
            <div>
                <label for="" class="label-text-alt uppercase block">Class Room</label>
                <select x-model="editInfo.detail.room" class="w-full select select-bordered">
                    <option selected>-</option>
                    <template x-for="i in 10" :key="i">
                        <option :value="i" x-text="i" :selected="i==editInfo.detail.room"></option>
                    </template>
                </select>
            </div>
            <div>
                <label for="" class="label-text-alt uppercase block">Person in Charge</label>
                <select x-model="editInfo.parent_id" class="w-full select select-bordered">
                    <option selected>-</option>
                    <template x-for="(elem, index) in data.staffs" :key="elem.value">
                        <option :value="elem.value" x-text="elem.text" :selected="elem.value==editInfo.parent_id"></option>
                    </template>
                </select>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-5 p-4">
        <template x-for="address in editInfo.addresses">
            <div class="space-y-5">
                <h3 class="font-semibold uppercase" x-text="address.is_current ? 'Current Address':'Birth Address'"></h3>
                <div>
                    <label for="" class="label-text-alt block">Village/Street</label>
                    <input type="text" x-model="address.street.name" class="input input-bordered w-full">
                </div>
                <div>
                    <label for="" class="label-text-alt block">Commune/City</label>
                    <input type="text" x-model="address.city.name" class="input input-bordered w-full">
                </div>
                <div>
                    <label for="" class="label-text-alt block">District/State</label>
                    <input type="text" x-model="address.state.name" class="input input-bordered w-full">
                </div>
                <div>
                    <label for="" class="label-text-alt block">Proving/Zip</label>
                    <select x-model="address.zip_id" class="select select-bordered w-full">
                        <option value="">-</option>
                        <template x-for="(elem, index) in data.zips" :key="elem.value">
                            <option :value="elem.value" x-text="elem.text"
                                :selected="elem.value==address.zip.id">
                            </option>
                        </template>
                    </select>
                </div>
            </div>
        </template>
    </div>
    <div class="grid grid-cols-2 gap-5 p-4">
        <template x-for="relative in editInfo.relatives">
            <div class="space-y-5">
                <h3 class="font-semibold uppercase" x-text="relative.who_they.text"></h3>
                <div class="space-y-3">
                    <label for="" class="label-text-alt block">Name</label>
                    <input type="text" x-model="relative.name" class="input input-bordered w-full">
                </div>
                <div class="space-y-3">
                    <label for="" class="label-text-alt block">Career</label>
                    <input type="text" x-model="relative.career" class="input input-bordered w-full">
                </div>
                <h3 class="text-xs uppercase font-semibold">Phone Number</h3>
                <template x-for="phonenumber in relative.phonenumbers">
                    <input type="text" x-model="phonenumber.number" class="input input-bordered w-full">
                </template>
            </div>
        </template>
    </div>
    <div class="flex justify-center items-center p-5 gap-7">
        <button @click="closeEditView()" class="btn btn-ghost">Close</button>
        <button @click="updateRecord()" class="btn btn-info">Update</button>
    </div>
</div>
