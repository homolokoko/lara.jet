<?php

namespace App\Http\Controllers\Library\Repositories;

use App\Models\Configure\Color;
use Illuminate\Support\Collection;
use App\Models\Configure\Styles;
use App\Models\Configure\StyleColor;

class ColorRepository
{
    public function process(Collection $orderInfo, Styles $style): void
    {
        $colors = $this->extractColors($orderInfo);
        foreach ($colors as $color) {
            if(!$color['colorname'] || !$color['colorID']){
                continue;
            }
            $colorInstance = $this->updateOrCreateColor($color);
            $this->updateOrCreateStyleColor($colorInstance, $style);
        }
    }
    private function updateOrCreateColor($colors): Color
    {
        return Color::updateOrCreate([
            'name'=> $colors['colorname']
        ], [
            'name'=> $colors['colorname'],
            'ezi_colorID'=>$colors['colorID'],
        ]);
    }
    private function updateOrCreateStyleColor(Color $colors, Styles $style)
    {
        StyleColor::updateOrCreate(
            ['style_id'=>$style->id, 'color_id'=>$colors->id],
            ['style_id'=>$style->id,'color_id'=>$colors->id]
        );
    }
    private function extractColors(Collection $orderInfo): Collection
    {
        return $orderInfo->pluck('colorname', 'colorID')
            ->unique()
            ->mapWithKeys(function ($value, $key) {
                return [$key => [
                    'colorname' => $value,
                    'colorID' => $key
                ]];
            });
    }
}
