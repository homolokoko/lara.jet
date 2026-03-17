<?php

namespace App\Models\Inspector\SymmetryMeasurement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\Measure\Profile;
use App\Models\Configure\SymmetryCheckpoint;

class ActualInput extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $foreignKey = 'measure_profile_detail_id';
    protected $table = 'inspector_symmetry_actual_input';
    protected $fillable = [
        'measure_profile_detail_id',
        'actual'
    ];

    public function profileDetail()
    {
        return $this->hasOne(
            Profile\Detail::class,
            'id',
            $this->foreignKey
        );
    }

    public function profileChart()
    {
        return $this->hasMany(
            Profile\Chart::class,
            'measure_profile_detail_id',
            'measure_profile_detail_id',
        );
    }

    public function checkPointDetails()
    {
        return $this->hasMany(
            SymmetryCheckpoint\Detail::class,
            'measurement_detail_id',
            'measure_profile_detail_id'
        );
    }

    public function symmetricCheckpoint()
    {
        return $this->hasOneThrough(
            SymmetryCheckpoint\Detail::class,
            Profile\Detail::class,
            'id',
            'measurement_detail_id',
            'measure_profile_detail_id',
            'id'
        );
    }
}
