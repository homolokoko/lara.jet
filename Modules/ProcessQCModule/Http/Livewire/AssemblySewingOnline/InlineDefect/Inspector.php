<?php

namespace Modules\ProcessQCModule\Http\Livewire\AssemblySewingOnline\InlineDefect;

use App\Models\Buyer;
use App\Models\Style;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Arr;

use App\Library\GetValueTextList;
use App\Library\UploadBase64Image;
use App\Models\Color;
use App\Models\PurchaseOrder;
use App\Models\StyleColor;
use App\Models\StylePurchaseOrder;
use Modules\ProcessQCModule\Entities\PQI;
use Modules\ProcessQCModule\Entities\PQI\Defect;

class Inspector extends Component
{
    public array $orderno = [], $buyer = [] , $style = [] ,$purchase_order = [] , $defect = [] , $color = [] , $workstation_locate = [] ;
    public array $ordernos =[], $buyers = [], $styles = [],$purchase_orders = [], $defects = [], $colors = [], $workstation_locates = [];

    public function boot()
    {
        $this->styles = GetValueTextList::convert(Style::get());
        $this->ordernos = GetValueTextList::convert(Style::get());
        $this->workstation_locates = GetValueTextList::convert(Location::get());

    }

    public function updatedOrderno($param)
    {
        $this->autoFill($param);
    }


    public function render()
    {
        return view('processqcmodule::livewire.assembly-sewing-online.inline-defect.inspector');
    }

    protected function autoFill($param)
    {
        $orderno = Style::where('id',$param)->first();

        $this->colors = GetValueTextList::convert($orderno->colors);
        $this->purchase_orders = GetValueTextList::convert($orderno->purchaseOrders);

        $this->buyer = GetValueTextList::mapping($orderno->buyer);
        $this->color = GetValueTextList::mapping($orderno->colors->first());
        $this->purchase_order = GetValueTextList::mapping($orderno->purchaseOrders->first());
        $this->defects = PQI\Defect::with('defects.defects')->where(['parent_id'=>null,'buyer_id'=>$orderno->buyer->id])->get()->toArray();
        return;
    }
    public function recordDefect($filter,$pqiDefects)
    {
        $headerData = array(
            'buyer_id'=>Arr::get($filter,'buyer.value'),
            'style_id'=>Arr::get($filter,'style.value'),
            'purchase_order_id'=>Arr::get($filter,'purchase_order.value')
        );
        $header = PQI\Header::updateOrCreate($headerData,$headerData);

        $item = PQI\Item::create([
            'desc'=> Arr::get($filter,'desc',null),
            'pqi_header_id'=>$header->id,
            'workstation_locate_id'=>Arr::get($filter,'workstation_locate.value'),
            'color_id'=>Arr::get($filter,'color.value'),
            'inspector_id'=>Auth::user()->id
        ]);

        foreach($pqiDefects as $defect):
            Arr::set($defectData,'pqi_item_id', $item->id);
            Arr::set($defectData,'pqi_defect_id',Arr::get($defect,'defect.value'));
            Arr::set($defectData,'photo',UploadBase64Image::upload(Arr::get($defect,'img'),'pqi'));
            PQI\ItemDefect::create($defectData);
            endforeach;
    }
}
