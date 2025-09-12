<div wire:ignore>
    <div>
        <div x-data="{
            page:0,
            pages:0,
            get_date:{
                mode:'',
                value:''
            },
            summary:{
                inspected:0,
                pass_pcs:0,
                repair_pcs:0
            },
            countdown:0,
            intervalId: null,
            flatItem:[],
            transactions:{},
            currentUrl:`{{route('full-qc.defect-analysis-transcaction.report',[$mode,$report_view])}}`,
            filter:{
                size:null,
                color:null,
                style:null,
                location:null,
                inspector:null,
                garment:'',
            },
            data:{
                sizes:[],
                colors:[],
                styles:[],
                locations:[],
                inspectors:[]
            },
            get filterItems(){
                let result = this.flatItem;
                if(this.filter.size)
                    result = _.filter(result,item=>item.size.id==this.filter.size);
                if(this.filter.color)
                    result = _.filter(result,item=>item.color.id==this.filter.color);
                if(this.filter.style)
                    result = _.filter(result,item=>item.style.id==this.filter.style);
                if(this.filter.location)
                   result = _.filter(result,item=>item.location.id==this.filter.location);
                if(this.filter.inspector)
                    result = _.filter(result,item=>item.inspector.id==this.filter.inspector);
                if(this.filter.garment)
                    result = _.filter(result,item=>_.includes(
                        _.toLower(item.garment.garmentQrCode),
                        _.toLower(this.filter.garment)
                    ));
                this.pages = _.ceil(_.divide(result.length,10));
                return _.slice(result,(this.page*10),(this.page*10)+10);
            },
            reports:[],
            startCountdown() {
                let timer = this.intervalId = setInterval(() => {
                    this.countdown--;
                    if (this.countdown <= 0) {
                        this.countdown = 15;
                        this.retreiveData();
                        clearInterval(timer);
                    }

                }, 1000);
            },
            clearFilter(){
                this.filter = {
                    size:null,
                    color:null,
                    style:null,
                    location:null,
                    inspector:null,
                    garment:''
                }
            },
            retreiveData() {
                try{
                    axios.patch(this.currentUrl,{date:this.get_date})
                        .then((response)=>{
                            this.flatItem = response.data.flat_item;
                            this.transactions = response.data.items;
                            this.data.sizes = response.data.sizes;
                            this.data.colors = response.data.colors;
                            this.data.styles = response.data.styles;
                            this.data.locations = response.data.locations;
                            this.data.inspectors = response.data.inspectors;
                            this.summary.inspected = response.data.inspected;
                            this.summary.pass_pcs = response.data.pass_pcs;
                            this.summary.repair_pcs = response.data.repair_pcs;
                            console.log('flatItem',this.flatItem);
                            this.startCountdown();
                        });
                }catch(error){
                    console.error('Error fetching data:', error);
                    this.retreiveData();
                }
            },
            goPage(url){
                this.currentUrl = url;
                this.retreiveData();
            },
            init(){
                this.retreiveData();
            }

        }">
            <div class="space-y-3 divide-y-2 filter">
                <div>
                    <label for="">Date</label>
                    <x-flatpickr-switch >
                        <input type="hidden" x-model="param" x-modelable="get_date">
                    </x-flatpickr-switch>
                </div>
{{--                <div>--}}
{{--                    <label for="">IA Number</label>--}}
{{--                    <x-fuse-select >--}}
{{--                        <input type="hidden" x-model="param" x-modelable="filter.style">--}}
{{--                        <input type="hidden" x-model="list" x-modelable="data.styles">--}}
{{--                    </x-fuse-select>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <label for="">Location</label>--}}
{{--                    <x-fuse-select >--}}
{{--                        <input type="hidden" x-model="param" x-modelable="filter.location">--}}
{{--                        <input type="hidden" x-model="list" x-modelable="data.locations">--}}
{{--                    </x-fuse-select>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <label for="">Inspector</label>--}}
{{--                    <x-fuse-select >--}}
{{--                        <input type="hidden" x-model="param" x-modelable="filter.inspector">--}}
{{--                        <input type="hidden" x-model="list" x-modelable="data.inspectors">--}}
{{--                    </x-fuse-select>--}}
{{--                </div>--}}
                <button @click="retreiveData()" class="w-full btn btn-primary">Search</button>
            </div>

            <h3 class="w-full py-4 text-2xl font-bold text-center">Summary</h3>

            <div class="grid grid-cols-3 gap-7 py-5">
                <div class="card bg-info">
                    <div class="card-body font-bold text-white">
                        <h3 class="text-2xl text-left">Inspected</h3>
                        <h2 class="text-3xl text-right" x-text="summary.inspected"></h2>
                    </div>
                </div>
                <div class="card bg-success font-bold text-white">
                    <div class="card-body">
                        <h3 class="text-2xl text-left">Pass pcs</h3>
                        <h2 class="text-3xl text-right" x-text="summary.pass_pcs"></h2>
                    </div>
                </div>
                <div class="card bg-error font-bold text-white">
                    <div class="card-body">
                        <h3 class="text-2xl text-left">Reject pcs</h3>
                        <h2 class="text-3xl text-right" x-text="summary.repair_pcs"></h2>
                    </div>
                </div>
            </div>

