<?php

namespace Modules\CountryCatalog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Zip extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "zip";
    protected $fillable = ["name","country_id"];

    public function country()
    {
        return $this
            ->belongsTo(
                Country::class,
                'country_id'
            );
    }

    public function states()
    {
        return $this
            ->hasMany(
                State::class,
                'zip_id'
            );
    }

    public function getNameAttribute($val)
    {
        return Str::of(strtoupper($val))->replace('_',' ')->title();
    }

    protected static function newFactory()
    {
        return \Modules\CountryCatalog\Database\factories\ZipFactory::new();
    }
}
