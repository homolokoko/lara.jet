<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = ['name','ezi_colorID'];

    protected $table="color";

    public function scopeEziColor($query, $v)
    {
        return $query->where(['ezi_colorID'=>$v]);
    }

}
