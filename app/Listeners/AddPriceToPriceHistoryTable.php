<?php

namespace App\Listeners;

use App\Events\PriceHistoryCreated;
use App\Services\ProductService;

/**
 * @package App\Listeners
 */
class AddPriceToPriceHistoryTable
{
    /**
     * @var ProductService
     */
    private ProductService $productService;

    /**
     * ProductService constructor
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Handle the event.
     *
     * @param PriceHistoryCreated $event
     * @return void
     */
    public function handle(PriceHistoryCreated $event): void
    {
        $this->productService->addPriceHistory($event->product);
    }
}
