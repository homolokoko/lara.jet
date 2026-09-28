<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StylePurchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'style_purchase_order';
    protected $fillable = ['style_id','purchase_order_id'];

    public function style()
    {
        return $this
            ->belongsTo(
                Style::class,
                'styles_id'
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
}
