<?php

namespace Modules\ProcessQCModule\Entities\PQI;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Vicklr\MaterializedModel\Traits\HasMaterializedPaths;
use Vicklr\MaterializedModel\MaterializedModel;


class Defect extends MaterializedModel implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;
    use HasMaterializedPaths    ;

    protected $appends = ['name','ancestors'];
    protected $table = 'pqi_defect';
    protected $translatedAttributes = ['translated'];
    protected $translationForeignKey = 'pqi_defect_id';
    protected $fillable = ['parent_id','depth','path','ordering','buyer_id','pqi_defect_id','pqi_defect_type_id','is_defect'];

    // 'parent_id' column name
    protected string $parentColumn = 'parent_id';

    // 'depth' column name
    protected string $depthColumn = 'depth';

    // 'path' column name
    protected string $pathColumn = 'path';

    // 'order' column name
    protected string $orderColumn = 'ordering';

    // guard attributes from mass-assignment
    protected $guarded = array('id', 'parent_id', 'depth', 'path', 'ordering');

    function getNameAttribute(){
        return ucwords(str_replace('_',' ',$this->translated));
    }

    public function getIsRootAttribute()
    {
        return $this->isRoot();
    }

//    public function getParentAttribute()
//    {
//        return $this->parent()->first();
//    }
//
//    public function getChildrenAttribute()
//    {
//        return $this->children()->get();
//    }

    public function getAncestorsAttribute()
    {
        return $this->ancestors()->get();
    }

    public function serverity()
    {
        return $this
            ->hasMany(
                DefectServerity::class,
                'pqi_defect_id'
            );
    }

    protected static function newFactory()
    {
        return \Modules\ProcessQCModule\Database\factories\PQI/DefectFactory::new();
    }
}
