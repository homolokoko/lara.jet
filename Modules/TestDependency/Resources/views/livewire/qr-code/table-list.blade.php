<div x-data="{
    data:{},
    firstPage(url){
        axios.get(url)
            .then((response)=>{ this.data = response.data; })
    },
    lastPage(url){
        axios.get(url)
            .then((response)=>{ this.data = response.data; })
    },
    renderPage(url){
        axios.get(url)
            .then((response)=>{ this.data = response.data; })
    },
    init(){
        axios.get(@js(route('testdependency::api.qr-code.index')))
            .then((response)=>{ this.data = response.data; })
    }
}">
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>tktd_id</th>
                    <th>ticketID</th>
                    <th>qty</th>
                    <th>orderno</th>
                    <th>spID</th>
                    <th>buyerpo</th>
                    <th>garmentID</th>
                    <th>styleno</th>
                    <th>colorID</th>
                    <th>colorname</th>
                    <th>size_name</th>
                    <th>wpdID</th>
                    <th>statusID</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(item, index) in data.data" :key="index">
                    <tr>
                        <th x-text="item.tktd_id"></th>
                        <th x-text="item.ticketID"></th>
                        <th x-text="item.qty"></th>
                        <th x-text="item.orderno"></th>
                        <th x-text="item.spID"></th>
                        <th x-text="item.buyerpo"></th>
                        <th x-text="item.garmentID"></th>
                        <th x-text="item.styleno"></th>
                        <th x-text="item.colorID"></th>
                        <th x-text="item.colorname"></th>
                        <th x-text="item.size_name"></th>
                        <th x-text="item.wpdID"></th>
                        <th x-text="item.statusID"></th>
                    </tr>
                </template>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="14">
                        <div class="btn-group">
                            <button class="btn btn-sm btn-primary" @click="firstPage(data.first_page_url)">First Page</button>
                            <template x-for="(link, i) in data.links" :key="i">
                                <button class="btn btn-sm"
                                @click="renderPage(link.url)"
                                :disabled="link.active"
                                :class="{
                                    'btn-active':link.active,
                                    'btn-ghost':!link.active
                                }" x-html="link.label"></button>
                            </template>
                            <button class="btn btn-sm btn-primary" @click="firstPage(data.last_page_url)">Last Page</button>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
