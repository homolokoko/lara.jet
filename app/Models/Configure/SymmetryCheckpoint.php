<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Report\SymmetryCheckpoint as RepoSymmetry;
use App\Models\Inspector\SymmetryMeasurement;
use App\Models\Configure\Measure\Profile;

class SymmetryCheckpoint extends Model
{
    use SoftDeletes;
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    protected $primaryKey = 'id';
    protected $table = 'symmetry_checkpiont';
    protected $fillable = ['name', 'style_id', 'version_id', 'is_pass'];

    public function styles(): BelongsTo
    {
        return $this->belongsTo(Styles::class, 'style_id');
    }

    public function style()
    {
        return $this->hasOne(Styles::class, 'id', 'style_id');
    }

    public function versions(): BelongsTo
    {
        return $this->belongsTo(Version::class, 'version_id');
    }

    public function version()
    {
        return $this->hasOne(Version::class, 'id', 'version_id');
    }

    public function details()
    {
        return $this->hasMany(SymmetryCheckpoint\Detail::class, 'symmetry_checkpoint_id');
    }

    public function items()
    {
        return $this->hasMany(RepoSymmetry\Result::class, 'symmetry_checkpoint_id');
    }

    public function measureDetail()
    {
        return $this->hasManyThrough(Profile\Detail::class, SymmetryCheckpoint\Detail::class, 'symmetry_checkpoint_id', 'id', 'id', 'measurement_detail_id');
    }

    public function actualValue()
    {
        return $this->hasManyThrough(
            SymmetryMeasurement\ActualInput::class,
            SymmetryCheckpoint\Detail::class,
            'symmetry_checkpoint_id',
            'measure_profile_detail_id',
            'id',
            'measurement_detail_id',

        );
    }
}
