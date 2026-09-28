<x-app-layout>

    <x-slot name="title">Management Staff</x-slot>

    <div wire:ignore x-data="{
        tab:0
    }" @edit-usr-info.window="tab=2" class="p-12">
        <div class="tabs tabs-boxed">
            <a @click="tab=0" :class="{'tab-active':tab===0}" class="tab">Table</a>
            <a @click="tab=1" :class="{'tab-active':tab===1}" class="tab">Create</a>
            <a :class="{'tab-active':tab===2}" class="tab">Edit</a>
        </div>
        <div x-show="tab===0" class="space-y-4 rounded-lg shadow-lg p-7">
            <livewire:management.staff.table wire:key="management.staff.table"></livewire:management.staff.table>
        </div>
        <div x-show="tab===1" class="space-y-4 rounded-lg shadow-lg p-7">
            <livewire:management.staff.create wire:key="management.staff.create"></livewire:management.staff.create>
        </div>
        <div x-show="tab===2" class="space-y-4 rounded-lg shadow-lg p-7">
            <livewire:management.staff.edit wire:key="management.staff.edit"></livewire:management.staff.edit>
        </div>
    </div>

</x-app-layout>
