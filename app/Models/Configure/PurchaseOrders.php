<?php

namespace App\Models\Configure;

use App\Models\Configure\CartonAudit\RequiredGarment;
use App\Models\Configure\PurchaseOrders\OrderQuantity;
use App\Models\Configure\Relation\StylePurchaseOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrders extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['no','style_id'];
    
    function style(){
        return $this->hasManyThrough(
            Styles::class,
            StylePurchaseOrder::class,
            'purchase_orders_id', 'id',
            'id',
            'styles_id',
        );
        //return $this->hasOneThrough(Buyers::class,Styles::class);
    }
    function orderQuantity(){
        return $this->hasOne(OrderQuantity::class,'purchase_order_id');
    }
    function requireInspectGarment(){
        return $this->hasOne(RequiredGarment::class,'purchase_order_id');
    }


    
}