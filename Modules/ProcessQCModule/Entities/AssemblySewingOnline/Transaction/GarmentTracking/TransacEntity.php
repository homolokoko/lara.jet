<?php

namespace Modules\ProcessQCModule\Entities\AssemblySewingOnline\Transaction\GarmentTracking;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransacEntity extends Model
{
    use HasFactory;

    protected $table = 'garment_tracking_transactions';
    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\ProcessQCModule\Database\factories\AssemblySewingOnline/Transaction/GarmentTracking/TransacEntityFactory::new();
    }
}
