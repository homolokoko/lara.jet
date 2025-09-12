<?php

namespace App\Http\Livewire\Inspector\FullQc;

use App\Library\GetValueTextList;
use App\Models\User;
use Livewire\Component;
use App\Models\Location;
use Illuminate\Support\Arr;
use App\Library\ListController;
use App\Models\GarmentTracking;
use App\Library\Fullqc\Inspection\Base;
use Illuminate\Support\Facades\Auth;
use App\Models\Configure\Styles;
use App\Models\Configure\Defects;
use App\Models\Configure\Defect\Cause;
use App\Models\Configure\WorkstationLocate;

class Form extends Component
{
    public $mode_type,
        $mode_title,
        $view_type,
        $view_title;

    public function mount($mode,$report_view)
    {
        $base = new Base($mode,$report_view);
        $this->mode_type = $base->mode_type;
        $this->mode_title = $base->mode_title;
        $this->view_type = $base->view_type;
        $this->view_title = $base->view_title;
    }

    public function render()
    {
        return view('livewire.inspector.full-qc.form');
    }

    public function information()
    {
        $styles = (new ListController)->generate(Styles::get());
        $defects = (new ListController)->generate(Defects::get());
        $defect_causes = (new ListController)->generate(Cause::get());
        $workstation_locates = (new ListController)->generate(WorkstationLocate::sewLineShiftType(true)->get());
        $supervisors = User::get()->map(
            fn($item)=>['value'=>$item->id,'text'=>implode(' ',array($item->email,$item->name))]
        );
        $garment_codes = GarmentTracking::limit('1000')->get()->map(fn($i)=>$i->garmentQrCode)->toArray();
        return compact('styles','defects','supervisors','defect_causes','workstation_locates','garment_codes');
    }

    public function updateStyle($v)
    {

        $styleClass = Styles::where('id',$v)->first();
        $purchase_orders = $styleClass->purchaseOrder
            ->map(fn($i)=>['value'=>$i->id,'text'=>$i->no])->toArray();

        $profiles = $styleClass->profile
            ->map(function($profile){
                return [
                    'value'=>$profile->id,
                    'text'=>$profile->version->name,
                    'sizes'=>$profile->sizeName->map(function($profileSize){
                        return [
                            'value' => $profileSize->id,
                            'text' => $profileSize->name,
                        ];
                    })->toArray(),
                    'colors'=>$profile->colorsName->map(function($profileColor){
                        return [
                            'value' => $profileColor->id,
                            'text' => $profileColor->name,
                        ];
                    })->toArray(),
                    'apparels'=>$profile->apparel->map(function($profileApparel){
                        return [
                            'value'=>$profileApparel->styles_apparels_id,
                            'text'=>$profileApparel->styleApparel->name,
                            'image'=>$profileApparel->styleApparel->image,
                            'checkpoints'=>$profileApparel->styleApparel->checkpoint->map(
                                fn($checkpoint)=>[
                                    'value'=>$checkpoint->check_points_id,
                                    'text'=>$checkpoint->name->name,
                                    'area'=>$checkpoint->number
                                ]
                            )->toArray(),
                        ];
                    })->toArray()
                ];
            })->toArray();
        return compact('profiles','purchase_orders');
    }

    public function detectGarmentCode($code)
    {
        return Base::detectGarmentCode($code);
    }

    public function submitAcceptItem($info)
    {
        $profile_data = array(
            'location_id'=>Arr::get($info,'workstation_locate.value'),
            'style_profile_id'=>Arr::get($info,'profile.value'),
            'purchase_order_id'=>Arr::get($info,'purchase_order.value'),
            'inspector_id'=>Auth::user()->id,
            'mode'=>$this->mode_type,
            'report_view'=>$this->view_type
        );
        $profile = Base::setProfile($profile_data,$status=true);
        $item_data = array(
            'is_pass'=>true,
            'is_repair'=>false,
            'fullqc_profile_id'=>$profile->id,
            'size_id'=>Arr::get($info,'size.value'),
            'color_id'=>Arr::get($info,'color.value'),
            'garment_tracking_id'=>Arr::get($info,'garment_id')
        );
        $item = Base::setItem($item_data,$status=true);

    }

    public function submitRepairGarment($info,$sketch)
    {
        $profile_data = array(
            'location_id'=>Arr::get($info,'workstation_locate.value'),
            'style_profile_id'=>Arr::get($info,'profile.value'),
            'purchase_order_id'=>Arr::get($info,'purchase_order.value'),
            'inspector_id'=>Auth::user()->id,
        );
        $profile = Base::setProfile($profile_data,$status=false);
        $item_data = array(
            'is_pass'=>false,
            'is_repair'=>true,
            'fullqc_profile_id'=>$profile->id,
            'size_id'=>Arr::get($info,'size.value'),
            'color_id'=>Arr::get($info,'color.value'),
            'garment_tracking_id'=>Arr::get($info,'garment_id')
        );
        $item = Base::setItem($item_data,$status=false);
        $item_repair_data = array(
            'fullqc_item_id'=>$item->id,
            'checkpoint_id'=>Arr::get($sketch,'checkpoint.value'),
            'defect_id'=>Arr::get($sketch,'defect.value'),
            'defect_cause_id'=>Arr::get($sketch,'defect_cause.value'),
            'style_profile_id'=>Arr::get($info,'profile.value'),
            'style_profile_apparel_id'=>Arr::get($info,'apparel.value'),
            'operator_id'=>Arr::get($info,'supervisor.value')
        );
        $itemRepair = Base::setItemRepair($item_repair_data);
    }
}
