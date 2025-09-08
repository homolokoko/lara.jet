<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\Measurement\Profile as MeasurementProfile;

class Version extends Model
{
    use HasFactory;
    protected $table = 'version';
    protected $fillable = ['name'];

    public function measurement()
    {
        return $this->hasMany(MeasurementProfile::class, 'version_id');
    }

    public function symmetryDetail()
    {
        return $this->hasOneThrough(
            SymmetryCheckpoint\Detail::class,
            SymmetryCheckpoint::class,
            'version_id',
            'symmetry_checkpoint_id',
            'id',
            'id',
        );
    }
}
