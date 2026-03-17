@props(['other','url','noResultMessage','minKeywordLength','itemHTML','create'=>false])

<div {{ $attributes->class(['flex flex-0 w-full relative']) }} {{ $attributes ?? '' }}>
    <div class="flex items-center px-4 bg-gray-300 border rounded-l">
        <span class="p-2 font-extrabold align-middle md:text-lg sm:text-sm xs:text-xs">
            Style / Order No.
        </span>
    </div>

    <div class="flex flex-col flex-1 relative"
         x-data="{
                finalResult: '',
                autoCompleteOpen: false,
                getDisplayText() {
                    return (!this.finalResult) ? 'Please choose' : this.finalResult.name;
                }
            }" @click.away="autoCompleteOpen = false">

        {{ $other ?? '' }}
        <x-general.input.auto-complete.search-dropdown
            :url="$url"
            :minKeywordLength="$minKeywordLength"
            :noResultMessage="$noResultMessage" :create="$create">
            <x-slot name="itemHTML"> {!! $itemHTML ?? '<span x-text="item.name"></span>' !!} </x-slot>
            <x-slot name="other">
                <input type="hidden" x-model="selected" x-modelable="finalResult">
                <input type="hidden" x-model="componentOpen" x-modelable="autoCompleteOpen">
                <input type="hidden" x-model="results" x-modelable="dataList">
            </x-slot>
        </x-general.input.auto-complete.search-dropdown>

        <x-general.input.auto-complete.toggle-button/>
    </div>
</div>
