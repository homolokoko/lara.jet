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
        find_str:'',
        defects:[],
        get findArr(){
            return this.defects.filter(
                i => i.name.toLowerCase().includes(this.find_str.toLowerCase())
            )
        },
        submit(){
            this.$wire.submit(this.defects)
        },
        init(){
            this.$wire.search(this.filter)
                .then((response)=>{ this.defects = response;console.log('response',response); })
        }
    }">

        <div class="p-5 border rounded-lg space-y-3">

{{--            <div class="grid gap-3 md:grid-cols-2">--}}

{{--                <x-popup-single-select>--}}
{{--                    <x-slot name="title">--}}
{{--                        {{ __('Style') }}--}}
{{--                    </x-slot>--}}
{{--                    <x-slot name="other">--}}
{{--                        <input x-model="filter.style" x-modelable="param" hidden />--}}
{{--                        <input x-model="resource.styles" x-modelable="list" hidden />--}}
{{--                    </x-slot>--}}
{{--                </x-popup-single-select>--}}

{{--                <x-popup-single-select>--}}
{{--                    <x-slot name="title">--}}
{{--                        {{ __('Color') }}--}}
{{--                    </x-slot>--}}
{{--                    <x-slot name="other">--}}
{{--                        <input x-model="filter.color" x-modelable="param" hidden />--}}
{{--                        <input x-model="resource.colors" x-modelable="list" hidden />--}}
{{--                    </x-slot>--}}
{{--                </x-popup-single-select>--}}

{{--                <x-popup-single-select>--}}
{{--                    <x-slot name="title">--}}
{{--                        {{ __('Buyer') }}--}}
{{--                    </x-slot>--}}
{{--                    <x-slot name="other">--}}
{{--                        <input x-model="filter.buyer" x-modelable="param" hidden />--}}
{{--                        <input x-model="resource.buyers" x-modelable="list" hidden />--}}
{{--                    </x-slot>--}}
{{--                </x-popup-single-select>--}}

{{--                <x-popup-single-select>--}}
{{--                    <x-slot name="title">--}}
{{--                        {{ __('Purchase Order') }}--}}
{{--                    </x-slot>--}}
{{--                    <x-slot name="other">--}}
{{--                        <input x-model="filter.purchase_order" x-modelable="param" hidden />--}}
{{--                        <input x-model="resource.purchase_orders" x-modelable="list" hidden />--}}
{{--                    </x-slot>--}}
{{--                </x-popup-single-select>--}}

{{--                <x-popup-single-select>--}}
{{--                    <x-slot name="title">--}}
{{--                        {{ __('Location') }}--}}
{{--                    </x-slot>--}}
{{--                    <x-slot name="other">--}}
{{--                        <input x-model="filter.workstation_locate" x-modelable="param" hidden />--}}
{{--                        <input x-model="resource.workstation_locates" x-modelable="list" hidden />--}}
{{--                    </x-slot>--}}
{{--                </x-popup-single-select>--}}

{{--                <x-flatpickr></x-flatpickr>--}}

{{--            </div>--}}

            <div x-show="defects.length > 0" class="">
                <input type="text" x-model="find_str" class="input rounded-none w-full input-ghost input-bordered" placeholder="search........." />
                <template x-for="(item, i) in findArr" :key="item.id">
                    <div class="px-3 py-1 border flex flex-col gap-3 hover:bg-gray-200">
{{--                        <input class="checkbox checkbox-lg" type="checkbox" :value="item.value" x-model="item.is_not_defect">--}}
                        <div class="text-xs breadcrumbs">
                            <ul>
                                <template x-for="(path, j) in item.ancestors" :key="path.id">
                                    <li><span x-text="path.name"></span></li>
                                </template>
                            </ul>
                        </div><span class="text-sm" x-text="`${item.id}-${item.name}`"></span>
                    </div>
                </template>
                <button @click="submit()" class="btn btn-primary btn-md rounded-none">submit</button>
            </div>


{{--        <button @click="search()" class="btn btn-success w-full">search</button>--}}

        </div>
    </div>
</div>
