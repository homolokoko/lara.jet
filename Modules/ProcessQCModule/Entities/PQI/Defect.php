<?php

namespace Modules\ProcessQCModule\Entities\PQI;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;


class Defect extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;

    protected $appends = ['name'];
    protected $table = 'pqi_defect';
    protected $translatedAttributes = ['translated'];
    protected $translationForeignKey = 'pqi_defect_id';
    protected $fillable = ['parent_id','depth','path','ordering','buyer_id','pqi_defect_id'];

    function getNameAttribute(){
        return ucwords(str_replace('_',' ',$this->translated));
    }

    public function defects()
    {
        return $this
            ->hasMany(
                Defect::class,
                'parent_id'
            );
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
