<?php

namespace Modules\CountryCatalog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class State extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "state";
    protected $fillable = ["name","zip_id"];

    public function cities()
    {
        return $this
            ->hasMany(
                City::class,
                'state_id'
            );
    }

    public function getNameAttribute($val)
    {
        return Str::of(strtoupper($val))->replace('_',' ')->title();
    }

    protected static function newFactory()
    {
        return \Modules\CountryCatalog\Database\factories\StateFactory::new();
    }
}
