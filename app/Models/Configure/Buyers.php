<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Buyers extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];
    function style(){
        $this->hasMany(Styles::class);
    }
}
