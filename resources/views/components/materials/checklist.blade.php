@props(['export'])

<div>

    <div x-data="{
                    checklistItems: [
                        { id: 1, description: 'Package check', result: 'pass' },
                        { id: 2, description: 'Measurement check', result: 'pass' },
                        { id: 3, description: 'Test check', result: 'pass' },
                        { id: 4, description: 'Color Grain Evaluation', result: 'pass' },
                        { id: 5, description: 'Dye Penetration', result: 'pass' },
                        { id: 6, description: 'Article check', result: 'pass' },
                        { id: 7, description: 'Thickness of leather on 5 skins', result: 'pass' },
                        { id: 8, description: 'To use fitting size 25 mm to measure softness of leather on 5 skins', result: 'pass' },
                        { id: 9, description: 'Moisture Content on 5 skins', result: 'pass' }
                    ],

                    init() {
                        // Log initial data to console
                        this.logToConsole();

                        // Watch for changes in checklistItems
                        this.$watch('checklistItems', () => {
                            this.logToConsole();
                        }, { deep: true });
                    },

                    logToConsole() {
                        const exportData = {
                            timestamp: new Date().toISOString(),
                            checklist: this.checklistItems.map(item => ({
                                no: item.id,
                                description: item.description,
                                result: item.result
                            }))
                        };

                        console.log('=== CHECKLIST DATA ===');
                        console.log('Timestamp:', exportData.timestamp);
                        console.log('Checklist Items:', exportData.checklist);
                        console.log('JSON String:', JSON.stringify(exportData, null, 2));
                        console.log('===================');
                    },

                    resetAll() {
                        if (confirm('Are you sure you want to reset all results to Pass?')) {
                            this.checklistItems.forEach(item => {
                                item.result = 'pass';
                            });
                            this.showNotification('All results reset to Pass', 'info');
                        }
                    },

                    showNotification(message, type = 'info') {
                        // Create notification element
                        const notification = document.createElement('div');
                        notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white z-50 ${
                            type === 'success' ? 'bg-green-500' : 'bg-blue-500'
                        }`;
                        notification.textContent = message;

                        document.body.appendChild(notification);

                        // Remove after 3 seconds
                        setTimeout(() => {
                            notification.remove();
                        }, 3000);
                    }
                }" class="max-w-full mx-auto overflow-hidden bg-white rounded-lg shadow-lg">
        <!-- Header -->
        <input type="hidden" x-modelable="{{$export}}" x-model="checklistItems" />
        <div class="flex items-center justify-between px-6 py-4 text-white bg-teal-600">
            <h1 class="text-xl font-semibold">Check List</h1>
            <button
                @click="resetAll()"
                class="px-4 py-2 text-sm font-medium text-white bg-gray-500 rounded hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500"
            >
                Reset All
            </button>
        </div>

        <!-- Table -->
        <table class="w-full">
            <thead class="bg-gray-100 border-b-2 border-gray-300">
                <tr>
                    <th class="px-6 py-3 text-sm font-semibold text-left text-gray-700 border-r border-gray-300">No</th>
                    <th class="px-6 py-3 text-sm font-semibold text-left text-gray-700 border-r border-gray-300">Description</th>
                    <th class="px-6 py-3 text-sm font-semibold text-center text-gray-700">Result</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(item, index) in checklistItems" :key="item.id">
                    <tr :class="index % 2 === 0 ? 'bg-white hover:bg-gray-50' : 'bg-gray-50 hover:bg-gray-100'">
                        <td class="px-6 py-4 text-sm text-gray-900 border-r border-gray-200" x-text="index + 1"></td>
                        <td class="px-6 py-4 text-sm text-gray-900 border-r border-gray-200" x-text="item.description"></td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center space-x-6">
                                <label class="flex items-center">
                                    <input
                                        type="radio"
                                        :name="'result' + item.id"
                                        value="pass"
                                        :checked="item.result === 'pass'"
                                        @change="item.result = 'pass'"
                                        class="mr-2 accent-sky-500"
                                    >
                                    <span class="text-sm text-gray-700">Pass</span>
                                </label>
                                <label class="flex items-center">
                                    <input
                                        type="radio"
                                        :name="'result' + item.id"
                                        value="fail"
                                        :checked="item.result === 'fail'"
                                        @change="item.result = 'fail'"
                                        class="mr-2 accent-sky-500"
                                    >
                                    <span class="text-sm text-gray-700">Fail</span>
                                </label>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
    @push('script')
        <script>
            function checklistApp() {
                return ;
            }
        </script>
    @endpush

</div>
