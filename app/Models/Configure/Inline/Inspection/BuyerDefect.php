<?php

namespace App\Models\Configure\Inline\Inspection;

use App\Models\Configure\Buyers;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vicklr\MaterializedModel\MaterializedModel;
use Vicklr\MaterializedModel\Traits\HasMaterializedPaths;

class BuyerDefect extends MaterializedModel
{
    use HasFactory;
    use SoftDeletes;
    use HasRelationships;

    protected $primaryKey = 'id';
    protected $table = 'inline_inspection_buyer_defect';
    protected $fillable = [
        'parent_id',
        'depth',
        'path',
        'ordering',
        'buyer_id',
        'inline_inspection_defect_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function buyer()
    {
        return
            $this->belongsTo(
                Buyers::class,
                'buyer_id'
            );
    }

    public function defect()
    {
        return
            $this->belongsTo(
                Defect::class,
                'inline_inspection_defect_id'
            );
    }

    public function children(): HasMany
    {
        return
            $this->hasMany(
                BuyerDefect::class,
                'parent_id'
            );
    }

    public function serverity()
    {
        return
            $this->hasOne(
                BuyerDefectServerity::class,
                'inline_inspection_buyer_defect_id'
            );
    }

}
