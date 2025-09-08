<?php

namespace App\Models\Configure\Accessory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class TrimType extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $table='trim_type';
    public $translatedAttributes = ['name'];
    
    public function children(){
        return $this->hasMany(TrimType::class, 'parent_id');
    }
    public function scopeParent($q){
        return $q->where('parent_id',NULL);
    }
    public function trimTypeDefect(){
        return $this->hasMany(TrimTypeDefect::class,'trim_type_id');
    }
    public function defect(){
        return $this->hasManyDeepFromRelations(
            $this->trimTypeDefect(), (new TrimTypeDefect)->defect()
        );
    }
    
}
