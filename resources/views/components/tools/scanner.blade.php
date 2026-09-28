<div>
    <div x-data="{
        output:'',
        scanner: {
            open: false,
            webcam: null,
        },
        startScanner(){
            this.assignWebcam();
            this.scanner.webcam.start();
            this.$refs.wrap.classList.remove('hidden');
        },
        stopScanner(){
            this.scanner.webcam.stop();
            this.scanner.webcam = null;
            this.$refs.wrap.classList.add('hidden');
        },
        assignCode(result){
            this.output = result;
            this.stopScanner();
        },
        assignWebcam(){
            this.scanner.webcam = new QrScanner(
                this.$refs.videoElem,
                result => this.assignCode(result)
            );
        },

    }" class="relative">
        <div x-ref="wrap" class="fixed top-0 left-0 hidden w-screen h-screen">
            <div class="flex items-center justify-center w-full h-full bg-gray-900 bg-opacity-25">
                <div class="relative w-1/2 space-y-3 rounded-2xl card bg-slate-100">
                    <video x-ref="videoElem" class="rounded-md"></video>
                    <div class="absolute bottom-0 left-0 w-full p-5 text-center"><button class="w-full btn btn-outline" @click="stopScanner()">Exit</button></div>
                </div>
            </div>
        </div>
        {{ @$slot }}
        <span @click="startScanner()">{{ @$trigger }}</span>
    </div>
</div>
