<?php

namespace App\Models\Configure\PurchaseOrders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OrderQuantity extends Model
{
    use HasFactory;
    protected $fillable = ['styles_id','purchase_order_id','quantity'];
    protected $table="purchase_order_quantity";
    protected $appends = ['display'];
    public $timestamps = false;

    // english notation (default)
    function getDisplayAttribute(){
        return Str::of( number_format($this->quantity))->append(' pcs')->__toString();
    }
}
