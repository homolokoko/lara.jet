<?php

namespace App\Models\Configure\InspectionReport;

use App\Models\Configure\Buyers;
use App\Models\Configure\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vicklr\MaterializedModel\Traits\HasMaterializedPaths;
use Vicklr\MaterializedModel\MaterializedModel;
use Bkwld\Cloner\Cloneable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends MaterializedModel
{
    use HasFactory;
    use HasMaterializedPaths;
    use Cloneable;
    use SoftDeletes;

    public $table = "inspection_section";
    protected $fillable = ['name', 'buyer_id'];
    protected string $orderColumn = 'ordering';
    // 'parent_id' column name
    protected string $parentColumn = 'parent_id';
    // 'depth' column name
    protected string $depthColumn = 'depth';
    // 'path' column name
    protected string $pathColumn = 'path';

    public function buyer()
    {
        return $this->belongsTo(Buyers::class, 'buyer_id');
    }

    public function scopeGetByBuyer($q, $v)
    {
        return $q->where('buyer_id', '=', $v);
    }
}
