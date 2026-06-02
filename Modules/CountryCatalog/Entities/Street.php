<?php

namespace Modules\CountryCatalog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Street extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasRelationships;

    protected $table = "street";
    protected $fillable = ["name","city_id"];

    public function people()
    {
        return $this
            ->hasMany(
                Person::class,
                'street_id'
            );
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function state()
    {
        return $this->hasOneDeepFromRelations(
            $this->city(),
            (new City)->state()
        );
    }

    public function zip()
    {
        return $this->hasOneDeepFromRelations(
            $this->state(),
            (new State)->zip()
        );
    }

    public function country()
    {
        return $this->hasOneDeepFromRelations(
            $this->zip(),
            (new Zip)->country()
        );
    }

    public function getNameAttribute($val)
    {
        return Str::of(strtoupper($val))->replace('_',' ')->title();
    }

    protected static function newFactory()
    {
        return \Modules\CountryCatalog\Database\factories\StreetFactory::new();
    }
}
