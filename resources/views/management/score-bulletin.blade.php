<x-app-layout>
    <x-slot name="title">
        <span class="uppercase">Bullet Mark</span>
    </x-slot>

    <div x-data="{tab:2}"
        @display-bullet-mark-detail.window="tab=3"
        @display-bullet-mark-modify.window="tab=4"
        class="flex justify-center">
        <div class="inline-block">
            <div class="tabs tabs-boxed">
                <div @click="tab=1" :class="{'tab-active':tab===1}" class="tab">Create</div>
                <div @click="tab=2" :class="{'tab-active':tab===2}" class="tab">Data Table</div>
                <div class="tab" :class="{'tab-active':tab===3}">View Detail</div>
                <div class="tab" :class="{'tab-active':tab===4}">Modify Mark</div>
            </div>
            <div x-show="tab===1" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100">
                <livewire:management.score-bulletin.create :key="`management.score-bulletin.create`" />
            </div>
            <div x-show="tab===2" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100">
                <livewire:management.score-bulletin.datatable :key="`management.score-bulletin.datatable`" />
            </div>
            <div x-show="tab===3" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100">
                <livewire:management.score-bulletin.view :key="`management.score-bulletin.view`" />
            </div>
            <div x-show="tab===4" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100">
                <livewire:management.score-bulletin.modify :key="`management.score-bulletin.modify`" />
            </div>
        </div>
    </div>

</x-app-layout>
