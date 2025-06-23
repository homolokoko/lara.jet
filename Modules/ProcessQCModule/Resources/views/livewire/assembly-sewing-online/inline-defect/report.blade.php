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
        defects:[],
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

                <x-popup-single-select>
                    <x-slot name="title">
                        {{ __('Style') }}
                    </x-slot>
                    <x-slot name="other">
                        <input x-model="filter.style" x-modelable="param" hidden />
                        <input x-model="resource.styles" x-modelable="list" hidden />
                    </x-slot>
                </x-popup-single-select>

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

            <div x-data="{
                dropdown:false,
                list:[],
                param:{},
                find_str:'',
                get filterItems(){
                    return this.list.filter(
                        i => i.name.toLowerCase().includes(this.find_str.toLowerCase())
                    )
                }
            }">
                <button class="btn btn-ghost rounded-none border-2 capitalize"
                        x-text="_.isEmpty(param) ? 'Please choose':param.name"
                        @click="dropdown=true;$nextTick(()=>{$refs.find_str.focus()})"></button>
                <input type="hidden" x-model="defect" x-modelable="param" />
                <input type="hidden" x-model="defects" x-modelable="list" />
                <div x-show="dropdown" class="relative bg-white">
                    <input x-ref="find_str" type="text" x-model="find_str" class="input rounded-none w-full input-sm input-ghost input-bordered" placeholder="search........." />
                    <ul class="max-h-48 min-h-16 relative overflow-auto bg-white border absolute top-0 left-0 divide-y">
                        <template x-for="(item, i) in filterItems" :key="item.id">
                            <li class="hover:bg-gray-100">
                                <label @click="param=item" class="flex flex-col w-full px-3">
                                    <div class="text-xs breadcrumbs">
                                        <ul>
                                            <template x-for="(path, j) in item.ancestors" :key="path.id">
                                                <li><span x-text="path.name"></span></li>
                                            </template>
                                        </ul>
                                    </div>
                                    <span class="px-3" x-text="item.name"></span>
                                </label>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
{{--            <div x-show="defects.length > 0">--}}
{{--                <button @click="submit()" class="btn btn-primary btn-md rounded-none">submit</button>--}}
{{--            </div>--}}


{{--        <button @click="search()" class="btn btn-success w-full">search</button>--}}

        </div>
    </div>
</div>
