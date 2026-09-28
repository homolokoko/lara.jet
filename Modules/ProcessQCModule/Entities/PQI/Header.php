<?php

namespace Modules\ProcessQCModule\Entities\PQI;

use App\Models\Buyer;
use App\Models\PurchaseOrder;
use App\Models\Style;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Header extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasRelationships;

    protected $table = 'pqi_header';

    protected $fillable = ['buyer_id','style_id','purchase_order_id'];

    public function items()
    {
        return $this
            ->hasMany(
                Item::class,
                'pqi_header_id'
            );
    }

    public function style()
    {
        return $this
            ->belongsTo(
                Style::class,
                'style_id'
            );
    }

    public function buyer()
    {
        return $this
            ->belongsTo(
                Buyer::class,
                'buyer_id'
            );
    }

    public function colors()
    {
        return $this
            ->hasManyDeepFromRelations(
                $this->items(),
                (new Item)->color()
            );
    }

    public function purchaseOrder()
    {
        return $this
            ->belongsTo(
                PurchaseOrder::class,
                'purchase_order_id'
            );
    }

    protected static function newFactory()
    {
        return \Modules\ProcessQCModule\Database\factories\PQI/HeaderFactory::new();
    }
}
