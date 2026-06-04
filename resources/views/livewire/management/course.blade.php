<div x-data="{
    tab:'table',
    page:1,
    per_page:10,
    filter:{},
    datatable:{},
    createData:{},
    goPage(page){
        this.page=page;
        this.retrive();
    },
    async remove(id){
        swal.fire({
            icon:'question',
            title: 'Delete This Staff',
            text: 'Are you sure to delete this staff',
            showDenyButton:true
        }).then(async (result)=>{
            if(result.isConfirmed)
                await this.$wire.remove(id)
                    .then(()=>{
                        swal.fire({
                            icon: 'success',
                            title: 'Remove Staff Successfully',
                            text: 'Closing ....',
                            showConfirmButton: false,
                            timer: 1000,
                            timerProgressBar: true,
                        }).then(()=>{ this.retrive(); });
                    });
            else
                swal.fire({
                    icon: 'info',
                    title: 'Nothing Happen!',
                    timer: 1000,
                    timerProgressBar: true,
                    toast:true,
                    position: 'top-right',
                    showConfirmButton: false
                });
        })
    },
    async retrive(){
        await this.$wire.datatable(this.page,this.per_page,this.filter)
            .then(async (response)=>{ this.datatable = await response; console.log('datatable',this.datatable) })
    },
    staffs:[],
    editData:{},
    showEditView(param){
        this.tab='edit';
        this.editData = _.find(this.datatable.data, i=>i.id===param);
        this.editSubjects = this.editData.subjects;
        console.log('edit data', this.editData);
    },
    addCreateSubject(){
        this.createSubjects.push({full_score:'',name:''});
    },
    addEditSubject(){
        this.createSubjects.push({full_score:'',name:''});
    },
    deleteCreateSubject(index){
        _.pullAt(this.createSubjects,index)
    },
    deleteEditSubject(index){
        _.pullAt(this.createSubjects,index)
    },
    async submitCreate(){
        this.$wire.submit(this.createData,this.createSubjects)
            .then(()=>{ this.tab='table'; this.retrive();  })
    },
    async submitEdit(){
        this.$wire.submit(this.editData,this.editSubjects)
            .then(()=>{ this.tab='table'; this.retrive();  })
    },
    init(){
        this.$wire.load()
            .then((response)=>{ this.staffs = response.staffs; })
        let current_year = new Date().getFullYear();
        this.course_years = _.range(current_year-4,current_year+6);
    },
    course_years:[],
    pullInfomation(val){
        modalOpen=true;
    },
    createSubjects:[],
    editSubjects:[],
    subjects:[],
    addSubject(){
        this.subjects.push({full_score:'',name:''});
    },
    deleteSubject(index){
        _.pullAt(this.subjects,index)
    },
}" wire:ignore x-init="retrive()" @reload-data-table.window="retrive()" @update-course-datatable.window="retrive()">

    <div class="tabs tabs-boxed">
        <a @click="tab='table'" class="tab" :class="{'tab-active':tab=='table'}">
            Data Source</a>
        <a @click="tab='add'" class="tab" :class="{'tab-active':tab=='add'}">
            Create Course Information</a>
        <a class="tab" :class="{'tab-active':tab=='edit'}">
            Edit Course Information</a>
    </div>

    <div x-show="tab=='table'">
        @include('livewire.management.course.table')
    </div>
    <div x-show="tab=='add'">
        @include('livewire.management.course.create')
    </div>
    <div x-show="tab=='edit'">
        @include('livewire.management.course.edit')
    </div>


</div>