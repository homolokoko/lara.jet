<?php

namespace App\Models\Configure\PSMFR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Process extends Model
{
    use HasFactory;
    protected $table = 'psmfr_process';
    protected $fillable = ['name', 'deleted_at'];
    use SoftDeletes;

    public function scopeFilterDeleted($query, $value)
    {
        return ($value == 'Yes') ? $query->whereNotNull('deleted_at') : $query->whereNull('deleted_at') ;
    }

    public function getNameAttribute($v)
    {
        return Str::of($v)->snake()->replace('_', ' ')->title();
    }

}
