<!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
<div id='errorMessage' x-show="error.show" x-transition:enter="transition ease-out duration-300 transform"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
    <div class="relative py-3 pl-4 pr-10 mt-1 mb-1 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert"
    >
        <ul class="p-2 list-decimal ">
            <template x-for="message in error.message">
                <li x-html="message"> </li>
            </template>
        </ul>
    </div>
</div>
