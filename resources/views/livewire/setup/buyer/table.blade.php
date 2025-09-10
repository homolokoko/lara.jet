<div>
    {{-- Do your work, then step back. --}}
{{--    <livewire:setup.buyer.edit :identity="$value" wire:key="setup.buyer.edit.{{$value}}"></livewire:setup.buyer.edit>--}}
    <div x-data="{
         edit(id){
             this.$wire.show(id)
                .then((response)=>{
                    swal.fire({
                        title: 'Edit Buyer Name',
                        input: 'text',
                        inputLabel: 'Name',
                        inputValue: response.name,
                        showCancelButton:true
                    }).then((result)=>{
                        if(result.isConfirmed)
                            this.$wire.submit(id,result.value)
                                .then(()=>{ this.responseSuccess() });
                    });
                });
        },
        responseSuccess(){
            swal.fire({
                icon:'success',
                title:'Name has changed!',
                toast:true,
                timer:1500,
                timerProgressBar:true,
                showConfirmButton:false,
                position:'top-right'
            })
        }
    }">
        <button @click="edit(@js($value))" class="btn btn-sm btn-warning">Edit</button>
    </div>

</div>
