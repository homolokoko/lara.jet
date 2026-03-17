<?php

namespace App\Models\Inspector\Inline;

use App\Models\Configure\CheckPoints;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    use HasFactory;
    public $table = 'insp_inline_measure';
    protected $fillable = [
        'is_reject',
        'insp_inline_item_id',
        'measurement_profile_id',
        'measurement_profile_apperal_id',
        'check_points_id'
    ];
    public $timestamps = true;

    public function checkpoint(){
        return $this->belongsTo( CheckPoints::class,'check_points_id');
    }
    public function repair(){
        return $this->hasOne(Repair::class,'insp_inline_measure_id');
    }
}
