<?php

namespace App\Http\Controllers\Library\Repositories;

use App\Models\Configure\Size;
use App\Models\Configure\Styles;
use App\Models\Configure\StyleSize;
use Illuminate\Support\Collection;

class SizeRepository
{
    public function process(Collection $orderInfo, Styles $style): void
    {
        $sizes = $orderInfo->pluck('size_name')->unique();
        foreach ($sizes as $size) {
            if(!$size){
                continue;
            }
            if($this->validate($size)){
                $sizeInstance = $this->updateOrCreateSize($size);
                $this->updateOrCreateStyleSize($sizeInstance, $style);
            }
        }
    }
    private function validate($size): bool
    {
        return ! ($size == 'NONE');
    }
    private function updateOrCreateSize($size): Size
    {
        return Size::updateOrCreate([
            'name'=> $size,
            'ezi_sizename'=>$size
        ], [
            'name'=> $size,
            'ezi_sizename'=>$size
        ]);
    }

    private function updateOrCreateStyleSize(Size $size, Styles $styles): void
    {
        StyleSize::updateOrCreate([
            'style_id'=>$styles->id,
            'size_id'=>$size->id
        ], [
            'style_id'=>$styles->id,
            'size_id'=>$size->id
        ]);
    }
}
