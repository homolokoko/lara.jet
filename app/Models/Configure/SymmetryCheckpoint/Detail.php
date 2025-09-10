<?php

namespace App\Models\Configure\SymmetryCheckpoint;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Configure\Measure\Profile;
use App\Models\Configure\Size;
use App\Models\Inspector\Endline\Measure;
use App\Models\Inspector\SymmetryMeasurement\ActualInput;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;

class Detail extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $foreignKey = 'measurement_detail_id';
    protected $table = 'symmetry_checkpiont_detail';
    protected $fillable = ['symmetry_checkpoint_id', 'measurement_detail_id', 'measurement_chart_id'];

    public function detail()
    {
        return $this->belongsTo(Profile\Detail::class, 'measurement_detail_id');
    }

    public function symmetricCheckpoint()
    {
        return $this->hasManyThrough(
            ActualInput::class,
            Profile\Detail::class,
            'id',
            'measure_profile_detail_id',
            'measurement_detail_id',
            'id'
        );
    }

    public function endlineChart()
    {
        return $this->hasMayDeepFromRelations(
            $this->chart(),
            (new Measure\Chart())->chart()
        );
    }

    // public function charts()
    // {
    //     return $this->hasManyDeepFromRelations(
    //         $this->detail(),
    //         (new Profile\Detail())->charts()
    //     );
    // }

    public function chart()
    {
        return $this->hasOneThrough(
            Profile\Chart::class,
            Profile\Detail::class,
            'id',
            'measure_profile_detail_id',
            'measurement_detail_id',
            'id',
        );
    }

    // public function charts()
    // {
    //     return $this->hasMany(Profile\Chart::class, 'measure_profile_detail_id', 'measurement_detail_id');
    // }

}
