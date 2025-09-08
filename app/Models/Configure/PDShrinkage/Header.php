<?php

namespace App\Models\Configure\PDShrinkage;

use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Configure;

class Header extends Model
{
    use HasFactory;
    use SoftDeletes;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $table = 'pd_shrinkage_header';
    protected $fillable = [
        'buyer_id',
        'style_id',
        'version_id',
        'pd_shrinkage_sample_id',
        'pd_shrinkage_fabric_id'
    ];

    public function buyer()
    {
        return $this->belongsTo(Configure\Buyers::class, 'buyer_id');
    }

    public function style()
    {
        return $this->belongsTo(Configure\Styles::class, 'style_id');
    }
    public function version()
    {
        return $this->belongsTo(Configure\Version::class, 'version_id');
    }
    public function sample()
    {
        return $this->belongsTo(Sample::class, 'pd_shrinkage_sample_id');
    }

    public function fabric()
    {
        return $this->belongsTo(Fabric::class, 'pd_shrinkage_fabric_id');
    }

    public function detail()
    {
        return $this->hasOne(Detail::class, 'pd_shrinkage_header_id', 'id');
    }

    public function before()
    {
        return $this->hasMany(Before::class, 'pd_shrinkage_header_id', 'id');
    }

    public function size()
    {
        return $this->hasOneDeepFromRelations(
            $this->before(),
            (new Before)->size()
        );
    }

    public function sizes()
    {
        return $this->hasManyDeepFromRelations(
            $this->before(),
            (new Before)->size()
        );
    }

    // public function sizeHeader()
    // {
    //     return $this->hasMany(SizeHeader::class, 'pd_shrinkage_header_id', 'id');
    // }

    // public function apparelSizes()
    // {
    //     return $this->hasManyDeepFromRelations(
    //         $this->sizeHeader(),
    //         (new SizeHeader)->apparelSize()
    //     );
    // }

    public function profileSize()
    {
        return $this->hasManyDeepFromRelations(
            $this->sizes(),
            (new Size)->profileSize()
        );
    }
}
