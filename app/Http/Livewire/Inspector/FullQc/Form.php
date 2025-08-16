<?php

namespace App\Http\Livewire\Inspector\FullQc;

use App\Models\User;
use App\Models\Cause;
use App\Models\Style;
use App\Models\Defects;
use Livewire\Component;
use App\Models\Location;
use Illuminate\Support\Arr;
use App\Library\ListController;
use App\Models\GarmentTracking;
use App\Library\Fullqc\Inspection\Base;
use Illuminate\Support\Facades\Auth;

class Form extends Component
{
    public $module;

    public function render()
    {
        return view('livewire.inspector.full-qc.form');
    }

    public function information()
    {
        $styles = (new ListController)->generate(Style::get());
        $defects = (new ListController)->generate(Defects::get());
        $defect_causes = (new ListController)->generate(Cause::get());
        $workstation_locates = (new ListController)->generate(Location::get());
        $supervisors = User::get()->map(
            fn($item)=>['value'=>$item->id,'text'=>implode(' ',array($item->email,$item->name))]
        );
        $garment_codes = GarmentTracking::limit('1000')->get()->map(fn($i)=>$i->garmentQrCode)->toArray();
        return compact('styles','defects','supervisors','defect_causes','workstation_locates','garment_codes');
    }

    public function updateStyle($v)
    {

        $styleClass = \App\Models\Style::where('id',$v)->first();
        $purchase_orders = $styleClass->purchaseOrders
            ->map(fn($i)=>['value'=>$i->id,'text'=>$i->no])->toArray();
        $profiles = $styleClass->styleProfiles
            ->map(function($profile){
                return [
                    'value'=>$profile->id,
                    'text'=>$profile->version->name,
                    'sizes'=>$profile->profileSizes->map(function($profileSize){
                        return [
                            'value'=>$profileSize->size_id,
                            'text'=>$profileSize->size->name,
                        ];
                    })->toArray(),
                    'colors'=>$profile->profileColors->map(function($profileColor){
                        return [
                            'value'=>$profileColor->color_id,
                            'text'=>$profileColor->color->name,
                        ];
                    })->toArray(),
                    'apparels'=>$profile->profileApparels->map(function($profileApparel){
                        return [
                            'value'=>$profileApparel->style_apparel_id,
                            'text'=>$profileApparel->apparel->name,
                            'checkpoints'=>$profileApparel->apparel->checkpoints
                                ->map(fn($checkpoint)=>['value'=>$checkpoint->id,'text'=>$checkpoint->name])->toArray(),
                        ];
                    })->toArray()
                ];
            })->toArray();
        return compact('profiles','purchase_orders');
    }

    public function detectGarmentCode($code)
    {
        $base = new Base($this->module);
        return $base->detectGarmentCode($code);
    }

    public function submitAcceptItem($info)
    {
        $base = new Base($this->module);
        $profile_data = array(
            'location_id'=>Arr::get($info,'workstation_locate.value'),
            'style_profile_id'=>Arr::get($info,'profile.value'),
            'purchase_order_id'=>Arr::get($info,'purchase_order.value'),
            'inspector_id'=>Auth::user()->id,
        );
        $profile = $base->setProfile($profile_data,$status=true);
        $item_data = array(
            'is_pass'=>true,
            'is_repair'=>false,
            'fullqc_profile_id'=>$profile->id,
            'size_id'=>Arr::get($info,'size.value'),
            'color_id'=>Arr::get($info,'color.value'),
            'garment_tracking_id'=>Arr::get($info,'garment_id')
        );
        $item = $base->setItem($item_data,$status=true);

    }

    public function submitRepairGarment($info,$sketch)
    {
        $base = new Base($this->module);
        $profile_data = array(
            'location_id'=>Arr::get($info,'workstation_locate.value'),
            'style_profile_id'=>Arr::get($info,'profile.value'),
            'purchase_order_id'=>Arr::get($info,'purchase_order.value'),
            'inspector_id'=>Auth::user()->id,
        );
        $profile = $base->setProfile($profile_data,$status=false);
        $item_data = array(
            'is_pass'=>false,
            'is_repair'=>true,
            'fullqc_profile_id'=>$profile->id,
            'size_id'=>Arr::get($info,'size.value'),
            'color_id'=>Arr::get($info,'color.value'),
            'garment_tracking_id'=>Arr::get($info,'garment_id')
        );
        $item = $base->setItem($item_data,$status=false);
        $item_repair_data = array(
            'fullqc_item_id'=>$item->id,
            'checkpoint_id'=>Arr::get($sketch,'checkpoint.value'),
            'defect_id'=>Arr::get($sketch,'defect.value'),
            'defect_cause_id'=>Arr::get($sketch,'defect_cause.value'),
            'style_profile_id'=>Arr::get($info,'profile.value'),
            'style_profile_apparel_id'=>Arr::get($info,'apparel.value'),
            'operator_id'=>Arr::get($info,'supervisor.value')
        );
        $itemRepair = $base->setItemRepair($item_repair_data);
    }
}
