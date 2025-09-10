<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class WashType extends Model
{
    use HasFactory;
    protected $table = 'wash_types';
    protected $fillable = ['name', 'deleted_at'];
    use SoftDeletes;

    public function scopeFilterDeleted($query, $value)
    {
        return ($value == 'Yes') ? $query->whereNotNull('deleted_at') : $query->whereNull('deleted_at') ;
    }

    public function getNameAttribute($v){
        return Str::of($v)->snake()->replace('_', ' ')->title();
    }
}
