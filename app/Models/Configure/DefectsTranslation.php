<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DefectsTranslation extends Model
{
    use HasFactory;
    protected $table='defects_translations';
    public $timestamps = true;
    protected $fillable = ['name'];

    public function getNameAttribute($name){
        return Str::of($name)->trim()->title()->__toString();
    }
}
