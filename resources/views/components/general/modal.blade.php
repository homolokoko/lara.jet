@props(['id', 'title', 'body', 'footer', 'widthOption'])

<div x-cloak wire:ignore id="{{ $id ?? '' }}" {{ $attributes ?? '' }}
class="fixed inset-0 z-40 flex items-center justify-center overflow-auto bg-black bg-opacity-50 "
     :class="{ 'hidden': modalOpen == false }" id="modal">
    <div class="w-11/12 max-w-4xl max-h-full p-8 overflow-auto bg-scroll bg-white rounded-lg">
        <div class="flex ">
            <h1 class="flex-grow text-xl font-medium text-gray-800 uppercase"> {{ $title ?? '' }}</h1>

            <svg  x-show="(typeof compulsory !== 'undefined')? compulsory === false : true" xmlns="http://www.w3.org/2000/svg" width="32" height="32" @click="modalOpen = !modalOpen"
                  fill="currentColor" class="bi bi-x hover:pointer " viewBox="0 0 16 16">
                <path
                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
            </svg>
        </div>
        <p class="mb-4"> {{ $body ?? '' }} </p>
        <div class="flex justify-center mt-6">
            <footer>
                <div class="flex items-center h-8 space-x-2">
                    {{ $footer ?? '' }}
                </div>
            </footer>
        </div>
    </div>

</div>
