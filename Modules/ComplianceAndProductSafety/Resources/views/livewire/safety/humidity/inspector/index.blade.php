<div>

    <div x-data="{
            filter:{
                time:{},
                style:{},
                location:{},
                humidity:'',
                temperature:'',
            },
            data:{
                styles:@entangle('styles'),
                locations:@entangle('locations'),
                time_periods:@entangle('time_periods'),
            },
            clearFilter(){
                this.filter = {
                    time:{},
                    style:{},
                    location:{},
                    humidity:'',
                    temperature:'',
                }
            },
            submit(){
                this.$wire.submit(this.filter)
                    .then(()=>{
                        swal.fire({
                            timer: 1500,
                            icon: 'success',
                            title: 'Completed!',
                            timerProgressBar: true,
                            showConfirmButton: false,
                        }).then(()=>{ this.clearFilter(); });
                    })
            }
        }"
        class="flex flex-col space-y-4">

        <div>
            <label class="block label">Time Period</label>
            <x-radio-button>
                <input x-modelable="param" x-model="filter.time" hidden>
                <input x-modelable="list" x-model="data.time_periods" hidden>
            </x-radio-button>
        </div>

        <div>
            <label class="block label">IA Number</label>
            <x-fuse-select>
                <input x-modelable="param" x-model="filter.style" hidden>
                <input x-modelable="list" x-model="data.styles" hidden>
            </x-fuse-select>
        </div>

        <div>
            <label class="block label">Location</label>
            <x-radio-button>
                <input x-modelable="param" x-model="filter.location" hidden>
                <input x-modelable="list" x-model="data.locations" hidden>
            </x-radio-button>
        </div>

        <div class="">
            <label class="block label">Temperature</label>
            <label class="input-group">
                <span>℃</span>
                <input type="number" x-model="filter.temperature" class="w-full input input-bordered">
            </label>
        </div>

        <div class="">
            <label class="block label">Humidity</label>
            <label class="input-group">
                <span>%</span>
                <input type="number" x-model="filter.humidity" class="w-full input input-bordered">
            </label>
        </div>

        <div class="">
            <button @click="submit()" class="w-full btn btn-primary">Save</button>
        </div>

    </div>

</div>
