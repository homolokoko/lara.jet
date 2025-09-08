<?php

namespace App\Models\Configure\Style;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Configure\Styles;
use App\Models\Configure\Version;
use App\Models\Configure\StylesApperals as ConfigureStyleApparel;

use App\Models\Configure\Size as ConfigureSize;
use App\Models\Configure\Color as ConfigureColor;
use App\Models\Configure\JobSeqs;
use App\Models\Configure\JobSeqsTranslation;
use App\Models\Configure\Style\Size as ProfileSizes;
use App\Models\Configure\Style\Color as ProfileColor;
use App\Models\Configure\Style\Apparel as ProfileApparel;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Profile extends Model
{
    use SoftDeletes;
    use HasFactory;
    use HasRelationships;

    protected $table = 'style_profile';
    protected $fillable = ['style_id','version_id'];

    public function styles()
    {
        return $this->belongsTo(Styles::class, 'style_id');
    }
    public function stylesTrashed()
    {
        return $this->belongsTo(Styles::class, 'style_id')->withTrashed();
    }
    public function version()
    {
        return $this->belongsTo(Version::class, 'version_id');
    }
    public function size()
    {
        return $this->hasMany(ProfileSizes::class, 'style_profile_id');
    }
    public function colors()
    {
        return $this->hasMany(Color::class, 'style_profile_id');
    }
    public function apparel()
    {
        return $this->hasMany(Apparel::class, 'style_profile_id');
    }
    public function apparelName()
    {
        return $this->hasManyThrough(
            ConfigureStyleApparel::class,
            ProfileApparel::class,
            'style_profile_id',
            'id', // Foreign key on size table...
            'id', // Local key on MeasurementProfile table...
            'styles_apparels_id'// Local key on size table...
        );
    }

    public function sizeName()
    {
        return $this->hasManyThrough(
            ConfigureSize::class,
            ProfileSizes::class,
            'style_profile_id',
            'id', // Foreign key on size table...
            'id', // Local key on MeasurementProfile table...
            'sizes_id'// Local key on size table...
        );
    }
    public function colorsName()
    {
        return $this->hasManyThrough(
            ConfigureColor::class,
            ProfileColor::class,
            'style_profile_id',
            'id', // Foreign key on size table...
            'id', // Local key on MeasurementProfile table...
            'color_id'// Local key on size table...
        );
    }
    public function jobSeq()
    {
        return $this->hasMany(JobSeqs::class, 'style_profile_id');
    }
    public function checkpointName()
    {
        return $this->hasManyDeepFromRelations(
            $this->apparel(),
            (new ProfileApparel)->checkpointName()
        );
    }
    public function checkpointArea()
    {
        return $this->hasManyDeepFromRelations(
            $this->apparel(),
            (new ProfileApparel)->area()
        );
    }

    public function scopeGetStyleProfile($query, $style, $version)
    {
        return $query->where([
                'style_id' => $style,
                'version_id' => $version,
            ]);
    }
}
