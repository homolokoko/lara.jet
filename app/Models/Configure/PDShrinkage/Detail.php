<?php

namespace App\Models\Configure\PDShrinkage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $table = 'pd_shrinkage_detail';
    protected $fillable = [
        'pd_shrinkage_header_id',
    ];
    public $timestamps = false;

    public function before()
    {
        return $this->hasMany(Before::class, 'pd_shrinkage_detail_id', 'id');
    }
}
