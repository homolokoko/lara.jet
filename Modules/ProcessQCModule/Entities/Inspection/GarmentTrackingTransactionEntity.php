<?php

namespace Modules\ProcessQCModule\Entities\Inspection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GarmentTrackingTransactionEntity extends Model
{
    use HasFactory;

    protected $table = 'garment_tracking_transactions';

    public function garment()
    {
        return $this
            ->belongsTo(
                GarmentTrackingEntity::class,
                'garment_tracking_id'
            );
    }

    protected static function newFactory()
    {
        return \Modules\ProcessQCModule\Database\factories\Inspection\GarmentTrackingTransactionEntityFactory::new();
    }
}
