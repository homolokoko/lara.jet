<div>
    <div x-data="{
        code: '',
        filter:{
            line:{},
            size:{},
            color:{},
            purchase_order:{},
            style:@entangle('style'),
            version:@entangle('version'),
        },
        data:{
            lines:@entangle('lines'),
            sizes:@entangle('sizes'),
            colors:@entangle('colors'),
            styles:@entangle('styles'),
            versions:@entangle('versions'),
            purchase_orders:@entangle('purchase_orders'),
        },
        submitPass(){
            this.$wire.submitPass(this.filter,this.code)
                .then(()=>{
                    swal.fire({
                        timer: 1500,
                        icon: 'success',
                        timerProgressBar: true,
                        showConfirmButton:false,
                    });
                });
        },
        submitReject(){
            this.$wire.submitReject(this.filter,this.code)
                .then(()=>{
                    swal.fire({
                        timer: 1500,
                        icon: 'error',
                        timerProgressBar: true,
                        showConfirmButton:false,
                    });
                });
        },
    }" class="p-5 space-y-4 border rounded-lg">

        <div class="space-y-3">
            <label for="" class="block">Line</label>
            <x-radio-button>
                <input x-model="filter.line" x-modelable="param" hidden />
                <input x-model="data.lines" x-modelable="list" hidden />
            </x-radio-button>
        </div>
        <div class="space-y-3">
            <label for="" class="block">Style</label>
            <x-fuse-select>
                <input x-model="filter.style" x-modelable="param" hidden />
                <input x-model="data.styles" x-modelable="list" hidden />
            </x-fuse-select>
        </div>
        <div class="space-y-3">
            <label for="" class="block">Purchase Order</label>
            <x-radio-button>
                <input x-model="filter.purchase_order" x-modelable="param" hidden />
                <input x-model="data.purchase_orders" x-modelable="list" hidden />
            </x-radio-button>
        </div>
        <div class="space-y-3">
            <label for="" class="block">Version</label>
            <x-radio-button>
                <input x-model="filter.version" x-modelable="param" hidden />
                <input x-model="data.versions" x-modelable="list" hidden />
            </x-radio-button>
        </div>
        <div class="space-y-3">
            <label for="" class="block">Color</label>
            <x-radio-button>
                <input x-model="filter.color" x-modelable="param" hidden />
                <input x-model="data.colors" x-modelable="list" hidden />
            </x-radio-button>
        </div>
        <div class="space-y-3">
            <label for="" class="block">Size</label>
            <x-radio-button>
                <input x-model="filter.size" x-modelable="param" hidden />
                <input x-model="data.sizes" x-modelable="list" hidden />
            </x-radio-button>
        </div>

        <div x-show="!code" class="space-y-3">
            <x-tools.scanner>
                <x-slot name="trigger">
                    <button class="btn btn-primary">open scanner</button>
                </x-slot>
                <input x-model="code" x-modelable="output" hidden />
            </x-tools.scanner>

        </div>
        <div x-show="code">
            <button @click="submitPass()" class="btn btn-success">pass</button>
            <button @click="submitReject()" class="btn btn-error">reject</button>
        </div>
    </div>
</div>
