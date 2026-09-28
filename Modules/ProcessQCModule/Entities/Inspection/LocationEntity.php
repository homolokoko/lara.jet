<?php

namespace Modules\ProcessQCModule\Entities\Inspection;

use App\Models\WorkstaionLocate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocationEntity extends WorkstaionLocate
{
    use HasFactory;

    protected $fillable = [];

    public function transactions()
    {
        return $this
            ->hasMany(
                GarmentTracking\TransactionEntity::class,
                'locate'
            );
    }

    public function endlineProfiles()
    {
        return $this
            ->hasMany(
                Endline\ProfileEntity::class,
                'workstation_locates_id'
            );
    }

    protected static function newFactory()
    {
        return \Modules\ProcessQCModule\Database\factories\Inspection\LocationEntityFactory::new();
    }
}
