<?php

namespace Modules\ProcessQCModule\Http\Livewire\AssemblySewingOnline\InlineDefect;

use App\Models\Buyer;
use App\Models\Style;
use App\Models\Location;
use Livewire\Component;
use Illuminate\Support\Arr;

use App\Library\GetValueTextList;
use App\Models\Color;
use App\Models\PurchaseOrder;
use App\Models\StyleColor;
use App\Models\StylePurchaseOrder;
use Modules\ProcessQCModule\Entities\PQI;
use Modules\ProcessQCModule\Entities\PQI\Defect;

class Inspector extends Component
{
    public array $buyer = [] , $style = [] ,$purchase_order = [] , $defect = [] , $color = [] , $workstation_locate = [] ;
    public array $buyers = [], $styles = [],$purchase_orders = [], $defects = [], $colors = [], $workstation_locates = [];

    public function boot()
    {
        $this->colors = GetValueTextList::convert(Color::get());
        $this->buyers = GetValueTextList::convert(Buyer::get());
        $this->workstation_locates = GetValueTextList::convert(Location::get());
        $this->defects = PQI\Defect::with('defects')->where('parent_id',null)->get()->toArray();
    }

    public function updatedBuyer($param)
    {
        $styles = Style::where('buyer_id',Arr::get($param,'value'))->get();
        $this->styles = GetValueTextList::convert($styles);
    }

    public function updatedStyle($param)
    {
        $colors = StyleColor::where('style_id',Arr::get($param,'value'))->get()->pluck('color');
        $this->colors = GetValueTextList::convert($colors);
        $purchase_orders = StylePurchaseOrder::where('style_id',Arr::get($param,'value'))->get()->pluck('purchaseOrder');
        $this->purchase_orders = $purchase_orders->map(fn($item)=>['value'=>$item->id,'text'=>$item->no])->toArray();
    }

    public function render()
    {
        return view('processqcmodule::livewire.assembly-sewing-online.inline-defect.inspector');
    }
}
