<?php

namespace App\Models\Configure\Measure\Profile;

use App\Models\Configure\Color;
use Bkwld\Cloner\Cloneable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Configure\Styles;
use App\Models\Configure\Product\Name as ProductName;
use App\Models\Configure\Product\Category as ProductCategory;
use App\Models\Configure\Product\Desc as ProductDesc;
use App\Models\Configure\Unit;
use App\Models\Configure\Version;
use App\Models\Configure\Measure\Profile\Color as ProfileColor;
use App\Models\Configure\Measure\Profile\Version as ProfileVersion;

use App\Models\Inspector\Measure\Header as InspectionHeader;
use App\Models\Configure\PSMFR\Shrinkage;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Header extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Cloneable;
    use HasRelationships;

    protected $fillable = ['styles_id', 'product_name_id', 'product_desc_id', 'product_category_id', 'unit_id', 'version_id', 'inspection_profile_id'];
    protected $table = 'measure_profile_header';

    protected $cloneable_relations = [
        'detail','relatedColor'
    ];
    protected $clone_exempt_attributes = ['id', 'created_at', 'updated_at'];

    public function style()
    {
        return $this->belongsTo(Styles::class, 'styles_id');
    }
    public function productName()
    {
        return $this->belongsTo(ProductName::class, 'product_name_id');
    }
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
    public function productDesc()
    {
        return $this->belongsTo(ProductDesc::class, 'product_desc_id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function version()
    {
        return $this->belongsTo(Version::class, 'version_id');
    }
    public function charts()
    {
        return $this->hasManyDeep(
            Chart::class,
            [Detail::class],
            [
                'measure_profile_header_id', // Foreign key on the "detail" table.
                'id',      // Foreign key on the "header" table (local key).
                'measure_profile_detail_id'  // Foreign key on the "charts" table.
            ],
        );
    }
    public function sizeList()
    {
        return $this->size();
    }
    public function colorList()
    {
        return $this->hasManyDeep(
            Color::class,
            [ProfileColor::class],
            [
                'header_id', // Foreign key on the "ProfileColor" table.
                'color_id',      // Foreign key on the "header" table (local key).
                'id'  // Foreign key on the "color" table.
            ],
            [
                'id', // Local key on the "ProfileColor" table.
                'id', // Local key on the "header" table.
                'color_id'  // Local key on the "color" table.
            ]
        );
    }

    public function versionList()
    {
        return $this->hasManyDeep(
            Version::class,
            [ProfileVersion::class],
            [
                'header_id', // Foreign key on the "ProfileColor" table.
                'version_id',      // Foreign key on the "header" table (local key).
                'id'  // Foreign key on the "color" table.
            ],
            [
                'id', // Local key on the "ProfileColor" table.
                'id', // Local key on the "header" table.
                'version_id'  // Local key on the "color" table.
            ]
        );
    }
    public function color()
    {
        return $this->belongsToMany(ProfileColor::class,  'measure_profile_color',  'header_id', 'color_id');
    }
    public function relatedColor(){
        return $this->hasMany(ProfileColor::class, 'header_id');
}
    /*public function version()
    {
        return $this->belongsToMany(ProfileVersion::class, 'measure_profile_version');
    }*/

    public function size()
    {
        return $this->hasManyDeepFromRelations(
            $this->charts(),
            (new Chart)->sizes()
        );
    }


    public function chartsInfo()
    {
        return $this->hasManyDeepFromRelations(
            $this->detail(),
            (new Detail)->charts()
        );
    }
    public function inspection()
    {
        return $this->hasMany(InspectionHeader::class, 'measure_profile_header_id');
    }
    public function detail()
    {
        return $this->hasMany(Detail::class, 'measure_profile_header_id');
    }
    public function shrinkage(){
        return $this->hasMany(Shrinkage\Header::class, 'measurement_profile_id','version_id');
    }

    public function testDeepClone()
    {
        $clone = $this->duplicate();
        return $clone;
        //return $this->compareDeepRelations($this, $clone);
    }

    private function compareDeepRelations($original, $clone, $path = '')
    {
        $differences = [];

        foreach ($this->cloneable_relations as $relation) {
            $relationParts = explode('.', $relation);
            $this->compareRelation($original, $clone, $relationParts, $path, $differences);
        }

        return $differences;
    }
    private function compareRelation($original, $clone, $relationParts, $path, &$differences)
    {
        $currentRelation = array_shift($relationParts);
        $newPath = $path ? "$path.$currentRelation" : $currentRelation;

        if (!$original->$currentRelation || !$clone->$currentRelation) {
            $differences[$newPath] = [
                'original' => $original->$currentRelation ? 'exists' : 'missing',
                'clone' => $clone->$currentRelation ? 'exists' : 'missing'
            ];
            return;
        }

        if ($original->$currentRelation instanceof Model) {
            if (!empty($relationParts)) {
                $this->compareRelation($original->$currentRelation, $clone->$currentRelation, $relationParts, $newPath, $differences);
            }
        } elseif ($original->$currentRelation instanceof Collection) {
            if ($original->$currentRelation->count() !== $clone->$currentRelation->count()) {
                $differences[$newPath] = [
                    'original_count' => $original->$currentRelation->count(),
                    'clone_count' => $clone->$currentRelation->count()
                ];
            } else {
                foreach ($original->$currentRelation as $index => $item) {
                    if (!empty($relationParts)) {
                        $this->compareRelation($item, $clone->$currentRelation[$index], $relationParts, "$newPath.$index", $differences);
                    }
                }
            }
        }
    }
    function scopeFindByStyle($query, $style){
        return $query->where('styles_id', $style);
    }
    function scopeFindByVersion($query, $version)
    {
        return $query->where('version_id', $version);
    }
    function scopeProfileOfStyleVersion($query, $style, $version)
    {
        return $query->where('styles_id', $style)->where('version_id', $version);
    }

}


