<div>

    <div x-data="{
        page:1,
        per_page:10,
        filter:{},
        datatable:{},
        load(){
            this.$wire.load(this.page,this.per_page,this.filter)
                .then( response => this.datatable = response );
        },
        init(){
            this.load();
        }
    }">

        <table class="table table-compact">
            <thead>
                <tr>

                </tr>
            </thead>
        </table>
        <tbody>
            <template x-for="(elem, index) in datatable.data">
                <tr>
                    <td class="border border-black">
                        <div>
                            <h3><span class="font-bold text-lg block" x-text="elem.name_kh"></span></h3>
                            <h3><span class="font-bold text-md block" x-text="elem.name_en"></span></h3>
                        </div>
                    </td>
                </tr>
            </template>
        </tbody>

    </div>

</div>