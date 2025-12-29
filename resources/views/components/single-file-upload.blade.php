@props(['disk','model'])
<div x-data="{
        param:{},
        filesUpload(event){
            let files = event.target.files;
            const formData = new FormData();
            formData.append('image',files[0]);
            try{
                console.log('files',files);
                axios.post(
                    '{{route('shared.uploader.single-files-upload')}}',
                    formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then((response)=>{this.param = response.data});
            }
            catch(err){ console.log('message',err); }

        }
    }" class="">
    <div x-show="param.file_path" class="relative">
        <label for="single-file" class="absolute top-4 right-4 btn btn-sm">Change</label>
        <img :src="param.url" alt="">
    </div>
    <input type="hidden" x-model="{{$model}}" x-modelable="param">
    <div class="relative w-full px-12 py-12 text-center bg-opacity-50 border-2 border-black border-dashed hover:bg-gray-200" x-show="!param.file_path">
        <label for="single-file" class=" btn btn-primary">Browse</label>
        <input type="file" id="single-file" @change="filesUpload" accept="image/*" class="absolute top-0 bottom-0 left-0 right-0 w-full h-full opacity-0 cursor-pointer">
    </div>
</div>
