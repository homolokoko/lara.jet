<div>
    <h3>Page for modify create delete country catalog .</h3>

    <div x-data="{
        name:'',
        page:1,
        per_page:15,
        filter:{},
        datatable:{},
        toPage(url){
            const urlObj = new URL(url);
            this.page = urlObj.searchParams.get('page');
            this.retrieve();
        },
        async add(type,id){
            await this.$wire.add(type,id,this.name)
                .then(()=>{
                   swal.fire({
                    icon:'info',
                    title:'Created Successful',
                    timer:1500,
                    showConfirmButton:false
                   }).then(()=>{
                        this.name='';
                        this.retrieve();
                   })
                });
        },
        async remove(type,id){
            await this.$wire.remove(type,id)
                .then(()=>{
                   swal.fire({
                    icon:'error',
                    title:'Deleted Successful',
                    timer:1500,
                    showConfirmButton:false
                   }).then(()=>{ this.retrieve() })
                });
        },
        async modify(type,id,name){
            await this.$wire.modify(type,id,name)
                .then(()=>{
                   swal.fire({
                    icon:'success',
                    title:'Updated Successful',
                    timer:1500,
                    showConfirmButton:false
                   }).then(()=>{ this.retrieve() })
                });
        },
        async retrieve(){
            await this.$wire.retrieve(
                this.page,
                this.per_page,
                this.filter
            ).then((response)=>{
                this.datatable = response;
                console.log('response',response);
            });
        }
    }" x-init="retrieve" class="mt-5">

        <div class="w-full shadow stats">
            <div class="stat place-items-center place-content-center">
                <div class="stat-title">Total</div>
                <div class="stat-value"><span x-text="datatable.total"></span></div>
                <div class="stat-desc">Jan 1st - Feb 1st</div>
            </div>
            <div class="stat place-items-center place-content-center">
                <div class="stat-title">From</div>
                <div class="stat-value text-error"><span x-text="datatable.from"></span></div>
                <div class="stat-desc text-error">↘︎</div>
            </div>
            <div class="stat place-items-center place-content-center">
                <div class="stat-title">To</div>
                <div class="stat-value text-success"><span x-text="datatable.to"></span></div>
                <div class="stat-desc text-success">↗︎</div>
            </div>
        </div>

        <ul class="divide-y bg-white">
            <template x-for="country in datatable.data" :key="country.id">
                <li x-data="{isShow:false}">
                    <div class="input-group">
                        <button @click="isShow=!isShow" class="btn btn-xs"><x-heroicon-o-plus-sm class="w-5 h-5" x-bind:class="{'rotate-45':isShow}" /></button>
                        <input type="text" class="input input-xs input-bordered" x-model="country.name">
                        <button @click="modify('country',country.id,country.name)" class="btn btn-xs btn-warning"><x-heroicon-o-paper-airplane class="w-5 h-5" /></button>
                        <button @click="remove('country',country.id)" class="btn btn-xs btn-error"><x-heroicon-o-backspace class="w-5 h-5" /></button>
                        <input type="text" class="input input-xs input-bordered" placeholder="add zip/proving" x-model="name">
                        <button @click="add('country',country.id)" class="btn btn-xs btn-info"><x-heroicon-o-bookmark  class="w-5 h-5" /></button>
                    </div>
                    <ul x-show="isShow" class="ml-5 divide-y bg-blue-100">
                        <template x-for="zip in country.zips" :key="zip.id">
                            <li x-data="{isShow:false}">
                                <div class="input-group">
                                    <button @click="isShow=!isShow" class="btn btn-xs"><x-heroicon-o-plus-sm class="w-5 h-5" x-bind:class="{'rotate-45':isShow}" /></button>
                                    <input type="text" class="input input-xs input-bordered" x-model="zip.name">
                                    <button @click="modify('zip',zip.id,zip.name)" class="btn btn-xs btn-warning"><x-heroicon-o-paper-airplane class="w-5 h-5" /></button>
                                    <button @click="remove('zip',zip.id)" class="btn btn-xs btn-error"><x-heroicon-o-backspace class="w-5 h-5" /></button>
                                    <input type="text" class="input input-xs input-bordered" placeholder="add state/district" x-model="name">
                                    <button @click="add('zip',zip.id)" class="btn btn-xs btn-info"><x-heroicon-o-bookmark  class="w-5 h-5" /></button>
                                </div>
                                <ul x-show="isShow" class="ml-5 divide-y bg-blue-300">
                                    <template x-for="state in zip.states" :key="state.id">
                                        <li x-data="{isShow:false}">
                                            <div class="input-group">
                                                <button @click="isShow=!isShow" class="btn btn-xs"><x-heroicon-o-plus-sm class="w-5 h-5" x-bind:class="{'rotate-45':isShow}" /></button>
                                                <input type="text" class="input input-xs input-bordered" x-model="state.name">
                                                <button @click="modify('state',state.id,state.name)" class="btn btn-xs btn-warning"><x-heroicon-o-paper-airplane class="w-5 h-5" /></button>
                                                <button @click="remove('state',state.id)" class="btn btn-xs btn-error"><x-heroicon-o-backspace class="w-5 h-5" /></button>
                                                <input type="text" class="input input-xs input-bordered" placeholder="add city/commune" x-model="name">
                                                <button @click="add('state',state.id)" class="btn btn-xs btn-info"><x-heroicon-o-bookmark  class="w-5 h-5" /></button>
                                            </div>
                                            <ul x-show="isShow" class="ml-5 divide-y bg-blue-500">
                                                <template x-for="city in state.cities" :key="city.id">
                                                    <li x-data="{isShow:false}">
                                                        <div class="input-group">
                                                            <button @click="isShow=!isShow" class="btn btn-xs"><x-heroicon-o-plus-sm class="w-5 h-5" x-bind:class="{'rotate-45':isShow}" /></button>
                                                            <input type="text" class="input input-xs input-bordered" x-model="city.name">
                                                            <button @click="modify('city',city.id,city.name)" class="btn btn-xs btn-warning"><x-heroicon-o-paper-airplane class="w-5 h-5" /></button>
                                                            <button @click="remove('city',city.id)" class="btn btn-xs btn-error"><x-heroicon-o-backspace class="w-5 h-5" /></button>
                                                            <input type="text" class="input input-xs input-bordered" placeholder="add street/village" x-model="name">
                                                            <button @click="add('city',city.id)" class="btn btn-xs btn-info"><x-heroicon-o-bookmark  class="w-5 h-5" /></button>
                                                        </div>
                                                        <ul x-show="isShow" class="ml-5 divide-y bg-blue-700">
                                                            <template x-for="street in city.streets" :key="street.id">
                                                                <li x-data="{isShow:false}">
                                                                    <div class="input-group">
                                                                        <button @click="isShow=!isShow" class="btn btn-xs"><x-heroicon-o-plus-sm class="w-5 h-5" x-bind:class="{'rotate-45':isShow}" /></button>
                                                                        <input type="text" class="input input-xs input-bordered" x-model="street.name">
                                                                        <button @click="modify('street',street.id,street.name)" class="btn btn-xs btn-warning"><x-heroicon-o-paper-airplane class="w-5 h-5" /></button>
                                                                        <button @click="remove('city',city.id)" class="btn btn-xs btn-error"><x-heroicon-o-backspace class="w-5 h-5" /></button>
                                                                        <input type="text" class="input input-xs input-bordered" placeholder="add person" x-model="name">
                                                                        <button @click="add('street',street.id)" class="btn btn-xs btn-info"><x-heroicon-o-bookmark  class="w-5 h-5" /></button>
                                                                    </div>
                                                                    <ul x-show="isShow" class="ml-5 divide-y bg-blue-900">
                                                                        <template x-for="person in street.people" :key="person.id">
                                                                            <li x-data="{isShow:true}">
                                                                                <div class="input-group">
                                                                                    <input type="text" class="input input-xs input-bordered"  x-model="person.name">
                                                                                    <button @click="modify('person',person.id,person.name)" class="btn btn-xs btn-warning"><x-heroicon-o-paper-airplane class="w-5 h-5" /></button>
                                                                                    <button @click="remove('person',person.id)" class="btn btn-xs btn-error"><x-heroicon-o-backspace class="w-5 h-5" /></button>
                                                                                </div>
                                                                            </li>
                                                                        </template>
                                                                    </ul>
                                                                </li>
                                                            </template>
                                                        </ul>
                                                    </li>
                                                </template>
                                            </ul>
                                        </li>
                                    </template>
                                </ul>
                            </li>
                        </template>
                    </ul>
                </li>
            </template>
        </ul>
        <ul class="btn-group">
            <li @click="toPage(datatable.first_page_url)" class="btn btn-sm btn-primary btn-outline">first page</li>
            <template x-for="link in datatable.links">
                <li @click="toPage(link.url)" :disabled="link.active" :class="{'btn-active':link.active}" class="btn btn-sm btn-primary btn-outline" x-html="link.label"></li>
            </template>
            <li @click="toPage(datatable.last_page_url)" class="btn btn-sm btn-primary btn-outline">latest page</li>
        </ul>


    </div>

</div>
