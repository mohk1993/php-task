<?php

namespace App\Listeners;

use App\Events\QuantityHistoryCreated;
use App\Services\ProductService;

class AddQuantityToQuantityHistoryTable
{
    /**
     * @var ProductService
     */
    protected ProductService $productService;


    /**
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Handle the event.
     *
     * @param QuantityHistoryCreated $event
     * @return void
     */
    public function handle(QuantityHistoryCreated $event): void
    {
        $this->productService->addQuantityHistory($event->product);
    }
}
