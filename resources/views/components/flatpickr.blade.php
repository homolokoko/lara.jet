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
    <input x-ref="flatpickr" type="text" readonly class="input input-bordered" />
</div>
