<div>
    <h3>The <code>Index</code> livewire component is loaded from the <code>SchoolManagement</code> module.</h3>


    <div class="tabs">
        <a wire:click="navigatePage(1)" class="tab tab-lifted">Create</a>
        <a wire:click="navigatePage(2)" class="tab tab-lifted tab-active">Table</a>
        <a wire:click="navigatePage(3)" class="tab tab-lifted">Edit</a>
    </div>

    <div>
        @if($tab===1)<livewire:schoolmanagement::student.create wire:key="schoolmanagement::student.create" />@endif
        @if($tab===2)<livewire:schoolmanagement::student.datatable wire:key="schoolmanagement::student.datatable" />@endif
        @if($tab===3)<livewire:schoolmanagement::student.edit wire:key="schoolmanagement::student.edit" />@endif
    </div>





</div>