{{--            <table class="table mt-5">--}}
{{--                <thead>--}}
{{--                    <tr>--}}
{{--                        <td>Location</td>--}}
{{--                        <td>Style</td>--}}
{{--                        <td>Inspector</td>--}}
{{--                        <td>Purchase order</td>--}}
{{--                        <td>Inspected Pcs</td>--}}
{{--                        <td>Detail</td>--}}
{{--                    </tr>--}}

{{--                </thead>--}}
{{--                <tbody>--}}
{{--                    <template x-for="(elem, i) in reports" :key="elem.id">--}}
{{--                    <tr>--}}
{{--                        <td x-text="elem.location.name"></td>--}}
{{--                        <td x-text="elem.style.name"></td>--}}
{{--                        <td x-text="elem.inspector.name"></td>--}}
{{--                        <td x-text="elem.purchase_order.no"></td>--}}
{{--                        <td>--}}
{{--                            <div class="flex gap-2">--}}
{{--                                <div class="badge badge-lg badge-info"><span x-text="elem.item_pcs"></span></div>--}}
{{--                                <div class="badge badge-lg badge-success"><span x-text="elem.pass_pcs"></span></div>--}}
{{--                                <div class="badge badge-lg badge-error"><span x-text="elem.repair_pcs"></span></div>--}}
{{--                            </div>--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <div x-data="{isOpen:false}">--}}
{{--                                <button @click="isOpen=true" class="btn btn-sm btn-outline btn-primary"><x-heroicon-o-eye class="w-5 h-5" />View</button>--}}
{{--                                <div x-show="isOpen" class="fixed top-0 left-0 z-10 w-screen h-screen">--}}
{{--                                    <div class="flex items-center justify-center w-full h-full bg-gray-500 bg-opacity-50">--}}
{{--                                        <div class="w-full max-w-3xl overflow-hidden bg-white divide-y min-w-max rounded-xl">--}}
{{--                                            <div class="flex justify-between p-3 title">--}}
{{--                                                <h3 class="text-2xl font-bold">Detail</h3>--}}
{{--                                                <button @click="isOpen=false" class="btn btn-circle btn-outline btn-error"><x-heroicon-o-eye-off class="w-5 h-5" /></button>--}}
{{--                                            </div>--}}
{{--                                            <div class="p-4 content">--}}
{{--                                                <div class="grid grid-cols-2 gap-3">--}}
{{--                                                <template x-for="(item, i) in elem.item_repair" :key="item.id">--}}
{{--                                                    <div x-data="{contentShow:false}" class="overflow-hidden divide-y rounded-lg" @click.away="contentShow=false">--}}
{{--                                                        <button @click="contentShow=!contentShow"--}}
{{--                                                            class="flex justify-between w-full rounded-none btn btn-info">--}}
{{--                                                            <span class="" x-text="item.garment.garmentQrCode"></span>--}}
{{--                                                            <x-heroicon-o-selector class="w-5 h-5" />--}}
{{--                                                        </button>--}}
{{--                                                        <div x-show="contentShow" class="grid grid-cols-2">--}}
{{--                                                            <div class="px-3 py-1 space-x-2 border">--}}
{{--                                                                <span class="font-bold">Size</span>--}}
{{--                                                                <span x-text="item.size.name"></span>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="px-3 py-1 space-x-2 border">--}}
{{--                                                                <span class="font-bold">Color</span>--}}
{{--                                                                <span x-text="item.color.name"></span>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="flex justify-between col-span-2 px-3 py-1 border">--}}
{{--                                                                <span class="font-bold">History</span>--}}
{{--                                                                <span class=" badge badge-outline" x-text="`Repeated : ${item.reject_qty}`"></span>--}}
{{--                                                            </div>--}}
{{--                                                            <template x-for="(repair, j) in item.repairs" :key="repair.id">--}}
{{--                                                            <div>--}}
{{--                                                                <div class="px-3 py-1 space-x-2 border">--}}
{{--                                                                    <span class="font-bold">Checkpoint</span>--}}
{{--                                                                    <span x-text="repair.checkpoint.name"></span>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="px-3 py-1 space-x-2 border">--}}
{{--                                                                    <span class="font-bold">Defect</span>--}}
{{--                                                                    <span x-text="repair.defect.name"></span>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="px-3 py-1 space-x-2 border">--}}
{{--                                                                    <span class="font-bold">Cause By</span>--}}
{{--                                                                    <span x-text="repair.cause.name"></span>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="px-3 py-1 space-x-2 border">--}}
{{--                                                                    <span class="font-bold">Operator</span>--}}
{{--                                                                    <span x-text="repair.operator.name"></span>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            </template>--}}

