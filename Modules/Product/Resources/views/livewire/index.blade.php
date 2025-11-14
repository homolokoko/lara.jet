<div wire:ignore>

    <div x-data="{
        page:1,
        per_page:10,
        filter:{},
        is_create:false,
        is_modify:false,
        datatable:{},
        edit_data:{},
        store_data:{},
        images:[],
        removeImage(index){
            _.pullAt(this.edit_data.images,index);
        },
        pushImage(images){
            _.each(images,(image)=>{this.edit_data.images.push(image)});
        },
        toPage(url){
            const urlObj = new URL(url);
            this.page = urlObj.searchParams.get('page');
            this.retrieve()
        },
        async retrieve(){
            await this.$wire.load(this.page,this.per_page,this.filter)
                .then((response)=>{ this.datatable=response; })
        },
        async edit(id){
            await this.$wire.edit(id)
                .then((response)=>{
                    this.is_modify = true;
                    this.edit_data = response;
                });
        },
        async update(id){

            await this.$wire.update(id,this.edit_data)
                .then((response)=>{ console.log('update',response); })
        },
    }" x-init="retrieve" class="relative">

        <table class="table table-compact w-full">
            <thead>
            <tr>
                <td>Image</td>
                <td>Name</td>
                <td>Price</td>
                <td>%off</td>
                <td>In Stock</td>
                <td>Out Stock</td>
                <td>Available</td>
                <td>Release Date</td>
                <td><button class="btn btn-xs btn-info">create</button></td>
            </tr>
            </thead>
            <tbody>
            <template x-for="(elem,index) in datatable.data" :key="elem.id">
                <tr>
                    <td><img class="w-8 h-8" :src="elem.image_output" /></td>
                    <td><span x-text="elem.name"></span></td>
                    <td><span class="badge badge-info" x-text="elem.price"></span></td>
                    <td><span class="badge badge-error" x-text="elem.discount"></span></td>
                    <td><span class="badge badge-success" x-text="elem.in_stock"></span></td>
                    <td><span class="badge badge-error" x-text="elem.out_stock"></span></td>
                    <td><span class="badge outline-none" :class="{
                        'bg-green-500':elem.is_available,
                        'bg-red-500':!elem.is_available
                    }" x-text="elem.is_available ? 'available':'in coming soon'"></span></td>
                    <td><span x-text="elem.release_date"></span></td>
                    <td><button @click="edit(elem.id)" class="btn btn-xs btn-warning">modify</button></td>
                </tr>
            </template>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="9">
                    <div class="flex justify-end">
                        <div class="btn-group">
                            <button @click="toPage(datatable.first_page_url)" class="btn btn-xs">first page</button>
                            <template x-for="link in datatable.links">
                                <button @click="toPage(link.url)" :disabled="link.active" class="btn btn-xs" x-html="link.label"></button>
                            </template>
                            <button @click="toPage(datatable.last_page_url)" class="btn btn-xs">last page</button>
                        </div>
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>

        <div x-show="is_modify" class="fixed z-10 top-0 left-0 w-screen h-screen">
            <div class="w-full h-full flex justify-center items-center bg-gray-500 bg-opacity-50">
                <div class="max-w-3xl min-w-max bg-white w-full divide-y">
                    <div class="alert text-lg font-semibold"><span x-text="`Edit ${edit_data.name}`"></span></div>

                    <div x-data
                        x-init="$watch('images',(v)=>{pushImage(v)})" class="flex">
                        <div class="p-5">
                            <div class="border rounded-lg space-y-2 p-4">
                                <div class="grid grid-cols-3 gap-2">
                                    <template x-for="(img, index) in edit_data.images">
                                        <div class="card shadow-2xl lg:card-side bg-secondary text-secondary-content">
                                            <button @click="removeImage(index)" class="card-actions"><x-heroicon-o-x-circle class="w-7 h-7" /></button>
                                            <div class="card-body"><img :src="img.url" alt="" class="w-32 card shadow-lg"></div>
                                        </div>
                                    </template>
                                </div><x-multiple-files-upload disk="" model="images" />
                            </div>
                        </div>
                        <div class="py-4 px-7 grid grid-cols-2 gap-3">
                        <div class="col-span-2">
                            <label class="block" for="">Name</label>
                            <input type="text" x-model="edit_data.name" class="input input-bordered">
                        </div>
                        <div class="">
                            <label class="block" for="">Price</label>
                            <input type="text" x-model="edit_data.price" class="input input-bordered">
                        </div>
                        <div class="">
                            <label class="block" for="">%Off</label>
                            <input type="text" x-model="edit_data.discount" class="input input-bordered">
                        </div>
                        <div class="">
                            <label class="block" for="">In stock</label>
                            <input type="text" x-model="edit_data.in_stock" class="input input-bordered">
                        </div>
                        <div class="">
                            <label class="block" for="">Out stock</label>
                            <input type="text" x-model="edit_data.out_stock" class="input input-bordered" readonly>
                        </div>
                        <div class="">
                            <label class="block" for="">Release Date</label>
                            <x-flatpickr><input type="hidden" x-model="param" x-modelable="edit_data.release_date"></x-flatpickr>
                        </div>
                        <div class="">
                            <label class="block" for="">Available</label>
                            <input type="checkbox" x-model="edit_data.is_available" class="toggle">
                        </div>
                    </div>
                    </div>
                    <div class="alert">
                        <p></p>
                        <div class="flex gap-5 justify-end">
                            <button @click="update(edit_data.id)" class="btn btn-info">Submit</button>
                            <button @click="is_modify=false" class="btn btn-outline">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
