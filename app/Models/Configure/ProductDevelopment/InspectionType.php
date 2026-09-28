<?php

namespace App\Models\Configure\ProductDevelopment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class InspectionType extends Model
{
    use SoftDeletes;
    use HasFactory;
    public $table = 'develop_product_inspection_type';
    protected $fillable = [
        'name'
    ];
    protected $appends = ['display_name'];

    public function scopeFilterDeleted($query, $value)
    {
        return ($value == 'Yes') ? $query->whereNotNull('deleted_at') : $query->whereNull('deleted_at') ;
    }
    public function getDisplayNameAttribute($v)
    {
        return Str::of($v)->snake()->replace('_', ' ')->title();
    }
}
