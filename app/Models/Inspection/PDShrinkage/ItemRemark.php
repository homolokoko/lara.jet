<?php

namespace App\Models\Inspector\PDShrinkage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRemark extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pd_shrinkage_item_remark';
    protected $fillable = ['pd_shrinkage_after_id', 'src_path', 'comment', 'is_remark'];
}
