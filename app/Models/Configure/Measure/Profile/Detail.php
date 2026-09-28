<?php

namespace App\Models\Configure\Measure\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Configure\PSMFR\Shrinkage;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Bkwld\Cloner\Cloneable;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Detail extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Cloneable;

    use HasRelationships;
    protected $fillable = ['measure_profile_header_id', 'pom_code', 'pom_desc', 'image'];
    protected $table = 'measure_profile_detail';
    protected $touches = ['header'];
    protected $cloneable_relations = [
        'charts'
    ];
    protected $appends = ['name'];
    protected $clone_exempt_attributes = ['id', 'created_at', 'updated_at'];

    function getImageAttribute($value)
    {
        return ($value) ? Storage::disk('measurementApperal')->url('measurementApperal/' . $value) : '';
    }
    function getPomDescAttribute($value)
    {
        return html_entity_decode($value);
    }
    function header()
    {
        return  $this->belongsTo(Header::class, 'measure_profile_header_id');
    }
    function charts()
    {
        return $this->hasMany(Chart::class, 'measure_profile_detail_id');
    }
    function style()
    {
        return $this->hasOneDeepFromRelations(
            $this->header(),
            (new header)->style()
        );
    }
    function inspection()
    {
        return $this->hasManyDeepFromRelations(
            $this->charts(),
            (new Chart)->inspection()
        );
    }
    public function shrinkage()
    {
        return $this->hasMany(Shrinkage\Detail::class, 'measure_profile_detail_id');
    }
    public function sysmmetric()
    {
        return $this->hasMany(\App\Models\Configure\SymmetryCheckpoint\Detail::class, 'measurement_detail_id');
    }

    public function endlineMeasureCharts()
    {
        return $this->hasManyDeepFromRelations(
            $this->charts(),
            (new Chart)->endlineMeasureChart()
        );
    }
    public function getNameAttribute()
    {
        return $this->pom_code.' '.$this->pom_desc;
    }
}
