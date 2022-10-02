<?php

namespace App\Listeners;

use App\Events\QuantityHistoryCreated;
use App\Services\QuantityService;

class AddQuantityToQuantityHistoryTable
{
    /**
     * @param QuantityService $quantityService
     */
    public function __construct(private QuantityService $quantityService)
    {
    }

    /**
     * Handle the event.
     *
     * @param QuantityHistoryCreated $event
     * @return void
     */
    public function handle(QuantityHistoryCreated $event): void
    {
        $this->quantityService->addQuantityHistory($event->product);
    }
}
