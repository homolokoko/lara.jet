<x-guest-layout>
    <div class="px-12 py-7 rounded-xl shadow-lg">

        <div class="space-y-4">
            <h3 class="font-bold text-2xl">Country Catalog</h3>
            <livewire:countrycatalog::index wire:key="countrycatalog::index" />



{{--            <div x-data="{--}}
{{--                numbers:[],--}}
{{--                fontSize:120,--}}
{{--                downloadCanvas(number) {--}}
{{--                    const canvas = this.$refs.a_tag+_.toString(number);--}}
{{--                    const link = document.createElement('a');--}}
{{--                    link.download = `number-${number}.jpg`;--}}
{{--                    link.href = canvas.toDataURL('image/jpg');--}}
{{--                    link.click();--}}
{{--                },--}}
{{--                download(){--}}
{{--                    _.each(_.range(0,1000),(number)=>{ this.drawNumber(number)})--}}
{{--                },--}}
{{--                drawNumber(number) {--}}
{{--                    const canvas = this.$refs.a_tag+_.toString(number);--}}
{{--                    const ctx = canvas.getContext('2d');--}}

{{--                    // Set canvas dimensions--}}
{{--                    canvas.width = canvas.offsetWidth;--}}
{{--                    canvas.height = canvas.offsetHeight;--}}

{{--                    // Clear canvas--}}
{{--                    ctx.fillStyle = this.selectedBgColor;--}}
{{--                    ctx.fillRect(0, 0, canvas.width, canvas.height);--}}

{{--                    // Draw the number--}}
{{--                    ctx.fillStyle = this.selectedColor;--}}
{{--                    ctx.font = `bold ${this.fontSize}px Arial`;--}}
{{--                    ctx.textAlign = 'center';--}}
{{--                    ctx.textBaseline = 'middle';--}}

{{--                    ctx.fillText(--}}
{{--                        this.number.toString(),--}}
{{--                        canvas.width / 2,--}}
{{--                        canvas.height / 2--}}
{{--                    );--}}
{{--                },--}}
{{--                init(){--}}
{{--                    this.numbers = _.range(0,1000);--}}
{{--                    console.log('numbers',this.numbers);--}}
{{--                }--}}
{{--            }" class="grid grid-cols-6 gap-4 w-full">--}}
{{--                <button class="btn" @click="download">Download</button>--}}
{{--                <template x-for="number in numbers">--}}
{{--                    <canvas x-ref="a_tag+_.toString(number)"></canvas>--}}
{{--                </template>--}}
{{--            </div>--}}


        </div>

    </div>
</x-guest-layout>
