<div x-data>

    <div x-data="{
        webcam:null,
        assignWebcam(){
            this.webcam = new Webcam(
                 this.webcamElement,
                 'user',
                 this.canvasElement,
                 this.snapSoundElement
            );
        },
        startWebcam(){
            this.assignWebcam();
            this.webcam.start()
               .then(result =>{
                    console.log('webcam started');
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }" class="" >
        <video x-ref="webcamElement"></video>
        <canvas x-ref="canvasElement" class="d-none"></canvas>
        <audio x-ref="snapSoundElement" src="audio/snap.wav" preload = "auto"></audio>
        <button @click="startWebcam()" class="btn btn-primary"> Start Webcam </button>
    </div>

</div>
