<?php

namespace Modules\CountryCatalog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Country extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "country";
    protected $fillable = ["name"];

    public function zips()
    {
        return $this
            ->hasMany(
                Zip::class,
                'country_id'
        );
    }

    public function getNameAttribute($val)
    {
        return Str::of(strtoupper($val))->replace('_',' ')->title();
    }

    protected static function newFactory()
    {
        return \Modules\CountryCatalog\Database\factories\CountryFactory::new();
    }
}
