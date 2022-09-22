<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Events\PriceHistoryCreated;
use App\Events\QuantityHistoryCreated;
use App\Models\PriceHistory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ProductRepository
 * @package App\Repositories
 */
class ProductRepository
{
    /**
     * @var Product
     */
    protected Product $product;

    /**
     * ProductRepository constructor
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get all products
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->product::paginate(5);
    }

    /**
     * Update product data in the DB
     * @param Request $request
     * @param int $id
     * @param string $getImageUrl
     * @return Product
     */
    public function update(Request $request, int $id, string $getImageUrl): Product
    {
        $product = $this->product->find($id);
        $product->name = $request['name'];
        $product->ean = $request['ean'];
        $product->weight = $request['weight'];
        $product->color = $request['color'];
        $product->quantity = $request['quantity'];
        $product->price = $request['price'];
        $product->image = $getImageUrl;
        $product->save();

        event(new PriceHistoryCreated($product));
        event(new QuantityHistoryCreated($product));

        return $product;
    }

    /**
     * Save Product to DB
     * @param Request $request
     * @param string $getImageUrl
     * @return Product
     */
    public function save(Request $request, string $getImageUrl): Product
    {
        $product = $this->product;
        $product->name = $request['name'];
        $product->ean = $request['ean'];
        $product->weight = $request['weight'];
        $product->color = $request['color'];
        $product->quantity = $request['quantity'];
        $product->price = $request['price'];
        $product->image = $getImageUrl;
        $product->save();

        event(new PriceHistoryCreated($product));
        event(new QuantityHistoryCreated($product));

        return $product;
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
    }

    /**
     * @param Product $data
     * @return void
     */
    public function addQuantityToHistory(Product $data): void
    {
        PriceHistory::create([
            'product_id' => $data->id,
            'price' => $data->price
        ]);
    }

    /*     public function getPriceHistory($product)
        {
            $productHistory = Product::select('price')->where('id',$product->id)->where( 'created_at', '>', Carbon::now()->subDays(30))->get();
        }  */

    /*     public function getQuantityHistory($product)
        {

        }  */

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
     * Delete product by id
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool
    {
        return $this->product::findOrFail($id)->delete();
    }
}
