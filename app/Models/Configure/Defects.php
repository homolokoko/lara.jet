<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Models\Configure\DefectsTranslation;
use Illuminate\Support\Str;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Defects extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    use HasRelationships;

    protected $table='defects';
    public $translatedAttributes = ['name', 'checksum'];

    public function defectsTranslations()
    {
        return $this->hasMany(DefectsTranslation::class);
    }
    public function category(){
        //return $this->hasMany(DefectsCategory::class);
        return $this->hasManyThrough(
            DefectsCategoryTitle::class,
            DefectsCategory::class,
            'defects_id', // Local key on DefectsCategory table...
            'id', // Foreign key on posts table...
            'id', // Local key on DefectsCategoryTitle table...
            'defect_category_id', // Foreign key on DefectsCategory table...
        );
    }
    
    public function locate(){
        return $this->hasMany(DefectsWorkstationLocate::class,'defects_id');
    }
    public function categoryRelated(){
        return $this->hasMany(DefectsCategory::class,'defects_id');
    }
    
    public function categoryName(){
        return $this->hasManyDeepFromRelations(
            $this->categoryRelated(), (new DefectsCategory)->category()
        );
    }
    public function locateName(){
            return $this->hasManyDeepFromRelations(
                $this->locate(), (new DefectsWorkstationLocate)->workstationlocate()
            );
   }
    public function source(){
        return $this->hasMany(DefectsSource::class);
    }

}
