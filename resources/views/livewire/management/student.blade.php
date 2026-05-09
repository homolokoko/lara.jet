<div>

    <div id="create">
        <div x-data="{
            result:{
                kh_name:'',
                en_name:'',
                gender:'',
                dob:'',
                village:'',
                commune:'',
                district:'',
                proving:'',
                other:'',
                shift:'',
                class_room:'',
                mentor:''
            },
            data:{
                zips:[]
            },
            init(){
                this.$wire.load()
                    .then((response)=>{
                        this.data = response;
                    });
            }
        }">
            <label for="">Kh Name</label>
            <input type="text" class="input">
            <label for="">En Name</label>
            <input type="text" class="input">
            <label for="">Gender</label>
            <label for="">Dob</label>
            <x-flatpickr model="result.dob" />
            <label for="">Village</label>
            <input type="text" class="input">
            <label for="">Commune</label>
            <input type="text" class="input">
            <label for="">District</label>
            <input type="text" class="input">
            <label for="">Proving</label>
            <select x-model="result.proving" class="w-full select select-bordered">
                <option selected>Please Select Proving</option>
                <template x-for="(elem, index) in data.zips" :key="elem.value">
                    <option :value="elem.value" x-text="elem.text"></option>
                </template>
            </select>
            <label for="">Other</label>
            <input type="text" class="input">
            <label for="">Shift</label>
            <div>
                <div>
                    <label for="morning">07:30-10:30</label>
                    <input id="morning" type="radio" name="shift" id="">
                </div>
                <div>
                    <label for="afternoon">01:30-04:30</label>
                    <input id="afternoon" type="radio" name="shift" id="">
                </div>
                <div>
                    <label for="evening5">05:30-06:30</label>
                    <input id="evening5" type="radio" name="shift" id="">
                </div>
                <div>
                    <label for="evening6">06:30-07:30</label>
                    <input id="evening6" type="radio" name="shift" id="">
                </div>
            </div>
            <input type="text" class="input">
            <label for="">Class Room</label>
            <input type="text" class="input">
            <label for="">Mentor</label>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <td>Id</td>
                <td>Kh Name</td>
                <td>En Name</td>
                <td>Gender</td>
                <td>DoB</td>
                <td>PVillage</td>
                <td>PCommune</td>
                <td>PDistrict</td>
                <td>PProving</td>
                <td>Other</td>
                <td>Shift</td>
                <td>Class Room</td>
                <td>Mentor</td>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>

        </tfoot>
    </table>
</div>