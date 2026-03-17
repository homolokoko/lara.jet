<div class=" py-7 px-6">

    <div x-data="" class="w-full justify-center px-12 py-7 grid grid-cols-2 gap-7">

        <div class="border-2 rounded-lg w-full flex justify-center items-center">
            <div>
                <x-multiple-files-upload disk="" model="images" />
            </div>
        </div>
        <div class="space-y-5 flex flex-col">
            <label class="label-text-alt">Roll No.</label>
            <input type="text" class="input input-bordered w-full">
            <label class="label-text-alt">Name</label>
            <div class="flex gap-5">
                <input type="text" class="input input-bordered w-full">
                <input type="text" class="input input-bordered w-full">
            </div>
            <label class="label-text-alt">Date Of Birth</label>
            <x-flatpickr></x-flatpickr>
            <label class="label-text-alt">Mobile</label>
            <input type="number" class="input input-bordered w-full">
            <label class="label-text-alt">Address</label>
            <textarea class="textarea textarea-bordered w-full"></textarea>

        </div>

    </div>

</div>
