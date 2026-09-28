<?php

namespace App\Models\Configure\Fabric;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Content extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'fabric_contents';
    protected $fillable = [
        'name'
    ];

    public function scopeFilterDeleted($query, $value)
    {
        return ($value == 'Yes') ? $query->whereNotNull('deleted_at') : $query->whereNull('deleted_at') ;
    }

    public function getNameAttribute($v)
    {
        return Str::of($v)->snake()->replace('_', ' ')->title();
    }
    public function detail(){
        return $this->hasMany( ContentDetail::class, 'content_id', 'id');
    }
}
