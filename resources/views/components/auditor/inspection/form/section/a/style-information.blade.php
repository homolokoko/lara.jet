<div>
    <!-- Well begun is half done. - Aristotle -->
    <div wire:ignore class="flex flex-col flex-wrap p-2 space-y-2" id="styleInformation" x-data="{
        data: {
            production_desc: '',
            purchase_order_id: '',
            destination_country: '',
            destination_city:''
        },
        submit() {
            let data;
            data = {
                production_desc: this.data.production_desc,
                destination_city: this.data.destination_city,
                purchase_order_id: this.data.purchase_order_id.value,
                destination_country: this.data.destination_country.value
            };
            $wire.submit(data);
            $dispatch('update-flag',{section:'A.AA',completed:true} )
        },
        error: {
            show: false,
            message: []
        },
        validate() {
            const requiredFields = [];
            const message = {
                production_desc: 'Required product description, ត្រូវការប្រភេទរបាយការណ៍',
                purchase_order_id: 'required purchase order id, ត្រូវការប្រភេទរបាយការណ៍',
                destination_country: 'Required Destination Country, ប្រទេសគោលដៅដែលត្រូវការ ',
            };
            Object.keys(this.data).forEach((key, value) => {
                console.log('validate key', this.data[key], value, message[key])
                if (!this.data[key] && !key.includes('report') && !key.includes('version')) {
                    requiredFields.push(message[key]);
                }
            });
            this.error.show = requiredFields.length > 0;
            this.error.message = requiredFields;
        },
        item: [
            'Men’s Workout Clothing', 'Men’s T shirts', 'Summer Dresses', 'Sleepwear',
            'Shoes', 'Suits', 'Swimsuits', 'Evening Dresses', 'Jackets and Sweaters'
        ],
        init() {
            this.data.production_desc = this.item[this.item.length * Math.random() | 0];
            $watch('data', (v) => {
                this.validate();
                console.log('watch', v);
                if(v.style_id){
                    $wire.getPurchaseOrder(v.style_id.value);
                }
            });
        }
    }"
         @update-header-id.window="data.header_id = event.detail"
         @update-purchase-order-section-a.window="data.purchase_order_id = event.detail.value;console.log(event.detail)"
         @update-country-component.window=" data.destination_country = event.detail.value;console.log(event.detail)">

        <div x-data="{
            style_id: '',
            init(){
                $watch('style_id',(v)=>{
                    setTimeout(()=>{
                        $wire.addedStyleOrderNo(v);
                        console.log(v);
                    }, 1500);
                })
            }
        }">

            <x-configure.style.order-style-field :url="route('search-ezi-style-order-no')"
                                                 :minKeywordLength="2">
                <x-slot name="noResultMessage">
                    This is not available in the Apparel Ezi System. មិនមាននៅក្នុង System Apparel Ezi.
                </x-slot>
                <x-slot name="itemHTML">
                    <div class="flex justify-between">
                        <span x-text="item.name"></span>
                    </div>
                </x-slot>
                <x-slot name="other">
                    <input type="hidden" x-model="finalResult" x-modelable="style_id">
                </x-slot>
            </x-configure.style.order-style-field>

        </div>


        {{--        <x-general.input.slim-select-auto-complete @update-style-section-a-list.window=" dataList = event.detail">--}}
        {{--            <x-slot name="label"> Style </x-slot>--}}
        {{--            <x-slot name="id"> buyer</x-slot>--}}
        {{--            <x-slot name="other">--}}
        {{--                <input type="hidden" x-model="selected" x-modelable="data.style_id">--}}
        {{--            </x-slot>--}}
        {{--        </x-general.input.slim-select-auto-complete>--}}


        <x-general.input.slim-select-auto-complete @update-purchase-order-section-a-list.window="dataList = $event.detail" >
            <x-slot name="label"> Purchase Order </x-slot>
            <x-slot name="id"> purchase_order</x-slot>
            <x-slot name="other">
                <input type="hidden" x-model="selected" x-modelable="data.purchase_order_id">
            </x-slot>
        </x-general.input.slim-select-auto-complete>

        <x-general.input.slim-input-text type="text" label="Production Description" x-model="data.production_desc" />

        <x-general.input.slim-select-auto-complete>
            <x-slot name="label">  Destination Country </x-slot>
            <x-slot name="id"> destination_country </x-slot>
            <x-slot name="other">
                <input type="hidden" x-model="selected" x-modelable="data.destination_country">
                <input type="hidden" x-modelable="dataList" x-model="QMS.country">
            </x-slot>
        </x-general.input.slim-select-auto-complete>

        <x-general.input.slim-input-text x-model="data.destination_city" label="Destination City" />

        <x-general.error-message></x-general.error-message>

        <x-jet-button class="p-2 bg-green-500 text-white " @click="submit"> Submit </x-jet-button>
    </div>

</div>
