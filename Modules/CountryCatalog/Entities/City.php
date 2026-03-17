<?php

namespace Modules\CountryCatalog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function getNameAttribute($val)
    {
        return Str::of(strtoupper($val))->replace('_',' ')->title();
    }

    protected static function newFactory()
    {
        return \Modules\CountryCatalog\Database\factories\CityFactory::new();
    }
}
