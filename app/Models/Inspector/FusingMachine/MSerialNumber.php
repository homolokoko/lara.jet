<?php

namespace App\Models\Inspector\FusingMachine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class MSerialNumber extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'machine_serial_number';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function scopeFilterDeleted($query, $value)
    {
        return ($value == 'Yes') ? $query->whereNotNull('deleted_at') : $query->whereNull('deleted_at') ;
    }

    public function getNameAttribute($v){
        return Str::of($v)->snake()->replace('_', ' ')->title();
    }
}
