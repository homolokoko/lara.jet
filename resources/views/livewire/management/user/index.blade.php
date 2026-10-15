<x-slot name="title">
    <p class="uppercase">User Management</p>
</x-slot>
<div x-data="{
    tab:1,
    page:1,
    perpage:50,
    filter:{},
    data:{
        name:'',
        email:'',
        locale:'',
        responsible:null,
    },
    datatable:{},
    responsibles:[],
    openCreateTab(){
        this.tab=2;
        this.data={
            name:'',
            email:'',
            locale:'',
            responsible:null,
        };
    },
    openModifyTab(id){
        this.tab=3;
        this.$wire.reviewData(id)
            .then(response=>this.data = response);
    },
    async getresponsible(){
        await this.$wire.getresponsible()
            .then(async response=>this.responsibles=await response);
    },
    async getrecords(){
        await this.$wire.getrecords(
            this.page,
            this.perpage,
            this.filter
        ).then(async (response)=>{
            this.datatable = await response;
        });
    },
    async createData(){
        await this.$wire.createData(this.data)
            .then(()=>{
                swal.fire({
                    icon:'success',
                    timer:1500,
                    timerProgressBar:true,
                    showConfirmButton:false,
                    title:'Created Successfully!'
                }).then(()=>{
                    this.tab=1;
                    this.getrecords();
                });
            });
    },
    async updateData(){
        await this.$wire.updateData(this.data)
            .then(()=>{
                swal.fire({
                    icon:'success',
                    timer:1500,
                    timerProgressBar:true,
                    showConfirmButton:false,
                    title:'Updated Successfully!'
                }).then(()=>{
                    this.tab=1;
                    this.getrecords();
                });
            });
    },
    async deleteData(){
        await this.$wire.deleteData(this.data)
            .then(()=>{
                swal.fire({
                    icon:'success',
                    timer:1500,
                    timerProgressBar:true,
                    showConfirmButton:false,
                    title:'Deleted Successfully!'
                }).then(()=>{
                    this.tab=1;
                    this.getrecords();
                });
            });
    },
    init(){
        this.getrecords();
        this.getresponsible();
    }
}" wire:ignore class="flex justify-center">

    <div x-show="tab===1">@include('livewire.management.user.table')</div>
    <div x-show="tab===2">@include('livewire.management.user.create')</div>
    <div x-show="tab===3">@include('livewire.management.user.modify')</div>

</div>
