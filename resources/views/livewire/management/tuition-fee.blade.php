<div>

    <div x-data="{
        tab:'table',
        page:1,
        per_page:10,
        filter:{},
        data:{
            tution_fee:{
                course:{}
            }
        },
        datatable:{},
        referCourses:[],
        load(){
            this.$wire.load(this.page,this.per_page,this.filter)
                .then( response => this.datatable = response );
        },
        addRecord(param){
            this.tab = 'add';
            this.data = _.find(this.datatable.data, i => i.id === param);
            console.log('data',this.data);
        },
        viewRecord(param){
            this.tab = 'view';
            this.data = _.find(this.datatable.data, i => i.id === param);
            console.log('data',this.data);
        },
        editRecord(param){
            this.tab = 'edit';
            this.data = _.find(this.datatable.data, i => i.id === param);
            console.log('data',this.data);
        },
        updateRecord(){

            console.log('update record',this.data);
            this.$wire.updateRecord(this.data)
                .then(()=>{});

        },
        deleteRecord(param){},
        init(){
            this.load();
            this.$wire.references()
                .then((response)=>{ this.referCourses = response.courses; })
        }
    }">
        <div class="tabs tabs-boxed">
            <a @click="tab='table'" class="tab" :class="{'tab-active':tab=='table'}">
                Data Source</a>
            <a class="tab" :class="{'tab-active':tab=='view'}">
                View Tuition Fee Information</a>
            <a class="tab" :class="{'tab-active':tab=='view'}">
                Add Tuition Fee Information</a>
            <a class="tab" :class="{'tab-active':tab=='edit'}">
                Edit Tuiiton Fee Information</a>
        </div>

        <template x-if="tab=='table'">
            @include('livewire.management.tuition-fee.table')
        </template>
        <template x-if="tab=='view'">
            @include('livewire.management.tuition-fee.view')
        </template>
        <template x-if="tab=='add'">
            @include('livewire.management.tuition-fee.add')
        </template>
        <template x-if="tab=='edit'">
            @include('livewire.management.tuition-fee.edit')
        </template>

    </div>

</div>