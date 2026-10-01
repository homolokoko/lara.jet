<x-app-layout>
    <x-slot name="title">Score Bulletin</x-slot>

    <div x-data="{ tab:2 }" class="flex justify-center">
        <div class="inline-block">
            <div class="tabs tabs-boxed">
                <div @click="tab=1" :class="{'tab-active':tab===1}" class="tab">Create</div>
                <div @click="tab=2" :class="{'tab-active':tab===2}" class="tab">Data Table</div>
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
        </div>
    </div>

</x-app-layout>
