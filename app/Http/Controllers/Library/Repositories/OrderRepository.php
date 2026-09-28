<?php

namespace App\Http\Controllers\Library\Repositories;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

class OrderRepository
{
    public function findByColumn(string $column, string $value): Collection
    {
        return DB::query()
            ->from('tblorder_info')
            ->where($column, '=', $value)
            ->get();
    }

    /**
     * @throws Throwable
     */
    public function markAsProcessed(array $data)
    {
        $columnName =  $this->getOrderType($data);
        $value =  $this->getValue($data);
        throw_if($value == null, 'invalid data');
        DB::table('tblorder_info')
            ->where($columnName, '=', $value)
            ->update(['statusID_qms'=>true ]);
    }
    public function getOrderType(array $dataType)
    {
        return $dataType['type'] === 'style' ? 'styleno' : 'orderno';
    }
    public function getValue(array $dataType)
    {
        return Arr::get($dataType, 'name', null);
    }
}
