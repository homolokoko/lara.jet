<?php

namespace Modules\ProcessQCModule\Entities\Inspection\GarmentTracking;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RootEntity extends Model
{
    use HasFactory;

    protected $table = 'garment_tracking';
    protected $fillable = ['garmentQrCode','bin_tickets_id'];

    protected static function newFactory()
    {
        return \Modules\ProcessQCModule\Database\factories\Inspection\GarmentTracking\RootEntityFactory::new();
    }
}
