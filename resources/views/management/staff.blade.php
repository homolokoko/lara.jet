<x-app-layout>

    <x-slot name="title">Management Staff</x-slot>

    <div wire:ignore class="p-12">
        <div class="space-y-4 rounded-lg shadow-lg p-7">
            <livewire:management.staff.create wire:key="management.staff.create"></livewire:management.staff.create>
        </div>
    </div>

</x-app-layout>
