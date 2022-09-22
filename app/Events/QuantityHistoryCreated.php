<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * @package App\Events
 */
class QuantityHistoryCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     *
     * @var Product
     */
    public Product $product;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($product)
    {
        $this->product = $product;
    }
}
