<div x-data="{
    mode:'',
    param:'',
    date:'',
    active(v){
        Flatpickr(this.$refs.flatpickr,
            {
                mode: v,
                altInput: true,
                allowInput: true,
                maxDate: 'today',
                onClose: (selectedDates, dateStr, instance) => {
                    this.param = {mode:v,value:dateStr};
                }
            })
    },
    init(){
        this.active('single');
        $watch('mode',v=>this.active(v));
    }
}" class="flex space-x-3">
    <input x-ref="flatpickr" class="w-full input hover:bg-gray-300 hover:bg-opacity-50"
        readonly placeholder="Select Date.." />
    <select x-model="mode" class="select hover:bg-gray-300 hover:bg-opacity-50">
        <option value="single" selected>Single</option>
        <!-- <option value="multiple">Multiple</option> -->
        <option value="range">Range</option>
    </select>{{ @$slot }}
</div>
