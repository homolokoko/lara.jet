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
}" class="space-y-4">

    <div class="grid grid-cols-5 gap-2">
        <template x-for="(item, index) in data.data" :key="index">
            <div x-data="{
                result:'',
                download(){
                    const link = document.createElement('a');
                    link.download = `${item.ticketID}.png`;
                    link.href = this.result;
                    link.click();
                },
                init(){
                    QrCode.toDataURL(item.ticketID)
                        .then(url => this.result=url)
                }
            }" x-ref="image" class="overflow-hidden rounded-lg ">
                <img :src="result" class="w-full">
                <button class="w-full rounded-none btn btn-sm btn-primary" @click="download()">
                    <label class="flex items-center space-x-1">
                        <x-heroicon-o-download class="w-5 h-5" />
                        <p x-text="item.ticketID"></p>
                    </label>
                </button>
            </div>
        </template>
    </div>

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
</div>
