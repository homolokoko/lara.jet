<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Defects extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    use HasRelationships;

    protected $table = "defects";
    public $translatedAttributes = ['name', 'checksum'];

}
