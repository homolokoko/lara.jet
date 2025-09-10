<?php

namespace App\Models\Configure\SymmetryCheckpoint;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Report\SymmetryCheckpoint as RepoSymmetry;
use App\Models\Inspector\SymmetryMeasurement;
use App\Models\Configure\Measure\Profile;
use App\Models\Configure;

class Header extends Model
{
    use SoftDeletes;
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    protected $primaryKey = 'id';
    protected $table = 'symmetry_checkpiont_header';
    protected $fillable = ['style_id',];

    public function style()
    {
        return $this->hasOne(Configure\Styles::class, 'id', 'style_id');
    }

    public function details()
    {
        return $this->hasMany(Configure\SymmetryCheckpoint\Detail::class, 'symmetry_checkpoint_id');
    }

    public function items()
    {
        return $this->hasMany(RepoSymmetry\Result::class, 'symmetry_checkpoint_id');
    }

    public function measureDetail()
    {
        return $this->hasManyThrough(Profile\Detail::class, Configure\SymmetryCheckpoint\Detail::class, 'symmetry_checkpoint_id', 'id', 'id', 'measurement_detail_id');
    }

    public function actualValue()
    {
        return $this->hasManyThrough(
            SymmetryMeasurement\ActualInput::class,
            Configure\SymmetryCheckpoint\Detail::class,
            'symmetry_checkpoint_id',
            'measure_profile_detail_id',
            'id',
            'measurement_detail_id',

        );
    }
}
