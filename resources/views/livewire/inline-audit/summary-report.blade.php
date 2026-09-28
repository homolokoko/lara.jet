<div wire:ignore>
     Knowing others is intelligence; knowing yourself is true wisdom.

    <div x-data="{
        data:[],
        between:{
            mode:'',
            value:'',
        },
        getData(){
            this.$wire.load(this.between)
                .then((response)=>{this.data=response })
        }
    }">
        <span x-text="JSON.stringify(between)"></span>
        <div>
            <label for="" class="label-text-alt label">Filter by date</label>
            <div class="border border-black rounded-lg">
                <x-flatpickr-switch>
                    <input x-model="param" x-modelable="between" type="hidden" />
                </x-flatpickr-switch>
            </div>
        </div>

        <button @click="getData()" class="btn btn-sm w-full">Get Data</button>

        <table class="table">
            <thead>
            <tr>
                <td>Line (station)</td>
                <td>Report Date</td>
                <td>Flag</td>
            </tr>
            </thead>
            <tbody>
            <template x-for="(elem,i) in data" :key="elem.id">
                <tr>
                    <td>
                        <span x-text="elem.station.locate_name"></span>
                        ( <span x-text="elem.station.station"></span> )
                    </td>
                    <td><span x-text="elem.reportDate"></span></td>
                    <td>
                        <span :class="{
                            'text-red-500':elem.is_red,
                            'text-green-500':elem.is_green,
                            'text-yellow-500':elem.is_yellow,
                        }">
                            <x-heroicon-s-flag class="w-5 h-5" />
                        </span>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>

    </div>


</div>
