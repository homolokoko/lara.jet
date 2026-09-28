<?php

namespace App\Models\Configure\PDShrinkage;

use App\Models\Inspector\PDShrinkage\ItemRemark;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class After extends Model
{
    use HasFactory;
    protected $table = 'pd_shrinkage_after';
    protected $fillable = ['pd_shrinkage_before_id', 'after_cutting'];

    public function picture()
    {
        return $this->hasOne(ItemRemark::class, 'pd_shrinkage_after_id');
    }
}
