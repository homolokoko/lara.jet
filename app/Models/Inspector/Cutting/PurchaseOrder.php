<?php

namespace App\Models\Inspector\Cutting;

use App\Models\Configure\PurchaseOrders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $table = 'cutting_purchase_order';
    protected $fillable = ['purchase_order_id','cutting_header_id'];
    public $timestamps = false; 

    function purchaseOrderNumber(){
        return $this->belongsTo(PurchaseOrders::class,'purchase_order_id');
    }
}
