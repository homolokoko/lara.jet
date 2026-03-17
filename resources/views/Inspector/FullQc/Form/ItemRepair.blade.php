<div x-data="{
        step:0,
        sketchEngine:null,
        scannerEngine:null,
        webcamEngine:false,
        image:'',
        async activeSketchEngine(){
            this.step = 1;
            modalOpen = true;
            this.sketchEngine = await new QMS.ApparelPointer(
                    sketch.svg.image,
                    this.$refs.svg,
                    sketch_data.checkpoints,
                    'active-scanner-engine'
                );
            this.sketchEngine.active();
        },
        async activeScannerEngine(v){
            this.step=2;
            sketch.checkpoint = _.find(sketch_data.checkpoints,item=>item.area==v.selectedCheckPointId);
            console.log('sketch.checkpoint',sketch.checkpoint);
            this.$refs.scan_region.classList.remove('hidden');
            let video = { 'elem': this.$refs.videoElem, 'camera': 'environment' };
            this.scannerEngine = await new QMS.scan(
                video,
                this.$refs.messageElem,
                'active-webcam-engine'
            );
            this.scannerEngine.start();
        },
        async activeWebcamEngine(v){
            this.$wire.detectQrCode(v)
                .then((response)=>{
                    swal.fire(response.alert_message)
                        .then((result)=>{
                            if(result.isDenied){
                                this.scannerEngine.start();
                                this.$refs.scan_region.classList.remove('hidden');
                            }else{
                                this.step=3;
                                sketch.garment_code=v;
                                garment_tracking_id = response.garment_tracking_id;
                                console.log('sketch.garment_code',v);
                                this.webcamEngine = true;
                            }

                        })
                })
        },
        activeModal(){
            this.step=1;
            modalOpen=true;
        },
        inActiveScanner(){
            modalOpen=false;
            this.scannerEngine.stop();
            this.$refs.scan_region.classList.add('hidden');
        },
        defectSend(){
            console.log({'information':information,'sketch':sketch});
            this.$wire.submitRejectItem({
                sketch: sketch,
                information: information,
                garment_tracking_id:garment_tracking_id,
            }).then(()=>{
                swal.fire({
                    timer: 1000,
                    icon: 'success',
                    title: 'Save Rejected',
                    text: 'Defect garment saved successfully.',
                    showConfirmButton:false
                }).then(()=>{
                    this.webcamEngine = false;
                    this.activeSketchEngine();
                });
             })
        },

    }"
@active-sketch-engine.window="activeSketchEngine()"
@active-scanner-engine.window="activeScannerEngine(event.detail)"
@active-webcam-engine.window="activeWebcamEngine(event.detail)"
>


    <ul class="w-full steps">
        <li class="step" :class="{'step-neutral':step>=1}">Locate Defect</li>
        <li class="step" :class="{'step-neutral':step>=2}">Scan Code</li>
        <li class="step" :class="{'step-neutral':step>=3}">Take Defect Photo</li>
    </ul>

    <div x-show="step===1">
        <svg x-ref="svg" id="apparelSvg" class="object-cover h-auto"></svg>
    </div>

    <div x-show="step===2">
        <x-webcam.scanner></x-webcam.scanner>
    </div>

    <div x-show="step===3">

        <x-webcam.photo-taken-component :auto-capture="true">
            <x-slot name="id"> Photo Defect</x-slot>
            <x-slot name="imageCallback"> image-file</x-slot>
            <x-slot name="other">
                <input type="hidden" x-model="swicthOn" x-modelable="webcamEngine">
                <input type="hidden" x-model="imageData" x-modelable="image">
            </x-slot>
        </x-webcam.photo-taken-component>
        <x-general.upload.simple-image
                :alpine-receive-var="'image'"
                :alpine-expose-var="'sketch.defect_photo'">
        </x-general.upload.simple-image>

        <div class="w-full">
            <label for="" class="font-semibold label">defect</label>
            <x-form.sync.auto-complete>
                <input type="hidden" x-modelable="selected" x-model="sketch.defect" />
                <input type="hidden" x-modelable="list" x-model="data.defects" />
            </x-form.sync.auto-complete>
        </div>

        <div class="w-full">
            <label for="" class="font-semibold label">Defect Cause</label>
            <x-form.sync.auto-complete>
                <input type="hidden" x-modelable="selected" x-model="sketch.defect_cause" />
                <input type="hidden" x-modelable="list" x-model="data.defect_causes" />
            </x-form.sync.auto-complete>
        </div>
    </div>

    <div class="sticky bottom-0 flex justify-center w-full gap-5 p-5">
        <button @click="defectSend()" class="btn btn-info">Save</button>
        <button @click="inActiveScanner()" class="btn btn-outline">Close</button>
    </div>


</div>

