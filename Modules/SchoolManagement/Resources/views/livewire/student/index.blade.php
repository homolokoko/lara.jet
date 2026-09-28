<div class="space-y-7">

    <h3 class="text-xl font-semibold">
        Mangement Student Register / Modify their information
    </h3>

    <div class="tabs">
        <a wire:click="navigatePage(1)" class="tab tab-lifted {{$tab===1 ? 'tab-active':''}}">Create</a>
        <a wire:click="navigatePage(2)" class="tab tab-lifted {{$tab===2 ? 'tab-active':''}}">Table</a>
        <a wire:click="navigatePage(3)" class="tab tab-lifted {{$tab===3 ? 'tab-active':''}}">Edit</a>
    </div>

    <div>
        @if($tab===1)<livewire:schoolmanagement::student.create wire:key="schoolmanagement::student.create" />@endif
        @if($tab===2)<livewire:schoolmanagement::student.datatable wire:key="schoolmanagement::student.datatable" />@endif
        @if($tab===3)<livewire:schoolmanagement::student.edit wire:key="schoolmanagement::student.edit" />@endif
    </div>





</div>
