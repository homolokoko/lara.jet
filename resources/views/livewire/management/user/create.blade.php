<div class="space-y-4 bg-base-300 border rounded-xl w-full max-w-4xl overflow-hidden divide-y">
    <p class="text-lg font-semibold uppercase p-5">Create</p>
    <div class="p-5 form-control">
        <div class="space-y-2 form-control">
            <label for="" class="label-text-alt">ID</label>
            <input x-model="data.email" type="text" class="input input-sm input-bordered w-full" />
        </div>
        <div class="space-y-2 form-control">
            <label for="" class="label-text-alt">Name</label>
            <input x-model="data.name" type="text" class="input input-sm input-bordered w-full" />
        </div>
        <div class="space-y-2 form-control">
            <label for="" class="label-text-alt">Official Name</label>
            <input x-model="data.locale" type="text" class="input input-sm input-bordered w-full" />
        </div>
        <div class="space-y-2 form-control">
            <label for="" class="label-text-alt">Responsible for by</label>
            <select x-model="data.responsible" class="select select-bordered select-md w-full">
                <option value="">-</option>
                <template x-for="item in responsibles" :key="item.value">
                    <option :value="item.value" x-text="item.text">-</option>
                </template>
            </select>
        </div>
    </div>
    <div class="flex justify-center gap-5 p-5">
        <button @click="tab=1" class="btn btn-ghost">Cancel</button>
        <button @click="createData()" class="btn btn-primary">Submit</button>
    </div>

</div>
