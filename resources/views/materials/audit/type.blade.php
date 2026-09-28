<x-app-layout>

    <x-slot name="title">Warehouse Trim Audit (sewing & Packaging)</x-slot>


    <div x-data="{
        checkList:null,
        leatherMeasurement:null,
        materialInfoForm:null,
        skinComponent:null,
        qualityControlSystem:null,
        columnIndex:0,
        columns:[{label:'checklist'},{label:'leather-measurement'},{label:'material-info-form'},{label:'skin-component'},{label:'quality-control-system'}],
        async submit(){
            await console.log(
                'form-submit',
                {
                    checkList:this.checkList,
                    leatherMeasurement:this.leatherMeasurement,
                    materialInfoForm:this.materialInfoForm,
                    skinComponent:this.skinComponent,
                    qualityControlSystem:this.qualityControlSystem
                }
            );
        }

    }">

        <div class="w-fulll">
            <div x-show="columnIndex===0" id="item1" class="w-full pt-20">
                <x-materials.checklist export="checkList"></x-materials.checklist>
            </div>
            <div x-show="columnIndex===1" id="item2" class="w-full pt-20">
                <x-materials.leather-measurement export="leatherMeasurement"></x-materials.leather-measurement>
            </div>
            <div x-show="columnIndex===2" id="item3" class="w-full pt-20">
                <x-materials.material-info-form export="materialInfoForm"></x-materials.material-info-form>
            </div>
            <div x-show="columnIndex===3" id="item4" class="w-full pt-20">
                <x-materials.skin-component export="skinComponent"></x-materials.skin-component>
            </div>
            <div x-show="columnIndex===4" id="item4" class="w-full pt-20">
                <x-materials.quality-control-system export="qualityControlSystem"></x-materials.quality-control-system>
            </div>
        </div>

        <div class="flex justify-center w-full py-y space-x2">
            <button @click="submit" class="btn btn-xl btn-primary">Submit</button>
        </div>

    </div>

</x-app-layout>
