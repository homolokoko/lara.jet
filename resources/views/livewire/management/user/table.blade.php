<table class="table table-compact">
    <tr>
        <td class="border"><p class="font-semibold text-xs">No.</p></td>
        <td class="border"><p class="font-semibold text-xs">ID</p></td>
        <td class="border"><p class="font-semibold text-xs">Name</p></td>
        <td class="border"><p class="font-semibold text-xs">Official</p></td>
        <td class="border"><p class="font-semibold text-xs">Responsible for by</p></td>
        <td class="border"><button @click="openCreateTab()" class="btn btn-xs btn-primary">Create</button></td>
    </tr>
    <template x-for="(elem, index) in datatable.data" :key="elem.id">
        <tr>
            <td class="border"><p class="text-xs" x-text="index+1">No.</p></td>
            <td class="border"><p class="text-xs" x-text="elem.email">ID</p></td>
            <td class="border"><p class="text-xs" x-text="elem.name">Name</p></td>
            <td class="border"><p class="text-xs" x-text="elem.locale">Official</p></td>
            <td class="border"><p class="text-xs" x-text="`${elem.parent.locale} ${elem.parent.name}`">Responsible for by</p></td>
            <td class="border"><button @click="openModifyTab(elem.id)" class="btn btn-xs btn-info">Modify</button></td>
        </tr>
    </template>
    <tr>
        <td colspan="6" class="border">
            <div class="flex">
                <template x-for="link in datatable.links">
                    <button class="btn btn-ghost btn-xs" x-text="link.label"></button>
                </template>
            </div>
        </td>
    </tr>
</table>
