<?php

namespace Modules\ProcessQCModule\Entities\PQI;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\ProcessQCModule\Database\factories\PQI/ItemFactory::new();
    }
}
