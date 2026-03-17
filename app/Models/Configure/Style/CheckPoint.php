<?php

namespace App\Models\Configure\Style;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Configure\CheckPoints as ConfigureCheckPoints;

class CheckPoint extends Model
{
    use HasFactory;

    protected $table = 'style_profile_check_points';
    protected $fillable = ['style_profile_apparels_id','check_points_id','number'];
    public $timestamps = false;


    public function name()
    {
        return $this->belongsTo(ConfigureCheckPoints::class, 'check_points_id');
    }
    public function styleApparel()
    {
        return $this->belongsTo(Apparel::class, 'style_profile_apparels_id');
    }
    public function scopeSketchArea($query, $areaId)
    {
        return $query->where('number', $areaId);
    }


}
