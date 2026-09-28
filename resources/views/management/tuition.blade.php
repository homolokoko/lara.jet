<x-app-layout>
    <x-slot name="title">Tuition</x-slot>

    <div class="flex justify-center">

        <div x-data="{
            desc:'',
            amount:0,
            duration:1,
            discount:0,
            list:[],
            addItem(){
                this.list.push({
                    editing:false,
                    desc: this.desc,
                    amount: _.toInteger(this.amount),
                    duration: _.toInteger(this.duration)
                });
                this.item = {desc:'',duration:1,amount:0,editing:false};
            },
            deleteItem(index){
                _.pullAt(this.list, index);
            },
            get calculated(){
                let amounts = _.map(this.list,item=>item.amount*item.duration);
                let finalPrice = _.sum(amounts)*(1-_.toInteger(this.discount)*0.01);
                return {
                    originalPrice: _.sum(amounts),
                    usdCurrency: finalPrice,
                    rielCurrency: finalPrice*4052
                };
            },
            saveItems(){
                console.log('total',  );
                console.log('list :', this.list);
            }
        }">
            <div class="space-y-5">

                <table class="table table-zebra table-compact">
                    <thead>
                        <tr>
                            <th class="border">No.</th>
                            <th class="border">Descriptions</th>
                            <th class="border">Duration (months)</th>
                            <th class="border">Amount</th>
                            <th class="border">Action</th>
                        </tr>
                        <tr>
                            <td class="border"></td>
                            <td class="border"><input x-model="desc" type="text" class="input input-bordered w-full" /></td>
                            <td class="border">
                                <select x-model="duration" class="select select-bordered w-full">
                                    <template x-for="i in 12" :key="i">
                                        <option :value="i" x-text="i"></option>
                                    </template>
                                </select>
                            </td>
                            <td class="border"><input x-model="amount" type="number" class="input input-bordered w-full" /></td>
                            <td class="border">
                                <button @click="addItem()" class="btn btn-outline btn-info">Add</button>
                                <button @click="saveItems()" class="btn btn-outline btn-success">Save</button>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(elem, index) in list" :key="index">
                            <tr>
                                <td class="border"><p x-text="index+1"></p></td>
                                <td class="border">
                                    <input x-model="elem.desc" :readonly="!elem.editing" type="text" :class="elem.editing ? 'input-success':'input-ghost'" class="input w-full">
                                </td>
                                <td class="border">
                                    <select x-model="elem.duration" :disabled="!elem.editing" :class="elem.editing ? 'select-success':'select-ghost'" class="select w-full">
                                        <template x-for="i in 12" :key="i">
                                            <option :value="i" x-text="i" :selected="elem.duration==i"></option>
                                        </template>
                                    </select>
                                </td>
                                <td class="border">
                                    <input x-model="elem.amount" :readonly="!elem.editing" type="number" :class="elem.editing ? 'input-success':'input-ghost'" class="input w-full">
                                </td>
                                <td class="border">
                                    <button @click="elem.editing=!elem.editing" class="btn btn-outline btn-warning">Edit</button>
                                    <button @click="deleteItem(index)" class="btn btn-outline btn-error">Delete</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" rowspan="4" class="border"></td>
                            <td class="border">Total</td>
                            <td class="border"><p x-text="`$ ${calculated.originalPrice}`"></p></td>
                        </tr>
                        <tr>
                            <td class="border">Discount</td>
                            <td>%<input x-model="discount" class="input input-ghost select-xs" /></td>
                        </tr>
                        <tr>
                            <td class="border">Paid</td>
                            <td class="border"><p x-text="`$ ${calculated.usdCurrency}`"></p></td>
                        </tr>
                        <tr>
                            <td class="border">Riel</td>
                            <td class="border"><p x-text="`៛ ${calculated.rielCurrency}`"></p></td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>

    </div>

</x-app-layout>
