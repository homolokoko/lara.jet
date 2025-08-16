<div x-data="{
        scannerEngine:null,
        async activeScanner(v){
            modalOpen=true;
            let video = { 'elem': this.$refs.videoElem, 'camera': 'environment' };
            this.scannerEngine = await new QrScanner(
                 this.$refs.videoElem,
                result => this.detectGarmentCode(result)
            );
            this.scannerEngine.start();
            this.$refs.scan_region.classList.remove('hidden');
        },
        async detectGarmentCode(v){
            sketch.garment_code=v;
            this.scannerEngine.stop();
            this.$wire.detectGarmentCode(v)
                .then((response)=>{
                    information.garment_id=response.garment_tracking_id;
                    swal.fire(response.alert_message)
                        .then((result)=>{
                            if(result.isDenied){
                                this.scannerEngine.start();
                                this.$refs.scan_region.classList.remove('hidden');
                            }else{
                                garment_tracking_id = response.garment_tracking_id;
                                this.$wire.submitAcceptItem(information)
                                    .then(()=>{
                                        this.scannerEngine.start();
                                        this.$refs.scan_region.classList.remove('hidden');
                                    });
                            }
                        })
                })

        },
        async inActiveScanner(){
            modalOpen=false;
            this.scannerEngine.stop();
            this.$refs.scan_region.classList.add('hidden');
        },
        recordSend(){
            console.log({'information':information,'sketch':sketch});
            this.$wire.submitGoodItem({
                sketch: sketch,
                information: information
            })
        },

    }"
    @active-good-item-record.window="activeScanner(event.detail)"
    @detect-existing-garment-code.window="detectGarmentCode(event.detail)"
>

    <div>
        <x-webcam.scanner></x-webcam.scanner>
    </div>

    <div class="sticky bottom-0 flex justify-center w-full gap-5 p-5">
        {{-- <button @click="defectSend()" class="btn btn-info">Save</button> --}}
        <button @click="inActiveScanner()" class="btn btn-outline">Close</button>
    </div>


</div>

