
<button
    class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm
           appearance-none cursor-pointer
           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
           disabled:bg-gray-100 disabled:cursor-not-allowed"
    x-show="!autoCompleteOpen"
    @click="autoCompleteOpen = !autoCompleteOpen"
    x-text="getDisplayText()"
></button>
