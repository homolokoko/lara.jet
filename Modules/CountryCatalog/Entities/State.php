<?php

namespace Modules\CountryCatalog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class State extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasRelationships;

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

    public function zip()
    {
        return $this->belongsTo(Zip::class,'zip_id');
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
        return \Modules\CountryCatalog\Database\factories\StateFactory::new();
    }
}
