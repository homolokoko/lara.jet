<?php

namespace Modules\ProcessQCModule\Entities\Inspection\GarmentTracking;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EndlineEntity extends Model
{
    use HasFactory;

    protected $table = 'garment_tracking_endline';
    protected $fillable = ['garment_tracking_id','insp_endline_item_id'];

    protected static function newFactory()
    {
        return \Modules\ProcessQCModule\Database\factories\Inspection/GarmentTracking/EndlineEntityFactory::new();
    }
}
