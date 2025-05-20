<div>

    <div x-data="{
            filter:{
                style:{},
                fabric_content:{}
            },
            data:{
                styles:@entangle('styles'),
                fabric_contents: @entangle('fabric_contents'),
            },
            init(){
            }
        }"
        class="flex flex-col space-y-4">

        <div>
            <label class="block label">IA Number</label>
            <x-fuse-select>
                <input x-modelable="param" x-model="filter.style" hidden>
                <input x-modelable="list" x-model="data.styles" hidden>
            </x-fuse-select>
        </div>

        <div>
            <label class="block label">Fabric Content</label>
            <x-fuse-select>
                <input x-modelable="param" x-model="filter.fabric_content" hidden>
                <input x-modelable="list" x-model="data.fabric_contents" hidden>
            </x-fuse-select>
        </div>

        <div class="">
            <button class="w-full btn btn-primary">Save</button>
        </div>

    </div>

</div>
