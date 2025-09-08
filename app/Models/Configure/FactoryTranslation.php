<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactoryTranslation extends Model
{
    use HasFactory;
    protected $table='factory_translations';
    public $timestamps = true;
    protected $fillable = ['name'];
}
