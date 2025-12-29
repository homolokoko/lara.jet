<?php

namespace App\Http\Controllers\Library\Repositories;

use App\Models\Configure\Buyers;
use Illuminate\Support\Arr;

class BuyerRepository
{
    public function updateOrCreate(array $buyerData): Buyers
    {
        return Buyers::updateOrCreate(
            ['name' => Arr::get($buyerData, 'text')],
            ['name' => Arr::get($buyerData, 'text')]
        );
    }
}
