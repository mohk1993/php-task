<?php

namespace App\Repositories;

use App\Models\PriceHistory;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * @package App\Repositories
 */
class PriceRepository
{
    /**
     * PriceRepository constructor
     * @param Product $product
     */
    public function __construct(private Product $product)
    {
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getPriceHistory(int $id): Collection
    {
        return PriceHistory::where('product_id', $id)
            ->where('created_at', '>', Carbon::now()->subDays(90))->pluck('price', 'created_at');
    }

    /**
     * @param Product $data
     * @return void
     */
    public function addPriceToHistory(Product $data): void
    {
        PriceHistory::create([
            'product_id' => $data->id,
            'price' => $data->price
        ]);

        Cache::flush();
    }
}
