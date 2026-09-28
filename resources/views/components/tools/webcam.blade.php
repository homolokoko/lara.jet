<div x-data="{
    picture:'',
    imageSource:'',
    webcamActive:false,
    webcamEngine:'',
    deActivateWebcam(){
        this.webcamEngine.stop();
        this.webcamEngine = '';
        this.$refs.webcamContainer.classList.add('hidden');
    },
    activateWebcam(){
        this.webcamEngine = new Webcam(
            this.$refs.webcam,
            'environment',
            this.$refs.canvas,
            this.$refs.audio,
        );
    },
    openWebcam(){
        this.activateWebcam();
        this.webcamEngine.start();
        this.$refs.webcamContainer.classList.remove('hidden');
    },
    reload(){
        this.picture = '',
        this.openWebcam();
    },
    takePicture(){
        this.imageSource = this.webcamEngine.snap();
        this.webcamEngine.stop();
    },
    submitPicture(){
        this.deActivateWebcam();
        this.picture = this.imageSource;
        this.imageSource = '';
    },
    init(){ this.$watch('webcamActive',(active) => { active ? this.openWebcam() : this.deActivateWebcam() } ) }
}">
    {{ @$slot }}
    <div x-ref="webcamContainer" class="fixed top-0 left-0 z-10 hidden w-screen h-screen p-5 bg-gray-700 bg-opacity-50">
        <div class="relative flex flex-col w-full h-full overflow-hidden">
            <div class="relative">
                <audio x-ref="audio" class="hidden"></audio>
                <canvas x-ref="canvas" class="hidden"></canvas>
                <video x-ref=webcam class="w-full h-full rounded-3xl" autoplay playsinline></video>
                <div class="absolute top-5 right-5">
                    <button class="btn btn-circle btn-sm btn-ghost backdrop-blur-sm"><x-heroicon-o-x  class="w-6 h-6" /></button>
                </div>
                <div class="absolute flex items-center justify-center w-full gap-10 p-5 bottom-3">
                    <button x-show="imageSource" @click="reload()" class="btn btn-circle btn-lg btn-outline backdrop-blur-sm""><x-heroicon-o-refresh class="w-12 h-12" /></button>
                    <button @click="takePicture()" class="btn btn-circle btn-lg btn-outline backdrop-blur-sm""><x-heroicon-o-camera class="w-12 h-12" /></button>
                    <button x-show="imageSource" @click="submitPicture()" class="btn btn-circle btn-lg btn-outline backdrop-blur-sm""><x-heroicon-o-check class="w-12 h-12" /></button>
                </div>
            </div>
        </div>
    </div>

</div>
