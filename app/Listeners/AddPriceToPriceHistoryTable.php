<?php

namespace App\Listeners;

use App\Events\PriceHistoryCreated;
use App\Services\PriceService;
use App\Services\ProductService;

/**
 * @package App\Listeners
 */
class AddPriceToPriceHistoryTable
{
    /**
     * ProductService constructor
     * @param PriceService $priceService
     */
    public function __construct(private PriceService $priceService)
    {
    }

    /**
     * Handle the event.
     *
     * @param PriceHistoryCreated $event
     * @return void
     */
    public function handle(PriceHistoryCreated $event): void
    {
        $this->priceService->addPriceHistory($event->product);
    }
}
