<x-app-layout>

    <div class="flex flex-row w-full">

        <div x-data="{

        }" class="grid flex-grow ">
            <div x-data="{
                src:'',
                async fileChange(e){
                    const formData = new FormData();
                    formData.append('file', e.target.files[0]);
                    await axios
                        .post('{{route('testdependency::api.upload.file')}}',
                            formData,
                            {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            }).then((response)=>{this.src=response.data});
                },
            }"
                class="relative card border border-dashed border-2 bg-gray-200 bg-opacity-25 duration-150 hover:bg-gray-100 p-5">
                <label for="" class="flex-col flex space-y-2 items-center">
                    <x-heroicon-o-cloud x-show="!src" class="w-20" />
                    <img class="w-32" :src="src" alt="">
                    <span class="btn btn-outline">drop or browse</span>
                </label>
                <input @change="fileChange" type="file" class="absolute top-0 left-0 w-full h-full opacity-0">
            </div>
        </div>
        <div class="divider divider-vertical">OR</div>
        <div class="grid flex-grow ">
            <div class="relative card border border-dashed border-2 bg-gray-200 bg-opacity-25 duration-150 hover:bg-gray-100 p-5">
                <label for="" class="flex-col flex space-y-2 items-center">
                    <x-heroicon-o-cloud class="w-20" />
                    <img class="w-32" :src="src" alt="">
                    <span class="btn btn-outline">drop or browse</span>
                </label>
                <input type="file" class="absolute top-0 left-0 w-full h-full opacity-0">
            </div>
        </div>

    </div>

</x-app-layout>
