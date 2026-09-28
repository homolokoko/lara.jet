<?php

namespace App\Http\Livewire\Management\Style;

use App\Library\GetValueTextList;
use App\Models\Configure\Buyers;
use App\Models\Configure\Styles;
use Illuminate\Support\Arr;
use Livewire\Component;

class Table extends Component
{
    public array $styles;
    public array $buyers;

    public function boot()
    {
        $this->buyers = (new GetValueTextList)->convert(Buyers::get());
    }

    public function render()
    {
        return view('livewire.management.style.table');
    }

    public function loadData($page,$filter)
    {
        $query = Styles::with('buyer');
        if($filter['style'])
            $query->where('name','like','%'.$filter['style'].'%');
        if($filter['buyer'])
            $query->where('buyers_id',$filter['buyer']);
        $pages = ceil($query->count()/10);
        return $query->orderBy('id','desc')
            ->paginate(15, ['*'], 'page', $page)
            ->through(function($sty){
                $id = $sty->id;
                $name = $sty->name;
                $buyer = $sty->buyer;
                $profile = $sty->profile()->exists();
                $size = $sty->profileSize()->exists();
                $color = $sty->profileColor()->exists();
                $operation_code = $sty->jobseqs()->exists();
                $purchase_order = $sty->purchaseOrder()->exists();
                $sketch = $sty->profileApparelName()->exists();
                $panel = $sty->cuttingPanel()->exists();
                return compact('id','name','buyer','profile','size','color','panel','sketch','operation_code','purchase_order');
            })->toArray();
    }

    public function show($id)
    {
        return Styles::where('id',$id)->first()->toArray();
    }

    public function create($data)
    {
        $setCreateData = [
            'name'=>Arr::get($data,'name'),
            'buyers_id'=>Arr::get($data,'buyers_id')
        ];

        return Styles::create($setCreateData);
    }

    public function update($data)
    {
        $setUpdateData = [
            'name'=>Arr::get($data,'name'),
            'buyers_id'=>Arr::get($data,'buyers_id')
        ];

        return Styles::where('id',Arr::get($data,'id'))->update($setUpdateData);
    }

}
