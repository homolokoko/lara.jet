<?php

namespace App\Models\Configure\Defect;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Cause extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $table = 'defects_cause';
    public $translatedAttributes = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
}
