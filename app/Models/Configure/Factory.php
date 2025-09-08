<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Models\Configure\FactoryTranslation;

class Factory extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $table='factory';
    public $translatedAttributes = ['name'];
    protected $fillable = ['name_key','name'];

    public function factoryTranslations()
    {
        return $this->hasMany(FactoryTranslation::class);
    }

}
