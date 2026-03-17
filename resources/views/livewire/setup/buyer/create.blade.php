<div>
     <div x-data="{
        name:'',
        showInput:false,
        submit(){
            this.$wire.submit(this.name)
                .then(()=>{ this.responseSuccess();this.name=''; })
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
            }).then(()=>{ this.$wire.emit('refreshDatatable'); })
        }
     }" class="overflow-hidden border border-black rounded-lg">
         <div>
             <button @click="showInput=!showInput" class="btn w-full rounded-none">create</button>
             <div x-show="showInput" class="form-control p-5 border border-black">
                 <div class="flex space-x-2">
                     <input x-model="name" placeholder="Input Name" class="w-full input input-bordered">
                     <button @click="submit()" class="btn">Submit</button>
                 </div>
             </div>
         </div>

     </div>
</div>
