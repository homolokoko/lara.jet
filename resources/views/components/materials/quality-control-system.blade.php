@props(['export'])
<div x-data="{
          // Calculation section data
          calculation: {
            defectPoints: 0,
            inspectedYards: 0,
            cuttableWidth: 0,
            shipmentPoints: 0,
            passed: false,
          },

          // Dynamic defect columns
          defectColumns: [
            { name: 'Fly Yarn' },
            { name: 'Slub' },
            { name: 'Needle Line' },
            { name: 'Hole' },
            { name: 'Color Shade' },
            { name: 'Stain' },
          ],

          // Rolls data
          rolls: [],

          // UI state
          showRollSelection: false,
          showPhotoUpload: false,
          showViewPhotos: false,
          currentRollIndex: null,
          uploadedImages: [],
          photoRemark: '',
          currentRollPhotos: [],

          // Sample rolls from database (simulated)
          sampleRolls: [
            {
              id: 1,
              mmCode: 'LJ2117-52395',
              rollNumber: '2',
              productName: 'LOLA LNIGHT BRUSH XT',
              materialType: 'RECYCLE POLYESTER',
              qtyYds: 22.798,
              qtyKg: 53.45,
              qtyLbs: 117.84,
              qtyMeter: 20.846,
              physicalYds: 57.0,
            },
            {
              id: 2,
              mmCode: 'LJ2117-52396',
              rollNumber: '3',
              productName: 'COTTON BLEND XT',
              materialType: 'ORGANIC COTTON',
              qtyYds: 20.5,
              qtyKg: 48.2,
              qtyLbs: 106.26,
              qtyMeter: 18.745,
              physicalYds: 52.3,
            },
            {
              id: 3,
              mmCode: 'LJ2117-52397',
              rollNumber: '4',
              productName: 'POLY SILK PREMIUM',
              materialType: 'POLYESTER SILK',
              qtyYds: 26.35,
              qtyKg: 61.8,
              qtyLbs: 136.24,
              qtyMeter: 24.094,
              physicalYds: 65.8,
            },
          ],

          // Initialize with empty roll
          init() {
            this.addEmptyRoll();
            // Log initial data on page load
            this.$nextTick(() => {
              this.logCurrentData('Initial load');
            });

            // Set up deep watching for all changes
            this.$watch('rolls', () => {
              this.logCurrentData('Real-time update - Rolls changed');
            }, { deep: true });

            this.$watch('calculation', () => {
              this.logCurrentData('Real-time update - Calculation changed');
            }, { deep: true });

            this.$watch('defectColumns', () => {
              this.logCurrentData('Real-time update - Defect columns changed');
            }, { deep: true });
          },

          // Log current data to console as JSON
          logCurrentData(source) {
            console.log(`=== Quality Control Data (JSON) - ${source} ===`);
            console.log('Timestamp:', new Date().toISOString());
            console.log('Calculation:', JSON.stringify(this.calculation, null, 2));
            console.log('Defect Columns:', JSON.stringify(this.defectColumns, null, 2));
            console.log('Rolls:', JSON.stringify(this.rolls, null, 2));
            console.log('==========================================');
          },

          // Format number for display
          formatNumber(value) {
            if (!value && value !== 0) return '';
            const num = parseFloat(value);
            return isNaN(num) ? value : num.toFixed(3);
          },

          // Add empty roll
          addEmptyRoll() {
            const roll = {
              id: Date.now() + Math.random(),
              mmCode: '',
              rollNumber: '',
              qtyYds: 0,
              qtyKg: 0,
              qtyLbs: 0,
              qtyMeter: 0,
              physicalYds: 0,
              defects: new Array(this.defectColumns.length).fill(0),
              defectPoints: 0,
              remark: '',
              photos: [],
            };
            this.rolls.push(roll);
          },

          // Update roll field with validation
          updateRollField(roll, field, value) {
            // Remove any non-numeric characters except decimal point and minus
            const numericValue = value.replace(/[^\d.-]/g, '');
            // Ensure it's a valid number
            const num = parseFloat(numericValue);
            roll[field] = isNaN(num) ? 0 : num;
          },

          // Select roll from database
          selectRollFromDB(dbRoll) {
            const roll = {
              id: Date.now() + Math.random(),
              mmCode: dbRoll.mmCode,
              rollNumber: dbRoll.rollNumber,
              qtyYds: dbRoll.qtyYds,
              qtyKg: dbRoll.qtyKg,
              qtyLbs: dbRoll.qtyLbs,
              qtyMeter: dbRoll.qtyMeter,
              physicalYds: dbRoll.physicalYds,
              defects: new Array(this.defectColumns.length).fill(0),
              defectPoints: 0,
              remark: '',
              photos: [],
            };
            this.rolls.push(roll);
            this.showRollSelection = false;
            this.updateHeaderCalculations();
          },

          // Remove roll
          removeRoll(index) {
            if (confirm('Are you sure you want to remove this roll?')) {
              this.rolls.splice(index, 1);
              this.updateHeaderCalculations();
            }
          },

          // Convert KG to other units
          convertKgToOthers(roll) {
            if (
              roll.qtyKg !== undefined &&
              roll.qtyKg !== null &&
              roll.qtyKg !== ''
            ) {
              const kg = parseFloat(roll.qtyKg);
              if (!isNaN(kg)) {
                // KG to LBS: 1 kg = 2.20462 lbs
                roll.qtyLbs = (kg * 2.20462).toFixed(3);
              }
            }
          },

          // Convert YARDS to other units
          convertYardsToOthers(roll) {
            if (
              roll.qtyYds !== undefined &&
              roll.qtyYds !== null &&
              roll.qtyYds !== ''
            ) {
              const yds = parseFloat(roll.qtyYds);
              if (!isNaN(yds)) {
                // YDS to Meter: 1 yard = 0.9144 meters
                roll.qtyMeter = (yds * 0.9144).toFixed(3);
              }
            }
          },

          // Calculate defect points for a roll
          calculateRollDefectPoints(roll) {
            roll.defectPoints = roll.defects.reduce(
              (sum, defect) => sum + (parseInt(defect) || 0),
              0
            );
          },

          // Add new defect column
          addDefectColumn() {
            const name = prompt('Enter defect column name:');
            if (name) {
              this.defectColumns.push({ name });
              this.rolls.forEach((roll) => {
                roll.defects.push(0);
              });
            }
          },

          // Remove defect column
          removeDefectColumn(index) {
            if (this.defectColumns.length > 1) {
              this.defectColumns.splice(index, 1);
              this.rolls.forEach((roll) => {
                roll.defects.splice(index, 1);
                this.calculateRollDefectPoints(roll);
              });
              this.updateHeaderCalculations();
            } else {
              alert('Cannot remove the last defect column');
            }
          },

          // Summary calculations
          sum(field) {
            return this.rolls.reduce(
              (total, roll) => total + (parseFloat(roll[field]) || 0),
              0
            );
          },

          sumDefect(colIndex) {
            return this.rolls.reduce(
              (total, roll) => total + (parseInt(roll.defects[colIndex]) || 0),
              0
            );
          },

          sumDefectPoints() {
            return this.rolls.reduce(
              (total, roll) => total + (parseInt(roll.defectPoints) || 0),
              0
            );
          },

          // Update header calculations
          updateHeaderCalculations() {
            this.calculation.defectPoints = this.sumDefectPoints();
            this.calculation.inspectedYards = this.sum('qtyYds');
            this.calculateShipmentPoints();
          },

          // Calculate shipment points
          calculateShipmentPoints() {
            const { defectPoints, inspectedYards, cuttableWidth } =
              this.calculation;

            if (defectPoints > 0 && inspectedYards > 0 && cuttableWidth > 0) {
              const points =
                (defectPoints * 3600) / (inspectedYards * cuttableWidth);
              this.calculation.shipmentPoints = points.toFixed(5);
              this.calculation.passed = defectPoints <= 16;
            } else {
              this.calculation.shipmentPoints = '0.00000';
              this.calculation.passed = false;
            }
          },

          // Check if results should be shown
          shouldShowResults() {
            return (
              this.calculation.defectPoints > 0 &&
              this.calculation.inspectedYards > 0 &&
              this.calculation.cuttableWidth > 0
            );
          },

          // Get result text
          getResultText() {
            return this.calculation.defectPoints > 16 ? 'FAILED' : 'PASSED';
          },

          // Get result class
          getResultClass() {
            return this.calculation.defectPoints > 16
              ? 'bg-red-100 text-red-700'
              : 'bg-green-100 text-green-700';
          },

          // Photo upload functionality
          openPhotoUpload(index) {
            this.currentRollIndex = index;
            this.uploadedImages = [];
            this.showPhotoUpload = true;
          },

          handleImageUpload(event) {
            const files = Array.from(event.target.files);
            files.forEach((file) => {
              if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                  this.uploadedImages.push({
                    url: e.target.result,
                    remark: '',
                  });
                };
                reader.readAsDataURL(file);
              }
            });
          },

          removeUploadedImage(index) {
            this.uploadedImages.splice(index, 1);
          },

          savePhotos() {
            if (
              this.uploadedImages.length > 0 &&
              this.currentRollIndex !== null
            ) {
              this.uploadedImages.forEach((uploadedImage) => {
                const photo = {
                  image: uploadedImage.url,
                  remark: uploadedImage.remark || this.photoRemark,
                };

                if (!this.rolls[this.currentRollIndex].photos) {
                  this.rolls[this.currentRollIndex].photos = [];
                }

                this.rolls[this.currentRollIndex].photos.push(photo);
              });

              this.showPhotoUpload = false;
              this.uploadedImages = [];
              this.photoRemark = '';
            }
          },

          viewPhotos(index) {
            this.currentRollIndex = index;
            this.currentRollPhotos = this.rolls[index].photos || [];
            this.showViewPhotos = true;
          },

          // Delete photo from roll
          deletePhoto(rollIndex, photoIndex) {
            if (confirm('Are you sure you want to delete this photo?')) {
              this.rolls[rollIndex].photos.splice(photoIndex, 1);
              this.currentRollPhotos = this.rolls[rollIndex].photos || [];
              if (this.currentRollPhotos.length === 0) {
                this.showViewPhotos = false;
              }
            }
          },

          // Export to JSON function
          exportToJSON() {
            const data = {
              cuttableWidth: parseFloat(this.calculation.cuttableWidth) || 0,
              rows: this.rolls.map((roll) => {
                const inspection = this.defectColumns.map((column, index) => ({
                  name: column.name,
                  point: parseInt(roll.defects[index]) || 0,
                }));

                return {
                  id: roll.id,
                  rollNumber: roll.rollNumber,
                  qtyYds: parseFloat(roll.qtyYds) || 0,
                  qtyKg: parseFloat(roll.qtyKg) || 0,
                  physical_yds: parseFloat(roll.physicalYds) || 0,
                  inspection: inspection,
                  remark: roll.remark,
                  photo: roll.photos || [],
                };
              }),
            };

            const dataStr = JSON.stringify(data, null, 2);
            const dataBlob = new Blob([dataStr], { type: 'application/json' });
            const url = URL.createObjectURL(dataBlob);
            const link = document.createElement('a');
            link.href = url;
            link.download = 'qc-inspection-data.json';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            URL.revokeObjectURL(url);
          },
        }">
        <input type="hidden" x-modelable="{{$export}}" x-model="rolls" />
    <div class="w-full mx-auto overflow-hidden bg-white rounded-lg shadow-md">
      <!-- Header Calculation Section -->
      <div class="overflow-x-auto border-b">
        <table class="w-full border-collapse">
          <thead>
            <tr class="text-white bg-blue-600">
              <th class="p-2 text-sm font-semibold text-center">
                Total defect points
              </th>
              <th class="p-2 text-sm font-semibold text-center"></th>
              <th class="p-2 text-sm font-semibold text-center"></th>
              <th class="p-2 text-sm font-semibold text-center"></th>
              <th class="p-2 text-sm font-semibold text-center">
                Total inspected yds
              </th>
              <th class="p-2 text-sm font-semibold text-center"></th>
              <th class="p-2 text-sm font-semibold text-center">
                Cuttable Width
              </th>
              <th class="p-2 text-sm font-semibold text-center"></th>
              <th class="p-2 text-sm font-semibold text-center">
                Shipment Points
              </th>
              <th class="p-2 text-sm font-semibold text-center"></th>
              <th class="p-2 text-sm font-semibold text-center">RESULTS</th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-white">
              <td class="p-2">
                <input
                  type="number"
                  x-model="calculation.defectPoints"
                  readonly
                  class="w-full px-2 py-2 font-semibold text-center text-gray-800 bg-gray-200 focus:outline-none"
                />
              </td>
              <td class="p-2 text-center">
                <span class="text-xl font-bold text-gray-700">×</span>
              </td>
              <td class="p-2">
                <div
                  class="w-full px-2 py-2 font-semibold text-center text-gray-800"
                >
                  3600
                </div>
              </td>
              <td class="p-2 text-center">
                <span class="text-xl font-bold text-gray-700">/</span>
              </td>
              <td class="p-2">
                <input
                  type="number"
                  x-model="calculation.inspectedYards"
                  readonly
                  class="w-full px-2 py-2 font-semibold text-center text-gray-800 bg-gray-200 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                />
              </td>
              <td class="p-2 text-center">
                <span class="text-xl font-bold text-gray-700">×</span>
              </td>
              <td class="p-2">
                <input
                  type="number"
                  step="0.1"
                  x-model="calculation.cuttableWidth"
                  @input="calculateShipmentPoints()"
                  class="w-full px-2 py-2 font-semibold text-center text-gray-800 bg-white border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                  placeholder="Enter width"
                />
              </td>
              <td class="p-2 text-center">
                <span class="text-xl font-bold text-gray-700">=</span>
              </td>
              <td class="p-2">
                <input
                  type="text"
                  x-model="calculation.shipmentPoints"
                  readonly
                  class="w-full px-2 py-2 font-bold text-center text-gray-800 bg-yellow-100 border border-yellow-400 rounded focus:outline-none"
                />
              </td>
              <td class="p-2 text-center"></td>
              <td class="p-2">
                <div class="flex items-center justify-center">
                  <template x-if="shouldShowResults()">
                    <span
                      x-text="getResultText()"
                      :class="getResultClass()"
                      class="px-3 py-1 text-sm font-bold rounded whitespace-nowrap"
                    ></span>
                  </template>
                  <template x-if="!shouldShowResults()">
                    <span
                      class="px-3 py-1 text-sm text-gray-400 whitespace-nowrap"
                      >-</span
                    >
                  </template>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Remarks Section -->
      <div class="p-4 bg-white border-t border-b">
        <p class="text-xs leading-relaxed text-gray-700">
          <span class="font-bold">REMARKS:</span> DEFECTS OF &lt;3"=1POINT,
          3-6"=2POINTS, 6-9"=3POINTS, &gt;9"=4POINTS.
          <span class="font-bold text-red-600"
            >IF MORE THAN 16 POINTS FAIL INSPECTION.</span
          >
          PRE-PRODUCTION EXECUTIVE TO WORK ON CLAIMS AND SUBMIT REPORT TO MR
        </p>
      </div>

      <!-- Inspection Data Entry Section -->
      <div class="bg-white">
        <!-- Roll Statistics -->
        <div class="p-3 bg-gray-100 border-b">
          <p class="text-sm font-bold text-gray-800">
            TOTAL ROLL:
            <span class="font-semibold" x-text="rolls.length"></span>
            &nbsp;&nbsp;&nbsp; MIN CHECK ROLL:
            <span class="font-semibold">1</span>
          </p>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto">
          <div class="table-container">
            <table class="w-full border-collapse">
              <thead>
                <tr>
                  <th
                    colspan="8"
                    class="p-2 text-sm font-semibold text-white bg-indigo-600 border-r"
                  >
                    <div class="flex items-center justify-between">
                      <span>FOR THE ROLL</span>
                      <div class="flex gap-2">
                        <button
                          @click="showRollSelection = true"
                          class="flex items-center gap-1 px-3 py-1 text-xs font-semibold text-white bg-indigo-700 rounded hover:bg-indigo-800"
                        >
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                            />
                          </svg>
                          Select Roll
                        </button>
                        <button
                          @click="addEmptyRoll()"
                          class="flex items-center gap-1 px-3 py-1 text-xs font-semibold text-white bg-green-600 rounded hover:bg-green-700"
                        >
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                            />
                          </svg>
                          Add
                        </button>
                      </div>
                    </div>
                  </th>
                  <th
                    :colspan="defectColumns.length + 2"
                    class="p-2 text-sm font-semibold text-white bg-red-600"
                  >
                    <div class="flex items-center justify-between">
                      <span>INSPECTION</span>
                      <button
                        @click="addDefectColumn()"
                        class="flex items-center gap-1 px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded hover:bg-blue-600"
                        title="Add Defect Column"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="w-4 h-4"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                          />
                        </svg>
                        Add
                      </button>
                    </div>
                  </th>
                </tr>
                <tr>
                  <th
                    class="w-20 p-2 text-xs font-semibold text-center text-white bg-indigo-400 border-r"
                  ></th>
                  <th
                    class="w-32 p-2 text-xs font-semibold text-center text-white bg-indigo-400 border-r"
                  >
                    MM Code
                  </th>
                  <th
                    class="w-32 p-2 text-xs font-semibold text-center text-white bg-indigo-400 border-r"
                  >
                    Roll Number
                  </th>
                  <th
                    class="w-24 p-2 text-xs font-semibold text-center text-white bg-indigo-400 border-r"
                  >
                    QTY YDS
                  </th>
                  <th
                    class="w-24 p-2 text-xs font-semibold text-center text-white bg-indigo-400 border-r"
                  >
                    QTY KG
                  </th>
                  <th
                    class="w-24 p-2 text-xs font-semibold text-center text-white bg-indigo-400 border-r"
                  >
                    QTY LBS
                  </th>
                  <th
                    class="w-24 p-2 text-xs font-semibold text-center text-white bg-indigo-400 border-r"
                  >
                    QTY Meter
                  </th>
                  <th
                    class="w-24 p-2 text-xs font-semibold text-center text-white bg-indigo-400 border-r"
                  >
                    Physical YDS
                  </th>
                  <template
                    x-for="(column, index) in defectColumns"
                    :key="index"
                  >
                    <th
                      class="w-20 p-2 text-xs font-semibold text-center text-white bg-red-500 border-r"
                    >
                      <div class="flex items-center justify-between px-1">
                        <span x-text="column.name" class="truncate"></span>
                        <button
                          @click="removeDefectColumn(index)"
                          class="flex-shrink-0 ml-1 text-red-200 hover:text-white"
                          title="Remove Column"
                        >
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-3 h-3"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"
                            />
                          </svg>
                        </button>
                      </div>
                    </th>
                  </template>
                  <th
                    class="w-24 p-2 text-xs font-semibold text-center text-white bg-red-500 border-r"
                  >
                    Defect Points
                  </th>
                  <th
                    class="w-32 p-2 text-xs font-semibold text-center text-white bg-red-500"
                  >
                    Remark
                  </th>
                </tr>
              </thead>
              <tbody>
                <template x-for="(roll, index) in rolls" :key="roll.id">
                  <tr class="transition-colors border-b hover:bg-gray-50">
                    <!-- Action Buttons -->
                    <td class="p-2 border-r bg-gray-50">
                      <div class="flex flex-col items-center gap-1">
                        <button
                          @click="openPhotoUpload(index)"
                          class="text-blue-600 hover:text-blue-800"
                          title="Upload Photo"
                        >
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"
                            />
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"
                            />
                          </svg>
                        </button>
                        <button
                          @click="viewPhotos(index)"
                          class="text-green-600 hover:text-green-800"
                          title="View Photos"
                        >
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                            />
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                            />
                          </svg>
                        </button>
                        <button
                          @click="removeRoll(index)"
                          class="text-red-600 hover:text-red-800"
                          title="Delete Roll"
                        >
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                            />
                          </svg>
                        </button>
                      </div>
                    </td>

                    <!-- FOR THE ROLL Data - Content Editable -->
                    <td class="p-1 bg-white border-r">
                      <div
                        x-text="roll.mmCode || 'MM Code'"
                        @blur="roll.mmCode = $event.target.textContent"
                        class="border-none content-editable hover:bg-blue-50"
                        contenteditable="true"
                      ></div>
                    </td>
                    <td class="p-1 bg-white border-r">
                      <div
                        x-text="roll.rollNumber || 'Roll No.'"
                        @blur="roll.rollNumber = $event.target.textContent"
                        class="border-none content-editable hover:bg-blue-50"
                        contenteditable="true"
                      ></div>
                    </td>
                    <td class="p-1 bg-white border-r">
                      <div
                        x-text="formatNumber(roll.qtyYds) || '0.000'"
                        @blur="updateRollField(roll, 'qtyYds', $event.target.textContent); convertYardsToOthers(roll); updateHeaderCalculations()"
                        class="border-none content-editable hover:bg-blue-50"
                        contenteditable="true"
                      ></div>
                    </td>
                    <td class="p-1 bg-white border-r">
                      <div
                        x-text="formatNumber(roll.qtyKg) || '0.000'"
                        @blur="updateRollField(roll, 'qtyKg', $event.target.textContent); convertKgToOthers(roll); updateHeaderCalculations()"
                        class="border-none content-editable hover:bg-blue-50"
                        contenteditable="true"
                      ></div>
                    </td>
                    <td class="p-1 bg-white border-r">
                      <div
                        x-text="formatNumber(roll.qtyLbs) || 'Auto'"
                        class="border-none content-editable readonly"
                        contenteditable="false"
                      ></div>
                    </td>
                    <td class="p-1 bg-white border-r">
                      <div
                        x-text="formatNumber(roll.qtyMeter) || 'Auto'"
                        class="border-none content-editable readonly"
                        contenteditable="false"
                      ></div>
                    </td>
                    <td class="p-1 bg-white border-r">
                      <div
                        x-text="formatNumber(roll.physicalYds) || '0.000'"
                        @blur="updateRollField(roll, 'physicalYds', $event.target.textContent); updateHeaderCalculations()"
                        class="border-none content-editable hover:bg-blue-50"
                        contenteditable="true"
                      ></div>
                    </td>

                    <!-- INSPECTION Data - Fixed Input Fields -->
                    <template
                      x-for="(column, colIndex) in defectColumns"
                      :key="colIndex"
                    >
                      <td class="p-1 bg-white border-r">
                        <input
                          type="text"
                          x-model="roll.defects[colIndex]"
                          @blur="calculateRollDefectPoints(roll); updateHeaderCalculations()"
                          class="border-none defect-input"
                          placeholder="0"
                        />
                      </td>
                    </template>

                    <!-- Defect Points Total -->
                    <td class="p-1 bg-white border-r">
                      <div
                        x-text="roll.defectPoints || '0'"
                        class="font-bold bg-yellow-100 border-yellow-400 border-none content-editable readonly"
                        contenteditable="false"
                      ></div>
                    </td>

                    <!-- Remark -->
                    <td class="p-1 bg-white">
                      <div
                        x-text="roll.remark || 'Remark'"
                        @blur="roll.remark = $event.target.textContent"
                        class="content-editable hover:bg-blue-50 min-h-[40px] border-none"
                        contenteditable="true"
                      ></div>
                    </td>
                  </tr>
                </template>

                <!-- SUM Row -->
                <tr
                  class="text-xs font-semibold text-black bg-green-100 border-t-2 border-green-500"
                >
                  <td class="p-2 text-center"></td>
                  <td class="p-2 text-center"></td>
                  <td class="p-2 text-center"></td>
                  <td
                    class="p-2 text-center border-r"
                    x-text="sum('qtyYds').toFixed(3)"
                  >
                    0.000
                  </td>
                  <td
                    class="p-2 text-center border-r"
                    x-text="sum('qtyKg').toFixed(3)"
                  >
                    0.000
                  </td>
                  <td
                    class="p-2 text-center border-r"
                    x-text="sum('qtyLbs').toFixed(3)"
                  >
                    0.000
                  </td>
                  <td
                    class="p-2 text-center border-r"
                    x-text="sum('qtyMeter').toFixed(3)"
                  >
                    0.000
                  </td>
                  <td
                    class="p-2 text-center border-r"
                    x-text="sum('physicalYds').toFixed(3)"
                  >
                    0.000
                  </td>
                  <template
                    x-for="(column, colIndex) in defectColumns"
                    :key="colIndex"
                  >
                    <td
                      class="p-2 text-center border-r"
                      x-text="sumDefect(colIndex)"
                    >
                      0
                    </td>
                  </template>
                  <td
                    class="p-2 text-center bg-yellow-200 border-r"
                    x-text="sumDefectPoints()"
                  >
                    0
                  </td>
                  <td class="p-2 text-center"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Roll Selection Modal -->
    <div
      x-show="showRollSelection"
      class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
    >
      <div class="w-full max-w-2xl bg-white rounded-lg shadow-xl">
        <div class="p-4 border-b">
          <h3 class="text-lg font-semibold">Select Roll from Database</h3>
        </div>
        <div class="p-4 overflow-y-auto max-h-96">
          <div class="grid grid-cols-1 gap-2">
            <template x-for="roll in sampleRolls" :key="roll.id">
              <div
                class="flex items-center justify-between p-3 border rounded cursor-pointer hover:bg-gray-50"
                @click="selectRollFromDB(roll)"
              >
                <div>
                  <div class="font-semibold" x-text="roll.mmCode"></div>
                  <div
                    class="text-sm text-gray-600"
                    x-text="roll.productName"
                  ></div>
                </div>
                <div
                  class="text-sm text-gray-500"
                  x-text="roll.rollNumber"
                ></div>
              </div>
            </template>
          </div>
        </div>
        <div class="flex justify-end gap-2 p-4 border-t">
          <button
            @click="showRollSelection = false"
            class="px-4 py-2 text-gray-600 hover:text-gray-800"
          >
            Cancel
          </button>
        </div>
      </div>
    </div>

    <!-- Photo Upload Modal -->
    <div
      x-show="showPhotoUpload"
      class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
    >
      <div class="w-full max-w-4xl bg-white rounded-lg shadow-xl">
        <div class="p-4 border-b">
          <h3 class="text-lg font-semibold">Upload Photos for Roll</h3>
        </div>
        <div class="p-4">
          <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-700"
              >Select Images (Multiple)</label
            >
            <input
              type="file"
              @change="handleImageUpload"
              accept="image/*"
              multiple
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>
          <div
            class="grid grid-cols-2 gap-4 mb-4 overflow-y-auto md:grid-cols-3 max-h-64"
            x-show="uploadedImages.length > 0"
          >
            <template x-for="(image, index) in uploadedImages" :key="index">
              <div class="p-2 border rounded-lg photo-container bg-gray-50">
                <img
                  :src="image.url"
                  class="object-cover w-full h-32 mb-2 rounded"
                />
                <button
                  @click="removeUploadedImage(index)"
                  class="delete-photo-btn"
                >
                  ×
                </button>
                <textarea
                  x-model="image.remark"
                  rows="2"
                  class="w-full px-2 py-1 text-xs border border-gray-300 rounded"
                  placeholder="Photo remark"
                ></textarea>
              </div>
            </template>
          </div>
          <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-700"
              >General Photo Remark</label
            >
            <textarea
              x-model="photoRemark"
              rows="3"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Enter general remark for these photos"
            ></textarea>
          </div>
        </div>
        <div class="flex justify-end gap-2 p-4 border-t">
          <button
            @click="showPhotoUpload = false; uploadedImages = []; photoRemark = ''"
            class="px-4 py-2 text-gray-600 hover:text-gray-800"
          >
            Cancel
          </button>
          <button
            @click="savePhotos()"
            :disabled="uploadedImages.length === 0"
            class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 disabled:bg-gray-400"
          >
            Save Photos
          </button>
        </div>
      </div>
    </div>

    <!-- View Photos Modal -->
    <div
      x-show="showViewPhotos"
      class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
    >
      <div
        class="bg-white rounded-lg shadow-xl w-full max-w-6xl max-h-[90vh] overflow-hidden"
      >
        <div class="flex items-center justify-between p-4 border-b">
          <h3 class="text-lg font-semibold">Photos for Roll</h3>
          <button
            @click="showViewPhotos = false"
            class="text-gray-500 hover:text-gray-700"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="w-6 h-6"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </button>
        </div>
        <div class="p-4 overflow-y-auto max-h-[calc(90vh-120px)]">
          <template x-if="currentRollPhotos && currentRollPhotos.length > 0">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
              <template
                x-for="(photo, index) in currentRollPhotos"
                :key="index"
              >
                <div class="p-3 border rounded-lg photo-container bg-gray-50">
                  <img
                    :src="photo.image"
                    class="object-contain w-full h-48 mb-2"
                  />
                  <div
                    class="mb-2 text-sm text-gray-600"
                    x-text="photo.remark || 'No remark'"
                  ></div>
                  <button
                    @click="deletePhoto(currentRollIndex, index)"
                    class="flex items-center justify-center w-full gap-1 px-3 py-1 text-xs text-white bg-red-500 rounded hover:bg-red-600"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="w-3 h-3"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                      />
                    </svg>
                    Delete Photo
                  </button>
                </div>
              </template>
            </div>
          </template>
          <template x-if="!currentRollPhotos || currentRollPhotos.length === 0">
            <div class="py-8 text-center text-gray-500">
              No photos uploaded for this roll
            </div>
          </template>
        </div>
      </div>
    </div>
</div>
