<div>

    <div x-data="{
        tab:'table',
        page:1,
        per_page:10,
        filter:{},
        data:{},
        datatable:{},
        load(){
            this.$wire.load(this.page,this.per_page,this.filter)
                .then( response => this.datatable = response );
        },
        addRecord(param){},
        viewRecord(param){
            this.tab = 'view';
            this.data = _.find(this.datatable.data, i => i.id === param);
            console.log('data',this.data);
        },
        editRecord(param){
            this.tab = 'edit';
            this.data = _.find(this.datatable.data, i => i.id === param);
        },
        updateRecord(){},
        deleteRecord(param){},
        init(){
            this.load();
        }
    }">
        <div class="tabs tabs-boxed">
            <a @click="tab='table'" class="tab" :class="{'tab-active':tab=='table'}">
                Data Source</a>
            <a class="tab" :class="{'tab-active':tab=='view'}">
                View Tuition Fee Information</a>
            <a class="tab" :class="{'tab-active':tab=='edit'}">
                Edit Tuiiton Fee Information</a>
        </div>

        <div x-show="tab=='table'">
            @include('livewire.management.tuition-fee.table')
        </div>
        <div x-show="tab=='view'">
            @include('livewire.management.tuition-fee.view')
        </div>
        <div x-show="tab=='edit'">
            @include('livewire.management.tuition-fee.edit')
        </div>

    </div>

</div>