<?php

namespace App\Models\Configure\Measurement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\Measurement\Profile As MeasurementProfile;
use App\Models\Configure\CheckPoints AS CheckPointsProfile;
use App\Models\Configure\Measurement\Checkpoints As MeasurementCheckpoints;
use App\Models\Configure\Apperal AS Apperal;
use App\Models\Configure\StylesApperals;
use Illuminate\Support\Facades\Storage;
class Apperals extends Model
{
    use HasFactory;
    protected $fillable =['measurement_profile_id','image','styles_apperals_id'];
    protected $table = 'measurement_apperals';
    public function profile (){
        return $this->belongsTo(MeasurementProfile::class,'measurement_profile_id');
    }
    public function apperals(){
        return $this->belongsTo(Apperal::class,'apperals_id');
    }
    public function apperalscheckpoint(){
        return $this->hasManyThrough(
            CheckPointsProfile::class, 
            MeasurementCheckPoints::class,
            'measurements_apperals_id', 'id', 'id', 'check_points_id'
        );

    }
    function stylesApperals(){
        return $this->belongsTo(StylesApperals::class,'styles_apperals_id');
    }
    function getImageAttribute($value){
        return  Storage::disk('measurementApperal')->get($value);
    }

}
