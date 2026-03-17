<?php

namespace App\Http\Controllers\Library\Repositories;

use App\Models\Configure\StylesProductDesc;
use App\Models\Configure\Styles;
use Illuminate\Support\Collection;

class ProductRepository
{
    public function process(Collection $orderInfo, Styles $style): void
    {
        foreach ($orderInfo as $order){
            $this->updateOrCreate($order->producttype, $style->id);
        }
    }
    private function updateOrCreate($description,$id): StylesProductDesc
    {
        if(!$description){
            $description = 'NONE';
        }
        return StylesProductDesc::updateOrCreate([
            'name'=> $description,
            'style_id'=>$id
        ], [
            'name'=> $description,
            'style_id'=>$id
        ]);
    }
}
