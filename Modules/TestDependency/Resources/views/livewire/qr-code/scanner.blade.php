<div x-data="{
    qrScanner:null,
    clearCam(){
        this.qrScanner=null;
    },
    configCam(){
        this.qrScanner = new QrScanner(
            this.$refs.videoElem,
            result => this.submit(result)
        );
    },
    startScanner(){
        this.configCam();
        this.qrScanner.start();
        this.$refs.container.classList.remove('hidden');
    },
    stopScanner(){
        this.qrScanner.stop();
        this.$refs.container.classList.add('hidden');
        this.clearCam();
    },
    submit(result){
        this.stopScanner();
        swal.fire({
            icon: 'success',
            title: result,
            text: 'Do you want to continue ?',
            showDenyButton: true,
            confirmButtonText: 'Yes',
        }).then((opt)=>{
            if(opt.isConfirmed)
                this.startScanner();
        })
    },
}">
    <div x-ref="container" class="fixed top-0 left-0 hidden w-screen h-screen">
        <div class="flex items-center justify-center w-full h-full bg-gray-900 bg-opacity-25">
            <div class="relative w-1/2 space-y-3 rounded-2xl card bg-slate-100">
                <video x-ref="videoElem" class="rounded-md"></video>
                <div class="absolute bottom-0 left-0 w-full p-5 text-center"><button class="w-full btn btn-outline" @click="stopScanner()">Exit</button></div>
            </div>
        </div>
    </div>
    <div class="flex items-center justify-center w-full h-full p-11">
        <button class="border-none hover:bg-transparent btn btn-outline">
            <img class="bg-teal-500 rounded-lg" @click="startScanner()" src="{{ asset('menu/qr-code-scan.png') }}" alt="">
        </button>
    </div>
</div>
