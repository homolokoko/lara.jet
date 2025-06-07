<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Style extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasRelationships;

    protected $table = 'style';
    protected $fillable = ['name'];

    public function styleColors()
    {
        return $this
            ->hasMany(
                StyleColor::class,
                'style_id'
            );
    }


    public function stylePurchaseOrders()
    {
        return $this
            ->hasMany(
                StylePurchaseOrder::class,
                'style_id'
            );
    }

    public function colors()
    {
        return $this
            ->hasManyDeepFromRelations(
                $this->styleColors(),
                (new StyleColor)->color()
            );
    }

    public function purchaseOrders()
    {
        return $this
            ->hasManyDeepFromRelations(
                $this->stylePurchaseOrders(),
                (new StylePurchaseOrder)->purchaseOrder()
            );
    }
}
