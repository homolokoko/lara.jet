<?php

namespace Modules\ProcessQCModule\Entities\PQI;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemDefect extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\ProcessQCModule\Database\factories\PQI/ItemDefectFactory::new();
    }
}
