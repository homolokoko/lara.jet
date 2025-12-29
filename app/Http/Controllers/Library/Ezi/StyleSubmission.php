<?php

namespace App\Http\Controllers\Library\Ezi;

use App\Http\Controllers\Library\Repositories\BuyerRepository;
use App\Http\Controllers\Library\Repositories\OrderRepository;
use App\Http\Controllers\Library\Repositories\ProductRepository;
use App\Http\Controllers\Library\Repositories\PurchaseOrderRepository;
use App\Http\Controllers\Library\Repositories\StyleRepository;
use App\Http\Controllers\Library\Repositories\SizeRepository;
use App\Http\Controllers\Library\Repositories\ColorRepository;
use App\Models\Configure\Styles;
use Illuminate\Support\Collection;
use Throwable;

class StyleSubmission
{
    private OrderRepository $orderRepository;
    private BuyerRepository $buyerRepository;
    private StyleRepository $styleRepository;
    private ColorRepository $colorRepository;
    private SizeRepository $sizeRepository;
    private PurchaseOrderRepository $purchaseOrderRepository;
    private ProductRepository $productRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->buyerRepository = new BuyerRepository();
        $this->styleRepository = new StyleRepository();
        $this->colorRepository = new ColorRepository();
        $this->sizeRepository = new SizeRepository();
        $this->productRepository = new ProductRepository();
        $this->purchaseOrderRepository = new PurchaseOrderRepository();
    }

    /**
     * @throws Throwable
     */
    public function save(array $buyerData, array $styleData): Styles
    {
        $orderInfo = $this->getOrderInfo($styleData);

        $buyer = $this->buyerRepository->updateOrCreate($buyerData);
        $style = $this->styleRepository->createWithBuyer($styleData, $buyer);

        $this->purchaseOrderRepository->process($orderInfo, $style);
        $this->colorRepository->process($orderInfo, $style);
        $this->sizeRepository->process($orderInfo, $style);
        $this->productRepository->process($orderInfo, $style);
        $this->orderRepository->markAsProcessed($styleData);

        return $style;
    }


    private function getOrderInfo(array $styleData): Collection
    {
        $columnName = $this->orderRepository->getOrderType($styleData);
        return $this->orderRepository->findByColumn($columnName, $styleData['name']);
    }
}
