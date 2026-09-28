<?php

namespace Modules\ProcessQCModule\Http\Livewire\AssemblySewingOnline\EndlineAudit\InlineInspection;

use Modules\ProcessQCModule\Entities\Inspection;
use App\Library\GetValueTextList;
use App\Models\Style;
use App\Models\StyleProfile;
use App\Models\WorkstaionLocate;
use App\Models\StylePurchaseOrder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Inspector extends Component
{

    public array $style = [], $version = [], $line = [];
    public array $styles = [], $purchase_orders = [], $versions = [], $colors = [], $sizes = [], $lines = [];

    public function boot()
    {
        $this->styles = GetValueTextList::convert(Style::get());
        $this->lines = GetValueTextList::convert(WorkstaionLocate::where('is_day_shift',true)->where('workstation_locates_type_id',1)->get());
    }

    public function updatedStyle()
    {
        $style_id = Arr::get($this->style,'value');

        $purchaseOrders = StylePurchaseOrder::with('style','purchaseOrder')
            ->where('styles_id',$style_id)
            ->get()->map(fn($i)=>['value'=>$i->purchaseOrder->id,'text'=>$i->purchaseOrder->no]);
        $this->purchase_orders = $purchaseOrders->toArray();

        $versions = StyleProfile\Version::where('style_id',$style_id);
        $this->versions = GetValueTextList::convert($versions->get()->map(fn($i)=>$i->version));
    }

    public function updatedVersion()
    {
        $version_id = Arr::get($this->version,'value');

        $colors = StyleProfile\Color::where('style_profile_id',$version_id);
        $this->colors = GetValueTextList::convert($colors->get()->map(fn($i)=>$i->color));

        $sizes = StyleProfile\Size::where('style_profile_id',$version_id);
        $this->sizes = GetValueTextList::convert($sizes->get()->map(fn($i)=>$i->size));
    }

    public function render()
    {
        return view('processqcmodule::livewire.assembly-sewing-online.endline-audit.inline-inspection.inspector');
    }

    public function submitPass($data,$garmentCode)
    {
        $this->recordTransaction($data,$garmentCode,true);
    }

    public function submitReject($data,$garmentCode)
    {
        $this->recordTransaction($data,$garmentCode,false);
    }

    protected function findBinTicket($garmentCode)
    {
        return DB::table('tblticket_info')->where('ticketID',$garmentCode)->first();
    }

    protected function findStyleProfile()
    {
        return StyleProfile::where([
            'style_id'=>Arr::get($this->style,'value'),
            'version_id'=>Arr::get($this->version,'value')
        ])->first();
    }

    protected function recordTransaction($data,$garmentCode,$status)
    {
        Arr::set($endlineProfileItem,'inspector_id',1);
        Arr::set($endlineProfileItem,'style_profile_id',$this->findStyleProfile()->id);
        Arr::set($endlineProfileItem,'workstation_locates_id', Arr::get($data,'line.value'));
        Arr::set($endlineProfileItem,'purchase_order_id',Arr::get($data,'purchase_order.value'));
        $endline_profile = Inspection\Endline\ProfileEntity::updateOrCreate($endlineProfileItem,$endlineProfileItem);

        Arr::set($endlineInspectItem,'insp_endline_profile_id',$endline_profile->id);
        Arr::set($endlineInspectItem,'sizes_id',Arr::get($data,'size.value'));
        Arr::set($endlineInspectItem,'color_id',Arr::get($data,'color.value'));
        Arr::set($endlineInspectItem,'is_pass',$status);
        Arr::set($endlineInspectItem,'is_repair',!$status);
        Arr::set($endlineInspectItem,'item_no',$garmentCode);
        $endline_item = Inspection\Endline\ItemEntity::create($endlineInspectItem);

        Arr::set($garmentTrackingItem,'garmentQrCode',$garmentCode);
        Arr::set($garmentTrackingItem,'bin_tickets_id',$this->findBinTicket($garmentCode)->tktd_id);
        $garment_tracking = Inspection\GarmentTracking\RootEntity::updateOrCreate($garmentTrackingItem,$garmentTrackingItem);

        Arr::set($garmentTrackingEndline,'garment_tracking_id',$garment_tracking->id);
        Arr::set($garmentTrackingEndline,'insp_endline_item_id',$endline_item->id);
        $garement_tracking_endline = Inspection\GarmentTracking\EndlineEntity::updateOrCreate($garmentTrackingEndline,$garmentTrackingEndline);

        Arr::set($garmentTrackingTransaction,'module','endline');
        Arr::set($garmentTrackingTransaction,'garment_tracking_id',$garment_tracking->id);
        Arr::set($garmentTrackingTransaction,'is_pass',$status);
        Arr::set($garmentTrackingTransaction,'locate',Arr::get($data,'line.value'));
        Arr::set($garmentTrackingTransaction,'inspector',1);
        $garment_tracking_transaction = Inspection\GarmentTracking\TransactionEntity::create($garmentTrackingTransaction);
    }
}
