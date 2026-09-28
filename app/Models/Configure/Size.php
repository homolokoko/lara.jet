<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Configure\Measure\Profile\Chart as MeasureProfileChart;

class Size extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name','ezi_sizename'];
    protected $table = "sizes";

    public function measurement()
    {
        return $this->hasMany(MeasureProfileChart::class, 'sizes_id');
    }
    public function scopeEziSize($q, $v)
    {
        return $q->where('ezi_sizename', $v);
    }
}
