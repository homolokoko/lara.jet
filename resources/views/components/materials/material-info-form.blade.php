@props(['export'])
<div class="p-4 bg-white" x-data="{
          isEditMode: false,
          formData: {
            orderNo: 'IAT5817',
            poNo: 'IA.F.25.08.2875',
            supplier: 'Foshan City Shunde Goldtex Group Co., Ltd.',
            color: 'CW91 BRICK - 26STKP004 BIAS STRIPE',
            batchNo: '251014042',
            content: '100% BCI COTTON',
            materialType: 'Slub Jersey',
            width: '72.50 INCHES',
            weight: '125.00 gm/m2',
            status: 'Waiting for Approval',
            colorShade: '',
            remark: '',
          },

          init() {
            // Initial load: Log the form data when the page loads
            console.log('=== INITIAL LOAD ===');
            console.log('Form Data as JSON:');
            console.log(JSON.stringify(this.formData, null, 2));

            // Deep watching: Automatically log whenever any form field changes
            this.$watch('formData', (newValue, oldValue) => {
              console.log('=== REAL-TIME UPDATE ===');
              console.log('Form Data Changed:');
              console.log(JSON.stringify(newValue, null, 2));
            }, { deep: true });
          },

          saveData() {
            // Log form data as formatted JSON
            console.log('Form Data as JSON:');
            console.log(JSON.stringify(this.formData, null, 2));

            // Also log the raw object for comparison
            console.log('Raw form data object:', this.formData);

            alert('Material information saved successfully! Check console for JSON data.');
          },

          handleImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
              console.log('Image uploaded:', file.name);
              // Here you would handle the file upload
            }
          },
        }">
    <!-- Header with Smaller Toggle -->
    <input type="hidden" x-modelable="{{$export}}" x-model="formData" />
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold text-gray-600">
        Material Information Form
      </h1>
      <div class="flex items-center gap-4">
        <span
          class="text-base font-medium"
          x-text="isEditMode ? 'Edit Mode' : 'Preview Mode'"
        ></span>

        <!-- Smaller Toggle Button -->
        <button
          @click="isEditMode = !isEditMode"
          class="relative w-16 h-8 p-1 transition-all duration-300 bg-gray-300 rounded-full"
          :class="isEditMode ? 'bg-green-500' : 'bg-gray-400'"
        >
          <div
            class="w-6 h-6 transition-transform duration-300 transform bg-white rounded-full shadow-lg"
            :class="isEditMode ? 'translate-x-8' : 'translate-x-0'"
          ></div>
        </button>

        <button
          class="px-6 py-2 text-base font-bold text-white transition duration-200 bg-green-700 rounded-lg shadow-md hover:bg-green-900"
          x-show="isEditMode"
          @click="saveData"
        >
          Save
        </button>
      </div>
    </div>

    <div class="flex w-full">
      <div class="flex-1">
        <!-- FIRST TABLE ROW: Order No, P/O No, Supplier, Color, Batch# -->
        <table class="w-full border-collapse" style="table-layout: fixed">
          <colgroup>
            <col class="w-1/5" />
            <col class="w-1/5" />
            <col class="w-1/5" />
            <col class="w-1/5" />
            <col class="w-1/5" />
          </colgroup>
          <thead>
            <tr class="bg-green-600">
              <th
                class="px-3 py-2 text-xs font-bold text-center text-white border border-green-700"
              >
                Order No.
              </th>
              <th
                class="px-3 py-2 text-xs font-bold text-center text-white border border-green-700"
              >
                Main Material P/O No
              </th>
              <th
                class="px-3 py-2 text-xs font-bold text-center text-white border border-green-700"
              >
                Main Material Supplier
              </th>
              <th
                class="px-3 py-2 text-xs font-bold text-center text-white border border-green-700"
              >
                Main Material Color
              </th>
              <th
                class="px-3 py-2 text-xs font-bold text-center text-white border border-green-700"
              >
                Main Material Batch#
              </th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-green-500">
              <!-- Order No -->
              <td class="px-3 py-3 text-center border border-green-600">
                <template x-if="isEditMode">
                  <input
                    type="text"
                    class="w-full px-2 py-1 text-sm text-center text-gray-600 bg-white border-none rounded"
                    placeholder="Order No"
                    x-model="formData.orderNo"
                  />
                </template>
                <template x-if="!isEditMode">
                  <span
                    class="text-lg font-bold text-white"
                    x-text="formData.orderNo || 'Order No'"
                  ></span>
                </template>
              </td>

              <!-- P/O No -->
              <td class="px-3 py-3 text-center border border-green-600">
                <template x-if="isEditMode">
                  <input
                    type="text"
                    class="w-full px-2 py-1 text-sm text-center text-gray-600 bg-white border-none rounded"
                    placeholder="P/O No"
                    x-model="formData.poNo"
                  />
                </template>
                <template x-if="!isEditMode">
                  <span
                    class="text-lg font-bold text-white"
                    x-text="formData.poNo || 'P/O No'"
                  ></span>
                </template>
              </td>

              <!-- Supplier -->
              <td class="px-3 py-3 text-center border border-green-600">
                <template x-if="isEditMode">
                  <input
                    type="text"
                    class="w-full px-2 py-1 text-sm font-semibold text-center text-gray-600 bg-white border-none rounded"
                    placeholder="Supplier"
                    x-model="formData.supplier"
                  />
                </template>
                <template x-if="!isEditMode">
                  <span
                    class="text-sm font-medium text-white"
                    x-text="formData.supplier || 'Supplier'"
                  ></span>
                </template>
              </td>

              <!-- Color -->
              <td class="px-3 py-3 text-center border border-green-600">
                <template x-if="isEditMode">
                  <input
                    type="text"
                    class="w-full px-2 py-1 text-sm text-center text-gray-600 bg-white border-none rounded"
                    placeholder="Color"
                    x-model="formData.color"
                  />
                </template>
                <template x-if="!isEditMode">
                  <span
                    class="text-lg font-bold text-white"
                    x-text="formData.color || 'Color'"
                  ></span>
                </template>
              </td>

              <!-- Batch# -->
              <td class="px-3 py-3 text-center border border-green-600">
                <template x-if="isEditMode">
                  <input
                    type="text"
                    class="w-full px-2 py-1 text-sm text-center text-gray-600 bg-white border-none rounded"
                    placeholder="Batch#"
                    x-model="formData.batchNo"
                  />
                </template>
                <template x-if="!isEditMode">
                  <span
                    class="text-lg font-bold text-white"
                    x-text="formData.batchNo || 'Batch#'"
                  ></span>
                </template>
              </td>
            </tr>
          </tbody>
        </table>

        <!-- SECOND TABLE ROW: Content, Type, Width, Weight, Status -->
        <table
          class="w-full border-t-0 border-collapse"
          style="table-layout: fixed"
        >
          <colgroup>
            <col class="w-1/5" />
            <col class="w-1/5" />
            <col class="w-1/5" />
            <col class="w-1/5" />
            <col class="w-1/5" />
          </colgroup>
          <thead>
            <tr class="bg-green-600">
              <th
                class="px-3 py-2 text-xs font-bold text-center text-white border border-green-700"
              >
                Main Material Content
              </th>
              <th
                class="px-3 py-2 text-xs font-bold text-center text-white border border-green-700"
              >
                Main Material Type
              </th>
              <th
                class="px-3 py-2 text-xs font-bold text-center text-white border border-green-700"
              >
                Fabric Ext Width
              </th>
              <th
                class="px-3 py-2 text-xs font-bold text-center text-white border border-green-700"
              >
                Fabric Max Weight (gm)
              </th>
              <th
                class="px-3 py-2 text-xs font-bold text-center text-white border border-green-700"
              >
                Status
              </th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-green-500">
              <!-- Content -->
              <td class="px-3 py-3 text-center border border-green-600">
                <template x-if="isEditMode">
                  <input
                    type="text"
                    class="w-full px-2 py-1 text-sm text-center text-gray-600 bg-white border-none rounded"
                    placeholder="Main Material Content"
                    x-model="formData.content"
                  />
                </template>
                <template x-if="!isEditMode">
                  <span
                    class="text-sm font-bold text-white"
                    x-text="formData.content || 'Main Material Content'"
                  ></span>
                </template>
              </td>

              <!-- Material Type -->
              <td class="px-3 py-3 text-center border border-green-600">
                <template x-if="isEditMode">
                  <input
                    type="text"
                    class="w-full px-2 py-1 text-sm text-center text-gray-600 bg-white border-none rounded"
                    placeholder="Main Material Type"
                    x-model="formData.materialType"
                  />
                </template>
                <template x-if="!isEditMode">
                  <span
                    class="text-sm font-bold text-white"
                    x-text="formData.materialType || 'Main Material Type'"
                  ></span>
                </template>
              </td>

              <!-- Width -->
              <td class="px-3 py-3 text-center border border-green-600">
                <template x-if="isEditMode">
                  <input
                    type="text"
                    class="w-full px-2 py-1 text-sm text-center text-gray-600 bg-white border-none rounded"
                    placeholder="Fabric Ext Width"
                    x-model="formData.width"
                  />
                </template>
                <template x-if="!isEditMode">
                  <span
                    class="text-sm font-bold text-white"
                    x-text="formData.width || 'Fabric Ext Width'"
                  ></span>
                </template>
              </td>

              <!-- Weight -->
              <td class="px-3 py-3 text-center border border-green-600">
                <template x-if="isEditMode">
                  <input
                    type="text"
                    class="w-full px-2 py-1 text-sm text-center text-gray-600 bg-white border-none rounded"
                    placeholder="Fabric Max Weight (gm)"
                    x-model="formData.weight"
                  />
                </template>
                <template x-if="!isEditMode">
                  <span
                    class="text-sm font-bold text-white"
                    x-text="formData.weight || 'Fabric Max Weight (gm)'"
                  ></span>
                </template>
              </td>

              <!-- Status -->
              <td class="px-3 py-3 border border-green-600">
                <template x-if="isEditMode">
                  <select
                    class="w-full px-2 py-1 text-xs font-medium text-gray-700 bg-white border-none rounded"
                    x-model="formData.status"
                  >
                    <option>Waiting for Approval</option>
                    <option>Approved</option>
                    <option>Rejected</option>
                  </select>
                </template>
                <template x-if="!isEditMode">
                  <span
                    class="text-sm font-medium text-white"
                    x-text="formData.status || 'Waiting for Approval'"
                  ></span>
                </template>
              </td>
            </tr>
          </tbody>
        </table>

        <!-- THIRD TABLE ROW: Color Shade & Remark -->
        <table
          class="w-full border-t-0 border-collapse"
          style="table-layout: fixed"
        >
          <colgroup>
            <col class="w-1/5" />
            <col class="w-4/5" />
          </colgroup>
          <thead>
            <tr class="bg-green-600">
              <th
                class="px-3 py-2 text-xs font-bold text-center text-white border border-green-700"
              >
                Color Shade
              </th>
              <th
                class="px-3 py-2 text-xs font-bold text-center text-white border border-green-700"
              >
                Remark
              </th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-green-500">
              <!-- Color Shade -->
              <td class="px-3 py-3 text-center border border-green-600">
                <template x-if="isEditMode">
                  <select
                    class="w-full px-2 py-1 text-xs font-medium text-gray-700 bg-white border-none rounded"
                    x-model="formData.colorShade"
                  >
                    <option value="">-- Select Color Shade --</option>
                    <option>Light</option>
                    <option>Medium</option>
                    <option>Dark</option>
                  </select>
                </template>
                <template x-if="!isEditMode">
                  <span
                    class="text-sm text-white"
                    x-text="formData.colorShade || '-- Select Color Shade --'"
                  ></span>
                </template>
              </td>

              <!-- Remark -->
              <td class="px-3 py-3 border border-green-600">
                <template x-if="isEditMode">
                  <input
                    type="text"
                    class="w-full px-2 py-1 text-sm text-gray-600 bg-white border-none rounded"
                    placeholder="Enter remarks..."
                    x-model="formData.remark"
                  />
                </template>
                <template x-if="!isEditMode">
                  <span
                    class="text-sm font-medium text-center text-white"
                    x-text="formData.remark || 'Enter remarks...'"
                  ></span>
                </template>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Right Side - Main Material Sketch (full height) -->
      <div
        class="flex flex-col bg-green-500 border border-l-0 border-green-600 w-80"
      >
        <div
          class="px-3 py-2 text-xs font-bold text-center text-white bg-green-600 border-b border-green-600"
        >
          Main Material Sketch
        </div>
        <div
          class="flex flex-col items-center justify-center flex-1 gap-2 px-4 py-6"
        >
          <div
            class="flex items-center justify-center h-20 bg-white border-4 border-gray-300 rounded w-28"
          >
            <svg
              class="w-10 h-10 text-gray-400"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
              ></path>
            </svg>
          </div>
          <p class="text-xs text-gray-300">No image</p>
          <template x-if="isEditMode">
            <input
              type="file"
              class="mt-2 text-xs text-gray-600"
              accept="image/*"
              @change="handleImageUpload"
            />
          </template>
        </div>
      </div>
    </div>
  </div>
