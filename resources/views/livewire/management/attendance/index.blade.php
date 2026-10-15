<x-slot name="title"><p class="uppercase">Attendance</p></x-slot>
<div x-data="{
    filter:{
        year:null,
        month:null,
        day:null
    },
    data:{
        years:[],
        months:[],
        end_of_month:null,
    },
    datatable:[],
    async fetchdata(){
        await this.$wire.fetchdata()
            .then(async (response)=>{
                this.datatable = await response;
            });
    },
    async getRelatedData(){
        await this.$wire.getRelatedData(this.filter)
            .then(async (response)=>{
                this.filter = await response.filter;
                this.data = await response.data;
            });
    },
    init(){
        this.fetchdata();
        this.getRelatedData();
    },
}" wire:ignore class="flex justify-center">
    <div class="space-y-4">
        <div class="flex gap-3">
            <select @change="getRelatedData" x-model="filter.year" class="select select-xs select-bordered">
                <option value="">-</option>
                <template x-for="value in data.years" :key="value">
                    <option :value="value" x-text="value" :selected="filter.year==value"></option>
                </template>
            </select>
             <select @change="getRelatedData" x-model="filter.month" class="select select-xs select-bordered">
                <option value="">-</option>
                <template x-for="item in data.months" :key="item.value">
                    <option :value="item.value" x-text="item.text" :selected="filter.month==item.value"></option>
                </template>
            </select>
        </div>
        <table class="table table-compact">
            <tr>
                <td class="border"><p class="text-xs font-semibold">No.</p></td>
                <td class="border"><p class="text-xs font-semibold">Name</p></td>
                <template x-for="i in _.range(1,data.end_of_month+1)">
                    <td class="border"><p class="text-xs font-semibold" x-text="i"></p></td>
                </template>
            </tr>
        </table>
    </div>
</div>
