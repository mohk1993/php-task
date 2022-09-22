<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService
{
    /**
     * @var ProductRepository
     */
    protected ProductRepository $productRepository;

    /**
     * ProductService constructor
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Get all products
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->productRepository->getAll();
    }

    /**
     * @param Product $data
     * @return void
     */
    public function addPriceHistory(Product $data): void
    {
        $this->productRepository->addPriceToHistory($data);
    }

    /**
     * @param Product $data
     * @return void
     */
    public function addQuantityHistory(Product $data): void
    {
        $this->productRepository->addQuantityToHistory($data);
    }

    /**
     * Save to DB if there are no errors
     * @param Request $request
     * @return Product
     */
    public function saveData(Request $request): Product
    {
        return $this->productRepository->save($request, $this->getImageUrl($request));
    }

    /**
     * Save the image to a specific location and get the url
     * @param Request $request
     * @return string
     */
    protected function getImageUrl(Request $request): string
    {
        $image = $request->file('image');
        @unlink(public_path('public/images/product_images/' . $request->image));
        $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('public/images/product_images'), $image_name);

        return 'public/images/product_images' . $image_name;
    }

    /**
     * Update in the DB if there are no errors
     * @param Request $request
     * @param int $id
     * @return Product
     */
    public function update(Request $request, int $id): Product
    {
        return $this->productRepository->update($request, $id, $this->getImageUrl($request));
    }

    /**
     * Get the specified product by id
     * @param int $id
     * @return Product
     */
    public function getById(int $id): Product
    {
        return $this->productRepository->getById($id);
    }

    /**
     * Delete product by id
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool
    {
        return $this->productRepository->deleteById($id);
    }

    /*     public function getPriceHistory($product)
        {
            $priceHistory = Product::select('price')->where('id',$product->id)->where( 'created_at', '>', Carbon::now()->subDays(30))->get();
        } */

    /*     public function getQuantityHistory($product)
        {

        } */
}
