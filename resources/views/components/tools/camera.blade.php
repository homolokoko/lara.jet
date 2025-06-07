<div x-data="{
    cameraActive:false,
    init(){
        $watch('cameraActive',(active)=>{ active ? startCamera():stopCamera(); })
    }
}">
    <video x-ref="camera" src=""></video>
</div>
