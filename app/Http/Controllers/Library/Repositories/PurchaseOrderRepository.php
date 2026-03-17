<?php

namespace App\Http\Controllers\Library\Repositories;

use App\Models\Configure\CartonAudit\RequiredGarment;
use App\Models\Configure\PurchaseOrders;
use App\Models\Configure\Relation\StylePurchaseOrder;
use App\Models\Configure\Styles;
use Illuminate\Support\Collection;

class PurchaseOrderRepository
{
    public function __construct()
    {
        $this->stylePurchaseOrder = new StylePurchaseOrder();
    }
    public function process(Collection $orderInfo, Styles $style): void
    {
        $purchaseOrders = $this->extractPurchaseOrders($orderInfo);


        foreach ($purchaseOrders as $order) {
            $po = $this->createPurchaseOrders($order, $style);
            $this->updateOrCreateStylePurchaseOrder($po, $style);
            $this->createOrderQuantity($po, $style, $order['qty']);
            $this->updateOrCreateRequiredGarment($po, $style);
        }
    }
    private function createPurchaseOrders(array $order, Styles $styles): PurchaseOrders
    {
        return PurchaseOrders::updateOrCreate(
            ['no'=>$order['buyerpo'],'style_id'=>$styles->id],
            ['no'=>$order['buyerpo'],'style_id'=>$styles->id]
        );
    }
    private function updateOrCreateStylePurchaseOrder(PurchaseOrders $purchaseOrder, Styles $styles): void
    {
        StylePurchaseOrder::updateOrCreate([
            'purchase_orders_id'=>$purchaseOrder->id,'styles_id'=>$styles->id
        ]);
    }
    private function createOrderQuantity(PurchaseOrders $purchase_orders, Styles $styles, int $qty): void
    {
        PurchaseOrders\OrderQuantity::updateOrCreate(
            ['styles_id'=>$styles->id,'purchase_order_id'=>$purchase_orders->id],
            ['styles_id'=>$styles->id,'purchase_order_id'=>$purchase_orders->id,'quantity'=>$qty]
        );
    }
    private function updateOrCreateRequiredGarment(PurchaseOrders $purchase_orders, Styles $styles): void
    {
        RequiredGarment::updateOrCreate([
            'styles_id'=>$styles->id,
            'purchase_order_id'=>$purchase_orders->id,
        ], [
            'styles_id'=>$styles->id,
            'purchase_order_id'=>$purchase_orders->id,
            'amount'=>100,
            'is_percentage'=>true
        ]);
    }

    private function extractPurchaseOrders(Collection $orderInfo): Collection
    {
        return $orderInfo->groupBy('buyerpo')->map(function ($item, $buyerpo) {
            $qty = intVal($item->sum('qty'));
            return compact('buyerpo', 'qty');
        });
    }
}
