<?php

namespace App\Models\Configure\Style;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\CheckPoints as ConfigureCheckPoints;
use App\Models\Configure\Style\CheckPoint as ProfileCheckPoint;

use App\Models\Configure\StylesApperals as ConfigureStyleApparel;

class Apparel extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $table = 'style_profile_apparels';
    protected $fillable = ['style_profile_id','styles_apparels_id'];

    public function styleApparel()
    {
        return $this->belongsTo(ConfigureStyleApparel::class, 'styles_apparels_id');
    }
    public function checkpoint()
    {
        return $this->hasMany(ProfileCheckPoint::class, 'style_profile_apparels_id');
    }
    public function checkpointName()
    {
        return $this->hasManyThrough(
            ConfigureCheckPoints::class,
            ProfileCheckPoint::class,
            'style_profile_apparels_id',
            'id',// Foreign key on size table...
            'id',// Local key on MeasurementProfile table...
            'check_points_id'// Local key on size table...
        );
    }
    public function area(){
        return $this->hasMany(ProfileCheckPoint::class, 'style_profile_apparels_id');
    }


}
