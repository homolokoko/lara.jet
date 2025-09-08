<?php

namespace App\Models\Configure\PDShrinkage;

use App\Models\Configure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $table = 'pd_shrinkage_size';
    protected $fillable = ['size_id', 'pd_shrinkage_before_id', 'before_cut_by_size'];
    public $timestamps = false;

    // public function before()
    // {
    //     return $this->belongsToMany(Before::class, 'pd_shrinkage_before_id');
    // }

    // public function profileSize()
    // {
    //     return $this->belongsTo(Configure\Size::class, 'size_header_id');
    // }
}
