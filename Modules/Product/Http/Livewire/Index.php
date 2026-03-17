<?php

namespace Modules\Product\Http\Livewire;

use Illuminate\Support\Arr;
use Livewire\Component;
use Modules\Product\Entities\Product;

class Index extends Component
{
    public function render()
    {
        return view('product::livewire.index');
    }

    public function load($page,$per_page,$filter)
    {
        return Product::with('image')->paginate($per_page,['*'],'page',$page)->toArray();
    }

    public function edit($id)
    {
        return Product::where('id',$id)->with('images')->first()->toArray();
    }

    public function update($id,$data)
    {

        $product_data = [
            'name' => Arr::get($data,'name'),
            'price' => Arr::get($data,'price'),
            'discount' => Arr::get($data,'discount'),
            'in_stock' => Arr::get($data,'in_stock'),
            'out_stock' => Arr::get($data,'out_stock'),
            'is_available' => Arr::get($data,'is_available'),
            'release_date' => Arr::get($data,'release_date'),
        ];

        $product = Product::where('id',$id)->first();
        $product_images = collect(Arr::get($data,'images'))
            ->map(fn($item,$indx)=>['sort'=>++$indx,'product_id'=>$product->id,'file_path'=>Arr::get($item,'file_path')]);

        $product->update($product_data);
        $product->images()->delete();
        $product->images()->createMany($product_images);
    }

}
