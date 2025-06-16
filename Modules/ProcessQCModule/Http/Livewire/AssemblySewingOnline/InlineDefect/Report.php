<?php

namespace Modules\ProcessQCModule\Http\Livewire\AssemblySewingOnline\InlineDefect;

use App\Library\GetValueTextList;
use App\Models\Buyer;
use App\Models\Color;
use App\Models\PurchaseOrder;
use App\Models\StyleColor;
use App\Models\StylePurchaseOrder;
use Illuminate\Support\Arr;
use Livewire\Component;
use App\Models\Style;
use Modules\ProcessQCModule\Entities\PQI;

class Report extends Component
{

    public array $style=[], $workstation_locate=[], $purchase_order=[], $color=[], $buyer=[];
    public array $styles=[], $workstation_locates=[], $purchase_orders=[], $colors=[], $buyers=[];

    public function boot()
    {
        $this->styles = GetValueTextList::convert(PQI\Header::get()->pluck('style'));
    }

    public function updatedStyle($param)
    {
        $header = PQI\Header::where('style_id',$param)->get();

        $this->buyers = GetValueTextList::convert($header->pluck('buyer'));
        $this->buyer = GetValueTextList::mapping($header->pluck('buyer')->first());

        $this->purchase_orders = GetValueTextList::convert($header->pluck('purchaseOrder'));
        $this->purchase_order = GetValueTextList::mapping($header->pluck('purchaseOrder')->first());
    }

    public function dehydrate()
    {
        if(
            Arr::get($this->buyer,'value')
            && Arr::get($this->purchase_order,'value')
        ) {

            $items = PQI\Header::where([
                'style_id' => Arr::get($this->style, 'value'),
                'buyer_id' => Arr::get($this->buyer, 'value'),
                'purchase_order_id' => Arr::get($this->purchase_order, 'value'),
            ])->first()->items;


            $this->colors = GetValueTextList::convert($items->pluck('color'));
            $this->color = GetValueTextList::mapping($items->pluck('color')->first());

            $this->workstation_locates = GetValueTextList::convert($items->pluck('workstationLocate'));
            $this->workstation_locate = GetValueTextList::mapping($items->pluck('workstationLocate')->first());

        }
    }

    public function render()
    {
        return view('processqcmodule::livewire.assembly-sewing-online.inline-defect.report');
    }

    public function search($filter)
    {
        return PQI\Defect::where('is_defect',true)->get()->toArray();
        return GetValueTextList::convert(PQI\Defect::where('is_defect',true)->get());
    }

    public function filter()
    {

    }

    public function submit($data)
    {
        foreach($data as $item){
            PQI\Defect::where('id',Arr::get($item,'value'))
                ->update(['is_defect'=>!Arr::get($item,'is_not_defect')]);
        }
    }

    protected function dataFilter()
    {
        return PQI\Header::with('items.defects.defect.serverity')->get()->toArray();
    }
}
