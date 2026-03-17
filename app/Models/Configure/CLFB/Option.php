<?php

namespace App\Models\Configure\CLFB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use App\Models\Configure\CLFB\OptionTranslation;

class Option extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $table='clfb_option';
    protected $fillable = ['name'];
    public $translatedAttributes = ['name'];
    
}
