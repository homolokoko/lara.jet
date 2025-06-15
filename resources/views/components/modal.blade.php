<div x-data="{ modalOpen: false }"
    @keydown.escape.window="modalOpen = false"
    class="relative z-50 w-auto h-auto">
    <div>{{@$trigger}}</div>
    <div x-show="modalOpen" class="fixed top-0 left-0 z-10 flex items-center justify-center w-screen h-screen" x-cloak>
            <div x-show="modalOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="modalOpen=false" class="absolute inset-0 w-full h-full bg-black bg-opacity-25"></div>
            <div x-show="modalOpen"
                x-trap.inert.noscroll="modalOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative w-full py-6 bg-white px-7 sm:max-w-lg sm:rounded-lg">
                <div class="flex items-center justify-between pb-4">
                    <h3 class="text-lg font-semibold">{{@$title}}</h3>
                    <x-heroicon-o-x-circle @click="modalOpen=false" class="btn-error btn btn-circle btn-xs" />
                </div>
                <div class="relative w-auto">{{@$content}}</div>
            </div>
        </div>
</div>
