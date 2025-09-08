<?php

namespace App\Models\Configure\Relation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StylePurchaseOrder extends Model
{
    use HasFactory;
    protected $fillable = ['purchase_orders_id','styles_id'];
    protected $table="styles_purchase_orders";
    public $timestamps = false;

}
