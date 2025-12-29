@props(['export'])
<div x-data="{
          // PARAMETERS - Configurable via config object
          parameters: {
            initialSkinCount:5,
            pointColumns:'',
            skinPrefix: 'Skin',
            pointPrefix: 'Point'
          },

          // Computed properties
          get pointColumns() {
            return this.parameters.pointColumns
              .split(',')
              .map((col) => col.trim());
          },

          skins: [],

          init() {
            this.applyParameters();
            // Initial load logging
            this.$nextTick(() => {
              this.logToConsole();
            });

            // Deep watching for real-time updates
            this.$watch('skins', () => {
              this.logToConsole();
            }, { deep: true });
          },

          // Apply parameters and regenerate skins
          applyParameters() {
            // Clear existing skins
            this.skins = [];

            // Create new skins based on parameters
            for (let i = 0; i < this.parameters.initialSkinCount; i++) {
              this.addSkin(true); // true = prefill with sample data
            }
          },

          // Update parameters externally
          updateParameters(newConfig) {
            Object.assign(this.parameters, newConfig);
            this.applyParameters();
          },

          addSkin(prefill = false) {
            const skin = {
              id: Date.now() + Math.random(),
              points: {},
            };

            // Initialize all point columns
            this.pointColumns.forEach((column) => {
              if (prefill) {
                skin.points[column] = `${this.parameters.pointPrefix} ${
                  this.skins.length + 1
                }..`;
              } else {
                skin.points[column] = '';
              }
            });

            this.skins.push(skin);
          },

          // Remove specific skin by index
          removeSkin(index) {
            if (this.skins.length > 0) {
              if (
                confirm(
                  `Are you sure you want to remove ${
                    this.parameters.skinPrefix
                  } ${index + 1}?`
                )
              ) {
                this.skins.splice(index, 1);
              }
            }
          },

          // Get all skin data
          getSkinData() {
            return this.skins.map((skin, index) => ({
              skinNumber: index + 1,
              points: { ...skin.points },
            }));
          },

          clearAllSkins() {
            this.skins = [];
          },

          logToConsole() {
            const data = {
              metadata: {
                totalSkins: this.skins.length,
                pointColumns: this.pointColumns,
                timestamp: new Date().toISOString()
              },
              skins: this.getSkinData()
            };

            console.clear(); // Clear console for cleaner output
            console.log('=== SKIN DATA ===');
            console.log('JSON String:');
            console.log(JSON.stringify(data, null, 2));
            console.log('\nParsed Object:');
            console.log(data);
            console.log('==================');
          },

          get skinCount() {
            return this.skins.length;
          }
        }" class="mx-auto ax-w-full">
      <!-- Header with Controls -->
      <input type="hidden" x-modelable="{{$export}}" x-model="skins" />
      <div class="flex items-center gap-4 mb-2">
        <!-- Add Skin Button -->
        <div class="flex items-center bg-white border border-gray-400 rounded">
          <button
            @click="addSkin()"
            class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-black transition-colors border-r border-gray-400 hover:bg-gray-100"
          >
            + Add Skin
          </button>
          <span
            class="px-4 py-2 text-sm font-semibold text-gray-600"
            x-text="skinCount"
          ></span>
        </div>
      </div>

      <!-- Table Container with Scroll -->
      <div class="overflow-x-auto border border-gray-300 rounded">
        <table class="w-full bg-white border-collapse">
          <!-- Table Header -->
          <thead>
            <tr class="border-b border-gray-300 bg-cyan-100">
              <th
                class="sticky left-0 w-32 px-4 py-3 text-sm font-semibold text-left text-gray-800 border-r border-gray-300 bg-cyan-100"
              >
                Skin #
              </th>
              <template x-for="column in pointColumns" :key="column">
                <th
                  class="px-4 py-3 text-sm font-semibold text-left text-gray-800 border-r border-gray-300 min-w-40"
                >
                  Point <span x-text="column"></span>
                </th>
              </template>
            </tr>
          </thead>

          <!-- Table Body -->
          <tbody>
            <template x-for="(skin, index) in skins" :key="skin.id">
              <tr class="border-b border-gray-300 hover:bg-gray-50">
                <!-- Skin Number with Remove Button -->
                <td
                  class="sticky left-0 px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-100 border-r border-gray-300"
                >
                  <div class="flex items-center justify-around">
                    <span x-text="index + 1"></span>
                    <!-- Remove Skin Button (Icon Only) -->
                    <button
                      @click="removeSkin(index)"
                      class="p-1 text-red-500 transition-colors rounded hover:text-red-600 hover:bg-red-50"
                      title="Remove this skin"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-4 h-4"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                        />
                      </svg>
                    </button>
                  </div>
                </td>

                <!-- Dynamic Point Columns -->
                <template x-for="column in pointColumns" :key="column">
                  <td
                    class="px-4 py-3 border-r border-gray-300 min-w-40"
                    :class="column === pointColumns[pointColumns.length - 1] ? '' : 'border-r border-gray-300'"
                  >
                    <input
                      type="text"
                      x-model="skin.points[column]"
                      :placeholder="'Point ' + (index + 1) + '..'"
                      class="w-full px-3 py-2 text-sm bg-white border border-gray-300 rounded focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                    />
                  </td>
                </template>
              </tr>
            </template>
          </tbody>
        </table>
      </div>

      <!-- Empty State -->
      <div x-show="skins.length === 0" class="mt-8 text-center text-gray-500">
        <p class="text-lg">No skins added yet.</p>
        <p class="mt-2 text-sm">Click "Add Skin" to get started.</p>
      </div>
    </div>
