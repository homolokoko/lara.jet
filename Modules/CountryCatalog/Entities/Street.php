<?php

namespace Modules\CountryCatalog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Street extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function getNameAttribute($val)
    {
        return Str::of(strtoupper($val))->replace('_',' ')->title();
    }

    protected static function newFactory()
    {
        return \Modules\CountryCatalog\Database\factories\StreetFactory::new();
    }
}
