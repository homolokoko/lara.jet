<div wire:ignore>
    <div>
        <div x-data="{
            countdown:0,
            intervalId: null,
            transactions:{},
            currentUrl:'{{route('full-qc.defect-analysis-transcaction.report',$module)}}',
            filter:{
                style:{},
                location:{},
                inspector:{},
                date:{},
            },
            data:{
                styles:[],
                locations:[],
                inspectors:[]
            },
            reports:[],
            startCountdown() {
                let timer = this.intervalId = setInterval(() => {
                    this.countdown--;
                    if (this.countdown <= 0) {
                        this.countdown = 10;
                        this.retreiveData();
                        clearInterval(timer);
                    }
                }, 1000);
            },
            retreiveData() {
                try{
                    axios.patch(`{{route('full-qc.defect-analysis.report',$module)}}`,this.filter)
                        .then((response)=>{ this.reports = response.data });
                    axios.patch(this.currentUrl,this.filter)
                        .then((response)=>{
                            this.transactions = response.data;
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
                this.$wire.load()
                    .then((response)=>{
                        this.data = response;
                        this.retreiveData();
                    })

            }

        }">
            <div class="space-y-3 divide-y-2 filter">
                <div>
                    <label for="">Date</label>
                    <x-flatpickr-switch >
                        <input type="hidden" x-model="param" x-modelable="filter.date">
                    </x-flatpickr-switch>
                </div>
                <div>
                    <label for="">IA Number</label>
                    <x-fuse-select >
                        <input type="hidden" x-model="param" x-modelable="filter.style">
                        <input type="hidden" x-model="list" x-modelable="data.styles">
                    </x-fuse-select>
                </div>
                <div>
                    <label for="">Location</label>
                    <x-fuse-select >
                        <input type="hidden" x-model="param" x-modelable="filter.location">
                        <input type="hidden" x-model="list" x-modelable="data.locations">
                    </x-fuse-select>
                </div>
                <div>
                    <label for="">Inspector</label>
                    <x-fuse-select >
                        <input type="hidden" x-model="param" x-modelable="filter.inspector">
                        <input type="hidden" x-model="list" x-modelable="data.inspectors">
                    </x-fuse-select>
                </div>
                <button @click="retreiveData()" class="w-full btn btn-primary">Search</button>
            </div>

            <h3 class="w-full py-4 text-2xl font-bold text-center">Linewise Summary</h3>

            <table class="table mt-5">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Style</th>
                        <th>Inspector</th>
                        <th>Purchase order</th>
                        <th>Inspected Pcs</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="(elem, i) in reports" :key="elem.id">
                    <tr>
                        <td x-text="elem.location.name"></td>
                        <td x-text="elem.style.name"></td>
                        <td x-text="elem.inspector.name"></td>
                        <td x-text="elem.purchase_order.no"></td>
                        <td>
                            <div class="flex gap-2">
                                <div class="badge badge-lg badge-info"><span x-text="elem.item_pcs"></span></div>
                                <div class="badge badge-lg badge-success"><span x-text="elem.pass_pcs"></span></div>
                                <div class="badge badge-lg badge-error"><span x-text="elem.repair_pcs"></span></div>
                            </div>
                        </td>
                        <td>
                            <div x-data="{isOpen:false}">
                                <button @click="isOpen=true" class="btn btn-sm btn-outline btn-primary"><x-heroicon-o-eye class="w-5 h-5" />View</button>
                                <div x-show="isOpen" class="fixed top-0 left-0 z-10 w-screen h-screen">
                                    <div class="flex items-center justify-center w-full h-full bg-gray-500 bg-opacity-50">
                                        <div class="w-full max-w-3xl overflow-hidden bg-white divide-y min-w-max rounded-xl">
                                            <div class="flex justify-between p-3 title">
                                                <h3 class="text-2xl font-bold">Detail</h3>
                                                <button @click="isOpen=false" class="btn btn-circle btn-outline btn-error"><x-heroicon-o-eye-off class="w-5 h-5" /></button>
                                            </div>
                                            <div class="p-4 content">
                                                <div class="grid grid-cols-2 gap-3">
                                                <template x-for="(item, i) in elem.item_repair" :key="item.id">
                                                    <div x-data="{contentShow:false}" class="overflow-hidden divide-y rounded-lg" @click.away="contentShow=false">
                                                        <button @click="contentShow=!contentShow"
                                                            class="flex justify-between w-full rounded-none btn btn-info">
                                                            <span class="" x-text="item.garment.garmentQrCode"></span>
                                                            <x-heroicon-o-selector class="w-5 h-5" />
                                                        </button>
                                                        <div x-show="contentShow" class="grid grid-cols-2">
                                                            <div class="px-3 py-1 space-x-2 border">
                                                                <span class="font-bold">Size</span>
                                                                <span x-text="item.size.name"></span>
                                                            </div>
                                                            <div class="px-3 py-1 space-x-2 border">
                                                                <span class="font-bold">Color</span>
                                                                <span x-text="item.color.name"></span>
                                                            </div>
                                                            <div class="flex justify-between col-span-2 px-3 py-1 border">
                                                                <span class="font-bold">History</span>
                                                                <span class=" badge badge-outline" x-text="`Repeated : ${item.reject_qty}`"></span>
                                                            </div>
                                                            <template x-for="(repair, j) in item.repairs" :key="repair.id">
                                                            <div>
                                                                <div class="px-3 py-1 space-x-2 border">
                                                                    <span class="font-bold">Checkpoint</span>
                                                                    <span x-text="repair.checkpoint.name"></span>
                                                                </div>
                                                                <div class="px-3 py-1 space-x-2 border">
                                                                    <span class="font-bold">Defect</span>
                                                                    <span x-text="repair.defect.name"></span>
                                                                </div>
                                                                <div class="px-3 py-1 space-x-2 border">
                                                                    <span class="font-bold">Cause By</span>
                                                                    <span x-text="repair.cause.name"></span>
                                                                </div>
                                                                <div class="px-3 py-1 space-x-2 border">
                                                                    <span class="font-bold">Operator</span>
                                                                    <span x-text="repair.operator.name"></span>
                                                                </div>
                                                            </div>
                                                            </template>

                                                        </div>
                                                    </div>
                                                </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </template>
                </tbody>
            </table>
            <h3 class="w-full py-4 text-2xl font-bold text-center">Transaction Traffic</h3>
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





        </div>
    </div>
</div>
