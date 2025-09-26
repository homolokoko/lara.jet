-- Active: 1758253314220@@localhost@33060@lara.jet
<x-app-layout>


    <h3 class="text-lg font-bold"> Management Style </h3>

    <div wire:ignore class="p-12">
        <div class="space-y-4 rounded-lg shadow-lg p-7">
            <livewire:management.style.table wire:key="management.style.table"></livewire:management.style.table>
        </div>
    </div>

</x-app-layout>
