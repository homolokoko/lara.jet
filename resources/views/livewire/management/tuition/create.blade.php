<div wire:ignore>

    <div x-data="{
        desc:'',
        amount:0,
        duration:1,
        info:{
            off:0,
            course:'',
            mentor:'',
            student:'',
            phonenumber:'',
        },
        list:[],
        data:{
            courses:[],
            mentors:[],
            students:[],
        },
        addItem(){
            this.list.push({
                editing:true,
                desc: this.desc,
                amount: _.toInteger(this.amount),
                duration: _.toInteger(this.duration)
            });
            this.item = {desc:'',duration:1,amount:0,editing:true};
        },
        deleteItem(index){
            _.pullAt(this.list, index);
        },
        get calculated(){
            let amounts = _.map(this.list,item=>item.amount*item.duration);
            let finalPrice = _.sum(amounts)*(1-_.toInteger(this.info.off)*0.01);
            return {
                originalPrice: _.sum(amounts),
                usdCurrency: finalPrice,
                rielCurrency: finalPrice*4052
            };
        },
        get display(){
            let course = null;
            let mentor = null;
            let student = null;
            if(this.info.course)
                course = _.find(this.data.courses,item=>item.value===_.toInteger(this.info.course));
            if(this.info.mentor)
                mentor = _.find(this.data.mentors,item=>item.value===_.toInteger(this.info.mentor));
            if(this.info.student)
                student =  _.find(this.data.students,item=>item.value===_.toInteger(this.info.student));
            return {course:course,mentor:mentor,student:student};
        },
        async pullData(){
            await this.$wire.pullData()
                .then(response=>this.data=response);
        },
        async saveItems(){
            await this.$wire.saveItems(this.info,this.list)
                .then(()=>{
                    swal.fire({
                        icon: 'success',
                        title: 'Success',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    }).then(()=>{
                        this.info.student = null;
                        this.info.phonenumber = null;
                        this.$dispatch('refresh-tuition-info-table');
                    })
                })
        },
    }" x-init="pullData">
        <div class="space-y-5">

            <table class="table table-zebra table-compact">
                <tbody>
                    <tr>
                        <td colspan="2">ID :</td>
                        <td><p x-text="display.student.label"></p></td>
                        <td>Level:</td>
                        <td><p x-text="display.course.text"></p></td>
                    </tr>
                    <tr>
                        <td colspan="2">Name :</td>
                        <td><p x-text="display.student.text"></p></td>
                        <td>Mentor :</td>
                        <td><p x-text="display.mentor.text"></p></td>
                    </tr>
                    <tr>
                        <td colspan="2">Select Student</td>
                        <td colspan="">Phone Number</td>
                        <td colspan="">Choose Mentor</td>
                        <td colspan="">Select Level</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <select x-model="info.student" class="select select-xs select-bordered w-full">
                                <option>-</option>
                                <template x-for="item in data.students" :key="item.value">
                                    <option :value="item.value" x-text="`${item.label} ${item.text}`"></option>
                                </template>
                            </select>
                        </td>
                        <td colspan="">
                            <input x-model="info.phonenumber" class="input input-xs input-bordered w-full" />
                        </td>
                        <td colspan="">
                            <select x-model="info.mentor" class="select select-xs select-bordered w-full">
                                <option>-</option>
                                <template x-for="item in data.mentors" :key="item.value">
                                    <option :value="item.value" x-text="`${item.label} ${item.text}`"></option>
                                </template>
                            </select>
                        </td>
                        <td colspan="">
                            <select x-model="info.course" class="select select-xs select-bordered w-full">
                                <option>-</option>
                                <template x-for="item in data.courses" :key="item.value">
                                    <option :value="item.value" x-text="item.text"></option>
                                </template>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="border">No.</th>
                        <th class="border">Descriptions</th>
                        <th class="border">Duration (months)</th>
                        <th class="border">Amount</th>
                        <th class="border">
                            <button @click="addItem()" class="btn btn-xs btn-outline btn-primary">Add</button>
                            <button @click="saveItems()" class="btn btn-xs btn-outline btn-success">Save</button>
                        </th>
                    </tr>
                    <template x-for="(elem, index) in list" :key="index">
                        <tr>
                            <td class="border"><p x-text="index+1"></p></td>
                            <td class="border">
                                <input x-model="elem.desc" :readonly="!elem.editing" type="text" :class="elem.editing ? 'input-success':'input-ghost'" class="input input-xs w-full">
                            </td>
                            <td class="border">
                                <select x-model="elem.duration" :disabled="!elem.editing" :class="elem.editing ? 'select-success':'select-ghost'" class="select select-xs w-full">
                                    <template x-for="i in 12" :key="i">
                                        <option :value="i" x-text="i" :selected="elem.duration==i"></option>
                                    </template>
                                </select>
                            </td>
                            <td class="border">
                                <input x-model="elem.amount" :readonly="!elem.editing" type="number" :class="elem.editing ? 'input-success':'input-ghost'" class="input input-xs w-full">
                            </td>
                            <td class="border">
                                <button @click="elem.editing=!elem.editing"
                                    x-text="!elem.editing ? 'Enable':'Disable'"
                                    :class="{
                                        'btn-ghost':elem.editing,
                                        'btn-warning':!elem.editing
                                    }" class="btn btn-xs btn-outline"></button>
                                <button @click="deleteItem(index)" class="btn btn-xs btn-outline btn-error">Delete</button>
                            </td>
                        </tr>
                    </template>
                    <tr>
                        <td colspan="3" rowspan="5" class="border"></td>
                        <td class="border">Total</td>
                        <td class="border"><p x-text="`$ ${calculated.originalPrice}`"></p></td>
                    </tr>
                    <tr>
                        <td class="border">Discount</td>
                        <td class="border">%<input x-model="info.off" class="input input-ghost select-xs" /></td>
                    </tr>
                    <tr>
                        <td class="border">Paid</td>
                        <td class="border"><p x-text="`$ ${calculated.usdCurrency}`"></p></td>
                    </tr>
                    <tr>
                        <td class="border">Riel</td>
                        <td class="border"><p x-text="`៛ ${calculated.rielCurrency}`"></p></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
