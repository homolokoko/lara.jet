<div
    x-data="{ fullscreenModal: false }"
    @keydown.escape="fullscreenModal=false">
    {{ @$trigger  }}

    <div
        x-show="fullscreenModal"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-10 w-screen h-screen bg-white">
        <div class="flex justify-between p-5 items-center w-full border-b">
            <h3 class="text-xl font-bold tracking-wide">{{@$title}}</h3>
            <button @click="fullscreenModal=false" class="btn btn-outline">
                <x-heroicon-o-x class="w-5 h-5" /> close
            </button>
        </div>
        <div class="relative w-auto p-5">{{@$content}}</div>


    </div>

</div>
