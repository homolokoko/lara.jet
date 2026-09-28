<div>
    <div x-data="{
        lines:[],
        init(){
            this.$wire.fetch()
                .then(response=>this.lines=response)
        }
    }">
        <template x-for="(line, lineIndex) in lines" :key="line.id">
            <div x-data="{
                dropdown:false,
            }" class="divide-y" @click.away="dropdown=false">
                <button @click="dropdown=!dropdown" class="flex justify-between w-full rounded-none btn btn-lg">
                    <span x-text="line.name"></span>
                    <span x-show="!dropdown"><x-heroicon-o-plus class="w-8 h-8" /></span>
                    <span x-show="dropdown"><x-heroicon-o-minus class="w-8 h-8" /></span>
                </button>
                <table x-show="dropdown" class="table w-full border border-gray-700 table-zebra">
                    <tr>
                        <td class="font-semibold">#ID</td>
                        <td class="font-semibold">Garment Ticket</td>
                        <td class="font-semibold">Status</td>
                        <td class="font-semibold">Inspector</td>
                        <td class="font-semibold">Scan Date</td>
                    </tr>
                    <template x-for="(trans, transIndex) in line.transactions" :key="trans.id">
                    <tr>
                        <td><span class="font-semibold" x-text="trans.id"></span></td>
                        <td><span x-text="trans.garment.garmentQrCode"></span></td>
                        <td><button x-show="trans.is_pass" class="btn btn-success">Pass</button><button x-show="!trans.is_pass" class="btn btn-error">Reject</button></td>
                        <td><span x-text="trans.inspector.name"></span></td>
                        <td><span x-text="trans.scan_date"></span></td>
                    </tr>
                    </template>
                </table>
            </div>
        </template>
    </div>
</div>
