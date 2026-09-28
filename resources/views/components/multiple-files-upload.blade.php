@props(['disk','model'])
<div class="w-full py-4 px-12 text-center hover:bg-gray-200 bg-opacity-50 border-2 border-black border-dashed "
    x-data="{
        param:[],
        filesUpload(event){
            let files = event.target.files;
            const formData = new FormData();
            for (let i = 0; i < files.length; i++) {
                formData.append('images[]', files[i]);
            }
            try{
                console.log('files',files);
                axios.post(
                    '{{route('shared.uploader.multiple-files-upload')}}',
                    formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then((response)=>{this.images = response.data.images});
            }
            catch(err){ console.log('message',err); }

        }
    }">
    <input type="hidden" x-model="{{$model}}" x-modelable="param">
    <label for="files" class="btn btn-primary relative">
        Browse
        <input type="file" id="files" @change="filesUpload" accept="image/*" multiple class="absolute top-0 bottom-0 left-0 right-0 opacity-0 cursor-pointer">
    </label>
</div>
