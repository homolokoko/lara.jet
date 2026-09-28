<?php

namespace App\Http\Controllers\Library\Repositories;

use App\Models\Configure\Buyers;
use App\Models\Configure\Styles;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class StyleRepository
{
    public function createWithBuyer(array $styleData, Buyers $buyer): Styles
    {
        return Styles::updateOrCreate(
            ['name' => Arr::get($styleData, 'name')],
            [
                'name' => Arr::get($styleData, 'name'),
                'type' => Arr::get($styleData, 'type'),
                'buyers_id' => $buyer->id
            ]
        );
    }
    public function markAsProcessed(array $styleData): void
    {
        $columnName = $styleData['type'] === 'style' ? 'styleno' : 'orderno';
        DB::table('tblorder_info')
            ->where($columnName, '=', $styleData['name'])
            ->update(['statusID_qms' => true]);
    }
}
