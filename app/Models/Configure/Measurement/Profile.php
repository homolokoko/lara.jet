<?php

namespace App\Models\Configure\Measurement;

use App\Models\Configure\Color;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\Styles;
use App\Models\Configure\Version;
use App\Models\Configure\Measurement\Unit As MeasurementUnit;
use App\Models\Configure\StylesApperals;
use App\Models\Configure\Size;
use App\Models\Configure\Measurement\ProfileSizes;
class Profile extends Model
{
    use HasFactory;
    protected $table='measurement_profile';
    protected $fillable = ['styles_id','name','version_id','measurement_unit_id'];
    
    public function styles (){
        return $this->belongsTo(Styles::class,'styles_id');
    }
    public function version (){
        return $this->belongsTo(Version::class,'version_id');
    }
    public function measurementUnit(){
        return $this->belongsTo(MeasurementUnit::class,'measurement_unit_id');
    }
    public function stylesApperals(){
        return $this->hasMany(StylesApperals::class,'styles_id','styles_id');
    }
    public function sizes(){
        return $this->hasManyThrough(
            Size::class, 
            ProfileSizes::class,
            'measurement_profile_id',
            'id',// Foreign key on size table...
            'id',// Local key on MeasurementProfile table...
            'sizes_id'// Local key on size table...
        );
    }
    public function color(){
        return $this->hasManyThrough(
            Color::class, 
            ProfileColor::class,
            'measurement_profile_id',
            'id',// Foreign key on size table...
            'id',// Local key on MeasurementProfile table...
            'color_id'// Local key on size table...
        );
    }    
}


