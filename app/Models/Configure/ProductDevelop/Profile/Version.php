<?php

namespace App\Models\Configure\ProductDevelop\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\ProductDevelop\Profile\CheckList as ProductDevelopProfileCheckList;

class Version extends Model
{

    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $table = 'develop_product_profile_version';
    protected $fillable = ['profile_header_id', 'version', 'latest'];


    function CheckList()
    {
        return $this->hasMany(CheckList::class, 'version_id');
    }
    function latestCheckList()
    {
        return $this->hasManyDeepFromRelations(
            $this->CheckList(),
            (new CheckList)->checkPoint()
        );
    }
    function scopeLatestVersion($q)
    {
        return $q->where('latest', '=', 1);
    }
}
