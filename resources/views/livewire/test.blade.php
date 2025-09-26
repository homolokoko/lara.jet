<div>
    <div x-data="{
        datatable:{},
        triggerPage(url){

            const urlObj = new URL(url);

            const page = urlObj.searchParams.get('page');

            this.$wire.load(page)
                .then((response)=>{
                    this.datatable = response;
                    console.log('datatable',response);
                });
        },
        init(){
            console.log('toNumber',_.toNumber('1'));
            this.$wire.load(1)
                .then((response)=>{
                    this.datatable = response;
                    console.log('datatable',response);
                });
        }
    }">

        <table class="table w-full">
            <thead>
                <tr>
                    <td>id</td>
                    <td>name</td>
                    <td>buyer</td>
                    <td>type</td>
                    <td><button class="btn btn-primary">create</button></td>
                </tr>
            </thead>
            <tbody>
            <template x-for="(item, index) in datatable.data" :key="item.id">
            <tr>
                <td><span x-text="item.id"></span></td>
                <td><span x-text="item.name"></span></td>
                <td><span x-text="item.buyer.name"></span></td>
                <td><span x-text="item.type"></span></td>
                <td><button class="btn btn-secondary">Modify</button></td>
            </tr>
            </template>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">
                        <div class="flex justify-end w-full">
                            <template x-for="(link, index) in datatable.links">
                                <button
                                    @click="triggerPage(link.url)"
                                    :disabled="link.active"
                                    :class="{
                                            'btn-ghost':!link.active,
                                            'btn-active':link.active,
                                            'btn-circle':!_.isNaN(_.toNumber(link.label))
                                        }"
                                    class="btn btn-sm" x-html="link.label"></button>
                            </template>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>

    </div>

</div>
