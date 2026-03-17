<div x-data="{
    param:'',
    init(){
        Flatpickr(this.$refs.flatpickr, {
            onClose: (selectedDates, dateStr, instance)=>{
                this.param = dateStr;
                // console.log('dateStr', dateStr);
                // console.log('instance', instance);
                // console.log('selectedDates', selectedDates);
            }
        })
    }
}" class="w-full">
    {{ @$slot }}
    <input type="hidden" x-model="{{@$model}}" x-modelable="param">
    <input x-ref="flatpickr" :value="param" type="text" readonly class="w-full input input-bordered" />
</div>
