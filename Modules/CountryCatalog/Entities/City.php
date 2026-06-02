<?php

namespace Modules\CountryCatalog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasRelationships;

    protected $table = "city";
    protected $fillable = ["name","state_id"];

    public function streets()
    {
        return $this
            ->hasMany(
                Street::class,
                'city_id'
            );
    }

    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
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
        return \Modules\CountryCatalog\Database\factories\CityFactory::new();
    }
}
