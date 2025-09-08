<?php

namespace App\Models\Configure\PDShrinkage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Configure;

class SizeHeader extends Model
{
    use HasFactory;
    protected $table = 'pd_shrinkage_size_header';
    protected $fillable = ['size_id', 'pd_shrinkage_before_id'];
    public $timestamps = false;

    public function beforeCut()
    {
        return $this->belongsTo(Before::class, 'pd_shrinkage_before_id');
    }

    public function apparelSize()
    {
        return $this->belongsTo(Configure\Size::class, 'size_id');
    }
}
