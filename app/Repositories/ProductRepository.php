<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Events\PriceHistoryCreated;
use App\Events\QuantityHistoryCreated;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProductRepository
 * @package App\Repositories
 */
class ProductRepository
{
    /**
     * ProductRepository constructor
     * @param Product $product
     */
    public function __construct(private Product $product)
    {
    }

    /**
     * Get all products
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return Cache::remember('productList-page-' . request('page', 1), now()->addMinutes(5), function () {
            return $this->product::paginate(5);
        });
    }

    /**
     * Update product data in the DB
     * @param Request $request
     * @param int $id
     * @return Product
     */
    public function update(Request $request, int $id): Product
    {
        $product = $this->product->find($id);
        $product->name = $request['name'];
        $product->ean = $request['ean'];
        $product->weight = $request['weight'];
        $product->color = $request['color'];
        $product->quantity = $request['quantity'];
        $product->price = $request['price'];
        if ($request->file('image')) {
            $product->image = $request->file('image')->storePublicly('images', 'public');
        }
        $product->save();

        event(new PriceHistoryCreated($product));
        event(new QuantityHistoryCreated($product));

        return $product;
    }

    /**
     * Save Product to DB
     * @param Request $request
     * @return Product
     */
    public function save(Request $request): Product
    {
        $product = $this->product;
        $product->name = $request['name'];
        $product->ean = $request['ean'];
        $product->weight = $request['weight'];
        $product->color = $request['color'];
        $product->quantity = $request['quantity'];
        $product->price = $request['price'];
        $product->image = $request->file('image')->storePublicly('images', 'public');
        $product->save();

        event(new PriceHistoryCreated($product));
        event(new QuantityHistoryCreated($product));

        return $product;
    }

    /**
     * Get product by id
     * @param int $id
     * @return Product
     */
    public function getById(int $id): Product
    {
        return $this->product::findOrFail($id);
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteById(int $id): void
    {
        $this->product::findOrFail($id)->delete();

        Cache::flush();
    }
}
