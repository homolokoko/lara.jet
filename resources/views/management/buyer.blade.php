<x-app-layout>


    <h3> Setup Buyer </h3>

    <div wire:ignore class="p-12">
        <div class="rounded-lg shadow-lg p-7 space-y-4">
            <livewire:setup.buyer.create wire:key="setup.buyer.create"></livewire:setup.buyer.create>
            <livewire:setup.buyer.table wire:key="setup.buyer.table"></livewire:setup.buyer.table>
        </div>
    </div>

</x-app-layout>
