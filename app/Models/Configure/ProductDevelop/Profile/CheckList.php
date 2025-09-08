<?php

namespace App\Models\Configure\ProductDevelop\Profile;

use App\Models\Configure\ProductDevelop\CheckList as ProductDevelopCheckList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckList extends Model
{
    use HasFactory;
    protected $table = 'develop_product_profile_checklist';
    protected $fillable = ['editor', 'version_id', 'check_list_id', 'sort'];

    function checkPoint()
    {
        return $this->belongsTo(ProductDevelopCheckList::class, 'check_list_id');
    }
    function scopeSorted($q)
    {
        return $q->orderBy('sort');
    }
}
