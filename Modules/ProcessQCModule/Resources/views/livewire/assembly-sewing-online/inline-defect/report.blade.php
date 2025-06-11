<div>
    <div x-data="{
        filter:{
            style:@entangle('style'),
            color:@entangle('color'),
            buyer:@entangle('buyer'),
            purchase_order:@entangle('purchase_order'),
            workstation_locate:@entangle('workstation_locate'),
        },
        resource:{
            styles:@entangle('styles'),
            colors:@entangle('colors'),
            buyers:@entangle('buyers'),
            purchase_orders:@entangle('purchase_orders'),
            workstation_locates:@entangle('workstation_locates'),
        },
        search(){
            this.$wire.search(this.filter)
        },
    }">

        <div class="p-5 border rounded-lg space-y-3">

            <div class="grid gap-3 md:grid-cols-2">

                <x-popup-single-select>
                    <x-slot name="title">
                        {{ __('Style') }}
                    </x-slot>
                    <x-slot name="other">
                        <input x-model="filter.style" x-modelable="param" hidden />
                        <input x-model="resource.styles" x-modelable="list" hidden />
                    </x-slot>
                </x-popup-single-select>

                <x-popup-single-select>
                    <x-slot name="title">
                        {{ __('Color') }}
                    </x-slot>
                    <x-slot name="other">
                        <input x-model="filter.color" x-modelable="param" hidden />
                        <input x-model="resource.colors" x-modelable="list" hidden />
                    </x-slot>
                </x-popup-single-select>

                <x-popup-single-select>
                    <x-slot name="title">
                        {{ __('Buyer') }}
                    </x-slot>
                    <x-slot name="other">
                        <input x-model="filter.buyer" x-modelable="param" hidden />
                        <input x-model="resource.buyers" x-modelable="list" hidden />
                    </x-slot>
                </x-popup-single-select>

                <x-popup-single-select>
                    <x-slot name="title">
                        {{ __('Purchase Order') }}
                    </x-slot>
                    <x-slot name="other">
                        <input x-model="filter.purchase_order" x-modelable="param" hidden />
                        <input x-model="resource.purchase_orders" x-modelable="list" hidden />
                    </x-slot>
                </x-popup-single-select>

                <x-popup-single-select>
                    <x-slot name="title">
                        {{ __('Location') }}
                    </x-slot>
                    <x-slot name="other">
                        <input x-model="filter.workstation_locate" x-modelable="param" hidden />
                        <input x-model="resource.workstation_locates" x-modelable="list" hidden />
                    </x-slot>
                </x-popup-single-select>

            </div>


        <button @click="search()" class="btn btn-success w-full">search</button>

        </div>
    </div>
</div>
