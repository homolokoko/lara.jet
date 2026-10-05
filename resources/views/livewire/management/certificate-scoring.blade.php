<x-slot name="title">
    <span class="uppercase">Certificate Scoring</span>
</x-slot>

<div wire:ignore
    x-data="{
        sourceData:{},
        async getSourceData(){
            await this.$wire.getSourceData()
                .then(response=>this.souceData=response);
        }
    }" x-init="getSourceData">
    <table>
        <tr>
            <td class="border"><p class="uppercase text-xs">Study Period</p></td>
            <td class="border"></td>
            <td class="border"><p class="uppercase text-xs">Type</p></td>
            <td class="border"></td>
            <td class="border"><p class="uppercase text-xs">Month</p></td>
            <td class="border"></td>
            <td class="border"><p class="uppercase text-xs">Current Year</p></td>
            <td class="border"></td>
            <td class="border"><p class="uppercase text-xs">Institution</p></td>
            <td class="border"></td>
        </tr>
        <tr>
            <td class="border"><p class="uppercase text-xs">Date of Examination</p></td>
            <td class="border"></td>
            <td class="border"><p class="uppercase text-xs">Date of Signature off</p></td>
            <td class="border"></td>
        </tr>
    </table>
</div>
