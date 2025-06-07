<?php

namespace Modules\ProcessQCModule\Entities\Inspection\Endline;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfileEntity extends Model
{
    use HasFactory;

    protected $table = 'insp_endline_profile';
    protected $fillable = ['style_profile_id','inspector_id','workstation_locates_id','purchase_order_id'];

    public function items()
    {
        return $this
            ->hasMany(
                ItemEntity::class,
                'insp_endline_profile_id'
            );
    }

    protected static function newFactory()
    {
        return \Modules\ProcessQCModule\Database\factories\Inspection\Endline\ProfileEntityFactory::new();
    }
}
