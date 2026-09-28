<?php

namespace Modules\ProcessQCModule\Entities\Inspection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GarmentTrackingEntity extends Model
{
    use HasFactory;

    protected $table = 'garment_tracking';
    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\ProcessQCModule\Database\factories\Inspection\GarmentTrackingEntityFactory::new();
    }
}
