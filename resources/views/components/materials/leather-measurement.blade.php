<div x-data="{
        grades: {
          a: 0.87,
          b: 0.82,
          c: 0.77,
          d: 0.72,
          e: 0.67,
        },
        skins: [
          {
            id: 1,
            supplierArea: null,
            grade: 'a',
            actualArea: null,
            unit: 'SQF',
          },
          {
            id: 2,
            supplierArea: null,
            grade: 'a',
            actualArea: null,
            unit: 'SQF',
          },
          {
            id: 3,
            supplierArea: null,
            grade: 'a',
            actualArea: null,
            unit: 'SQF',
          },
          {
            id: 4,
            supplierArea: null,
            grade: 'a',
            actualArea: null,
            unit: 'SQF',
          },
        ],
        nextId: 5,

        // Initialize component and set up watchers
        init() {
          // Log initial data on page load
          console.log('=== INITIAL LOAD ===');
          this.logData();

          // Set up deep watching for real-time updates
          this.$watch('skins', () => {
            this.logData();
          }, { deep: true });

          this.$watch('grades', () => {
            this.logData();
          }, { deep: true });
        },

        // Helper functions
        number(value) {
          const n = parseFloat(value);
          return isNaN(n) ? 0 : n;
        },

        // Add new skin
        addSkin() {
          this.skins.push({
            id: this.nextId++,
            supplierArea: null,
            grade: 'a',
            actualArea: null,
            unit: 'SQF',
          });
        },

        // Remove skin by id
        removeSkin(id) {
          this.skins = this.skins.filter((skin) => skin.id !== id);
        },

        // Calculations
        totalSupplierByGrade(gradeKey) {
          return this.skins
            .filter((s) => s.grade === gradeKey)
            .reduce((sum, s) => sum + this.number(s.supplierArea), 0);
        },

        totalSupplierAll() {
          return this.skins.reduce(
            (sum, s) => sum + this.number(s.supplierArea),
            0
          );
        },

        totalActualAll() {
          return this.skins.reduce(
            (sum, s) => sum + this.number(s.actualArea),
            0
          );
        },

        multipleByGrade(gradeKey) {
          const qty = this.totalSupplierByGrade(gradeKey);
          const coeff = this.grades[gradeKey] || 0;
          return qty * coeff;
        },

        totalQtyAll() {
          return this.totalSupplierAll();
        },

        totalMultipleAll() {
          return Object.keys(this.grades).reduce(
            (sum, grade) => sum + this.multipleByGrade(grade),
            0
          );
        },

        averageQualityCoefficient() {
          const totalQty = this.totalQtyAll();
          return totalQty ? this.totalMultipleAll() / totalQty : 0;
        },

        areaDiscrepancy() {
          const supplier = this.totalSupplierAll();
          return supplier ? this.totalActualAll() / supplier : 0;
        },

        // Update grades in rows below the current row
        updateAllGrades(grade, currentIndex) {
          if (confirm('Are you sure you want to update all grades below row ' + (currentIndex + 1) + ' to ' + grade.toUpperCase() + '?')) {
            this.skins = this.skins.map((skin, index) => ({
              ...skin,
              grade: index > currentIndex ? grade : skin.grade
            }));
          }
        },

        // Export to JSON
        exportToJSON() {
          const data = this.getChecklistData();
          console.log('=== LEATHER MEASUREMENT DATA ===');
          console.log(JSON.stringify(data, null, 2));
          console.log('=== END DATA ===');
          return data;
        },

        // Get checklist data structure
        getChecklistData() {
          return {
            timestamp: new Date().toISOString(),
            grades: this.grades,
            skins: this.skins,
            summary: {
              totalSkins: this.skins.length,
              totalSupplierArea: this.totalSupplierAll(),
              totalActualArea: this.totalActualAll(),
              areaDiscrepancy: this.areaDiscrepancy(),
              totalMultiple: this.totalMultipleAll(),
              averageQualityCoefficient: this.averageQualityCoefficient()
            },
            gradeBreakdown: Object.entries(this.grades).map(([grade, coefficient]) => ({
              grade: grade.toUpperCase(),
              coefficient,
              totalQty: this.totalSupplierByGrade(grade),
              multiple: this.multipleByGrade(grade)
            }))
          };
        },

        logData() {
          const data = this.getChecklistData();
          console.log('=== LEATHER MEASUREMENT DATA ===');
          console.log(JSON.stringify(data, null, 2));
          console.log('=== END DATA ===');
        },

        // Formatting
        formatNumber(value, decimals = 2) {
          return this.number(value).toFixed(decimals);
        },

        formatPercentage(value, decimals = 2) {
          return (this.number(value) * 100).toFixed(decimals) + '%';
        },
      }" class="max-w-full mx-auto overflow-auto bg-white rounded shadow-md">
    <!-- Top Header Bar -->
    <input type="hidden" x-modelable="{{$export}}"  x-model="exportToJSON" />
    <div class="flex items-center px-4 py-2 text-white bg-teal-600">
      <h1 class="text-sm font-semibold tracking-wide">Leather Measurement</h1>
    </div>

    <!-- Content Area -->
    <div class="px-4 pt-3 pb-4">
      <div class="flex items-center gap-3 mb-2">
        <!-- Add Skin -->
        <div class="flex items-center overflow-hidden text-gray-900 bg-white border border-gray-300 rounded">
          <button @click="addSkin()"
            class="px-3 py-2 text-xs font-semibold bg-white border-r border-gray-300 hover:bg-gray-50">
            + Add Skin
          </button>
          <span class="px-3 py-1.5 text-xs font-semibold text-gray-700" x-text="skins.length"></span>
        </div>
      </div>
      <div class="flex flex-col gap-4 lg:flex-row">
        <!-- LEFT TABLE: Skins -->
        <div class="flex-1 min-w-0">
          <div class="rounded border border-gray-300 overflow-auto max-h-[70vh]">
            <table class="min-w-full bg-white border-collapse">
              <!-- Table Header -->
              <thead>
                <tr class="border-b border-gray-300 bg-cyan-100">
                  <th
                    class="sticky left-0 w-32 px-4 py-3 text-sm font-semibold text-left text-gray-800 border-r border-gray-300 bg-cyan-100">
                    Skin #
                  </th>
                  <th class="px-4 py-3 text-sm font-semibold text-left text-gray-800 border-r border-gray-300 min-w-40">
                    Supplier Area
                  </th>
                  <th class="px-4 py-3 text-sm font-semibold text-left text-gray-800 border-r border-gray-300 min-w-40">
                    Grade
                  </th>
                  <th class="px-4 py-3 text-sm font-semibold text-left text-gray-800 border-r border-gray-300 min-w-40">
                    Actual Area
                  </th>
                  <th class="px-4 py-3 text-sm font-semibold text-left text-gray-800 border-r border-gray-300 min-w-40">
                    Unit
                  </th>
                </tr>
              </thead>

              <!-- Table Body - Dynamic Content -->
              <tbody>
                <template x-for="(skin, index) in skins" :key="skin.id">
                  <tr :class="{ 'bg-gray-50': index % 2 === 0, 'border-b border-gray-300': true }">
                    <td class="sticky left-0 z-10 px-4 py-3 text-sm font-semibold bg-white border-r border-gray-300"
                      :class="{ '!bg-gray-50': index % 2 === 0 }">
                      <div class="flex items-center justify-around">
                        <span x-text="index + 1"></span>
                        <button @click="removeSkin(skin.id)"
                          class="p-1 text-red-500 transition-colors rounded hover:text-red-600 hover:bg-red-50"
                          title="Remove this skin">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                          </svg>
                        </button>
                      </div>
                    </td>
                    <td class="px-4 py-3 border-r border-gray-300 min-w-40">
                      <input type="number" step="0.01" placeholder="Supplier Area..."
                        class="w-full px-3 py-2 text-sm bg-white border border-gray-300 rounded focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        x-model.number="skin.supplierArea" />
                    </td>
                    <td class="px-4 py-3 border-r border-gray-300 min-w-40">
                      <div class="flex items-center">
                        <select
                          class="flex-1 px-3 py-2 text-sm bg-white border border-gray-300 rounded-l focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                          x-model="skin.grade">
                          <template x-for="[gradeKey, gradeValue] in Object.entries(grades)" :key="gradeKey">
                            <option :value="gradeKey" x-text="'Grade ' + gradeKey.toUpperCase()"></option>
                          </template>
                        </select>
                        <button @click="$event.stopPropagation(); updateAllGrades(skin.grade, index)"
                          class="h-full p-2 text-yellow-500 border border-l-0 border-gray-300 rounded-r hover:bg-yellow-50"
                          title="Apply to all below" type="button">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                          </svg>
                        </button>
                      </div>
                    </td>
                    <td class="px-4 py-3 border-r border-gray-300 min-w-40">
                      <input type="number" step="0.01" placeholder="Actual Area..."
                        class="w-full px-3 py-2 text-sm bg-white border border-gray-300 rounded focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        x-model.number="skin.actualArea" />
                    </td>
                    <td class="px-4 py-3 border-r border-gray-300 min-w-40">
                      <input type="text" placeholder="SQF"
                        class="w-full px-3 py-2 text-sm bg-white border border-gray-300 rounded focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        x-model="skin.unit" />
                    </td>
                  </tr>
                </template>
                <!-- Total Row -->
                <tr class="bg-gray-100">
                  <td class="sticky left-0 z-10 px-4 py-2 text-xs font-semibold bg-white">
                    <span>Total</span>
                  </td>
                  <td class="px-4 py-2">
                    <input type="text" :value="formatNumber(totalSupplierAll(), 2)" readonly
                      class="w-full px-2 py-1.5 text-xs border rounded bg-gray-200 font-semibold" />
                  </td>
                  <td class="px-4 py-2"></td>
                  <td class="px-4 py-2">
                    <input type="text" :value="formatNumber(totalActualAll(), 2)" readonly
                      class="w-full px-2 py-1.5 text-xs border rounded bg-gray-200 font-semibold" />
                  </td>
                  <td class="px-4 py-2"></td>
                </tr>
                <!-- Area Discrepancy Row -->
                <tr class="border-t border-gray-300 bg-gray-50">
                  <td class="sticky left-0 z-10 px-4 py-2 text-xs font-semibold bg-white">
                    Area Discrepancy %
                  </td>
                  <td class="px-4 py-2">
                    <input type="text" :value="formatPercentage(areaDiscrepancy(), 2)" readonly
                      class="w-full px-2 py-1.5 text-xs border rounded bg-gray-200 font-semibold" />
                  </td>
                  <td colspan="3"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- RIGHT TABLE: Grades -->
        <div class="flex-1 min-w-0">
          <div class="rounded border border-gray-300 overflow-auto max-h-[70vh]">
            <table class="min-w-full border-collapse">
              <!-- Table Header -->
              <thead>
                <tr class="bg-yellow-100 border-b border-gray-300">
                  <th class="px-4 py-3 text-sm font-semibold text-left text-gray-800 border-r border-gray-300 min-w-40">
                    Grade
                  </th>
                  <th class="px-4 py-3 text-sm font-semibold text-left text-gray-800 border-r border-gray-300 min-w-40">
                    Total Qty(SQF)
                  </th>
                  <th class="px-4 py-3 text-sm font-semibold text-left text-gray-800 border-r border-gray-300 min-w-40">
                    Coefficient(%)
                  </th>
                  <th class="px-4 py-3 text-sm font-semibold text-left text-gray-800 border-r border-gray-300 min-w-40">
                    Multiple (SQF)
                  </th>
                </tr>
              </thead>

              <!-- Table Body - Dynamic Content -->
              <tbody>
                <template x-for="[gradeKey, gradeValue] in Object.entries(grades)" :key="gradeKey">
                  <tr class="border-b border-gray-300" :class="{ 'bg-gray-50': ['b', 'd'].includes(gradeKey) }">
                    <td class="px-4 py-3 text-center border-r border-gray-300 min-w-40">
                      <span class="w-full px-3 py-2 text-sm font-semibold">
                        Grade <span x-text="gradeKey.toUpperCase()"></span>
                      </span>
                    </td>
                    <td class="px-4 py-3 text-right border-r border-gray-300 min-w-40">
                      <span class="w-full px-3 py-2 text-sm" x-text="formatNumber(totalSupplierByGrade(gradeKey), 2)">
                      </span>
                    </td>
                    <td class="px-4 py-3 text-center border-r border-gray-300 min-w-40">
                      <span class="w-full px-3 py-2 text-sm">
                        x
                        <span x-text="formatNumber(gradeValue * 100, 0)"></span>%
                      </span>
                    </td>
                    <td class="px-4 py-3 text-right border-r border-gray-300 min-w-40">
                      <span class="w-full px-3 py-2 text-sm" x-text="formatNumber(multipleByGrade(gradeKey), 2)">
                      </span>
                    </td>
                  </tr>
                </template>
                <!-- Total Row -->
                <tr class="bg-gray-100">
                  <td class="sticky left-0 z-10 px-4 py-2 text-xs font-semibold bg-white">
                    Total
                  </td>
                  <td class="px-4 py-2">
                    <input type="text" :value="formatNumber(totalQtyAll(), 2)" readonly
                      class="w-full px-2 py-1.5 text-xs border rounded bg-gray-200 font-semibold" />
                  </td>
                  <td class="px-4 py-2"></td>
                  <td class="px-4 py-2">
                    <input type="text" :value="formatNumber(totalMultipleAll(), 2)" readonly
                      class="w-full px-2 py-1.5 text-xs border rounded bg-gray-200 font-semibold" />
                  </td>
                </tr>
                <!-- Average Quality Coefficient Row -->
                <tr class="border-t border-gray-300 bg-gray-50">
                  <td class="sticky left-0 z-10 px-4 py-2 text-xs font-semibold bg-white">
                    Average Quality Coefficient
                  </td>
                  <td class="px-4 py-2">
                    <input type="text" :value="formatPercentage(averageQualityCoefficient(), 2)" readonly
                      class="w-full px-2 py-1.5 text-xs border rounded bg-gray-200 font-semibold" />
                  </td>
                  <td class="w-16 px-4 py-2 text-center align-middle">
                    <span class="text-xs font-semibold"></span>
                  </td>
                  <td class="px-4 py-2"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
