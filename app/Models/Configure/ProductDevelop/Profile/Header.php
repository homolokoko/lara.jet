<?php

namespace App\Models\Configure\ProductDevelop\Profile;

use App\Models\Configure\Buyers;
use App\Models\Configure\ProductDevelop\ReportType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Header extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $table = 'develop_product_profile';
    protected $fillable = ['buyer_id', 'report_type'];

    function buyer()
    {
        return $this->belongsTo(Buyers::class, "buyer_id");
    }
    function report()
    {
        return $this->belongsTo(ReportType::class, "report_type");
    }
    function version()
    {
        return $this->hasMany(Version::class, 'profile_header_id');
    }
    function latestCheckList()
    {
        return $this->hasManyDeepFromRelations(
            $this->version(),
            (new Version)->latestCheckList()
        );
    }



    function scopeTemporaryCheckList($q, $v)
    {
        $typeId = Arr::get($v, 'id');
        if ($typeId == 1) {
            $id = 3;
        } else if ($typeId == 2) {
            $id = 4;
        } else {
            return $q;
        }
        return $q->where(['report_type' => $typeId, 'id' => $id]);
    }
    function scopeGetId($q, $v)
    {
        return $q->where('id', '=', $v);
    }
}
