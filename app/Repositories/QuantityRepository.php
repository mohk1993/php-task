<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\QuantityHistory;
use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * @package App\Repositories
 */
class QuantityRepository
{
    /**
     * QuantityRepository constructor
     * @param Product $product
     */
    public function __construct(private Product $product)
    {
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getQuantityHistory(int $id): Collection
    {
        return QuantityHistory::where('product_id', $id)
            ->where('created_at', '>', Carbon::now()->subDays(90))->pluck('quantity', 'created_at');
    }

    /**
     * @param Product $data
     * @return void
     */
    public function addQuantityToHistory(Product $data): void
    {
        QuantityHistory::create([
            'product_id' => $data->id,
            'quantity' => $data->quantity
        ]);
    }
}