{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </template>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    </template>--}}
{{--                </tbody>--}}
{{--            </table>--}}
            <h3 class="w-full py-4 text-2xl font-bold text-center">Transaction Traffic</h3>
            <div class="w-full overflow-x-auto">
                <table x-show="false" class="table mt-5">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>IA Number</th>
                            <th>Inspector</th>
                            <th>Ticket</th>
                            <th>Pass/Reject Count</th>
                            <th>Size</th>
                            <th>Color</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <select class="select select-sm select-bordered">
                                    <template x-for="(location, indexLocation) in data.locations">
                                        <option :value="location.value" x-text="location.text"></option>
                                    </template>
                                </select>
                            </td>
                            <td>
                                <select class="select select-sm select-bordered">
                                    <template x-for="(style, indexStyle) in data.styles">
                                        <option :value="style.value" x-text="style.text"></option>
                                    </template>
                                </select>
                            </td>
                            <td>
                                <select class="select select-sm select-bordered">
                                    <template x-for="(inspector, indexInspector) in data.inspectors">
                                        <option :value="inspector.value" x-text="inspector.text"></option>
                                    </template>
                                </select>
                            </td>
                            <td>
                                <input class="input input-xs input-bordered">
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(item, i) in transactions.data" :key="item.id">
                            <tr>
                                <td x-text="item.id"></td>
                                <td x-text="item.date"></td>
                                <td x-text="item.location.name"></td>
                                <td x-text="item.style.name"></td>
                                <td x-text="item.inspector.name"></td>
                                <td x-text="item.garment.garmentQrCode"></td>
                                <td>
                                    <span class="badge badge-success badge-lg" x-text="item.accept_qty"></span>
                                    <span class="badge badge-error badge-lg" x-text="item.reject_qty"></span>
                                </td>
                                <td x-text="item.size.name"></td>
                                <td x-text="item.color.name"></td>
                            </tr>
                        </template>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9">
                                <div class="flex justify-end w-full gap-3">
                                    <button @click="goPage(transactions.first_page_url)" class="btn btn-sm"><span>First Page</span></button>
                                    <div class="overflow-hidden border border-black rounded-md">
                                        <template x-for="(page, i) in transactions.links" :key="i">
                                            <button :disabled="page.active" @click="goPage(page.url)"
                                                class="rounded-none btn btn-sm btn-outline" ><span x-html="page.label"></span></button>
                                        </template>
                                    </div>
                                    <button @click="goPage(transactions.last_page_url)" class="btn btn-sm"><span>Last Page</span></button>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <table class="table mt-5">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>IA Number</th>
                        <th>Inspector</th>
                        <th>Ticket</th>
                        <th>Pass/Reject Count</th>
                        <th>Size</th>
                        <th>Color</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button @click="clearFilter()" class="btn btn-sm btn-primary">clear</button>
                        </td>
                        <td>
                            <select class="select select-sm select-bordered" x-model="filter.location">
                                <option value="">All Location</option>
                                <template x-for="(location, indexLocation) in data.locations">
                                    <option :value="location.value" x-text="location.text"></option>
                                </template>
                            </select>
                        </td>
                        <td>
                            <select class="select select-sm select-bordered" x-model="filter.style">
                                <option value="">All Order</option>
                                <template x-for="(style, indexStyle) in data.styles">
                                    <option :value="style.value" x-text="style.text"></option>
                                </template>
                            </select>
                        </td>
                        <td>
                            <select class="select select-sm select-bordered" x-model="filter.inspector">
                                <option value="">All Inspector</option>
                                <template x-for="(inspector, indexInspector) in data.inspectors">
                                    <option :value="inspector.value" x-text="inspector.text"></option>
                                </template>
                            </select>
                        </td>
                        <td>
                            <input x-model="filter.garment" class="input input-xs input-bordered" placeholder="search Qr code">
                        </td>
                        <td></td>
                        <td>
                            <select class="select select-sm select-bordered" x-model="filter.size">
                                <option value="">All Size</option>
                                <template x-for="(size, indexLocation) in data.sizes">
                                    <option :value="size.value" x-text="size.text"></option>
                                </template>
                            </select>
                        </td>
                        <td>
                            <select class="select select-sm select-bordered" x-model="filter.color">
                                <option value="">All Color</option>
                                <template x-for="(color, indexLocation) in data.colors">
                                    <option :value="color.value" x-text="color.text"></option>
                                </template>
                            </select>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <template x-for="(item, i) in filterItems" :key="item.id">
                        <tr>
                            <td x-text="i+1"></td>
                            <td x-text="item.date"></td>
                            <td x-text="item.location.name"></td>
                            <td x-text="item.style.name"></td>
                            <td x-text="item.inspector.name"></td>
                            <td x-text="item.garment.garmentQrCode"></td>
                            <td>
                                <span class="badge badge-success badge-lg" x-text="item.accept_qty"></span>
                                <span class="badge badge-error badge-lg" x-text="item.reject_qty"></span>
                            </td>
                            <td x-text="item.size.name"></td>
                            <td x-text="item.color.name"></td>
                        </tr>
                    </template>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="9">
                            <div class="flex justify-end w-full gap-3">
{{--                                <button @click="goPage(transactions.first_page_url)" class="btn btn-sm"><span>First Page</span></button>--}}
                                <div class="overflow-hidden border border-black rounded-md">
                                    <template x-for="paginate in pages" :key="paginate">
                                        <button :disabled="page===paginate-1" @click="page=paginate-1"
                                                class="rounded-none btn btn-sm btn-outline" ><span x-text="paginate"></span></button>
                                    </template>
                                </div>
{{--                                <button @click="goPage(transactions.last_page_url)" class="btn btn-sm"><span>Last Page</span></button>--}}
                            </div>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>





        </div>
    </div>
</div>
