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
     * ProductService constructor
     * @param ProductRepository $productRepository
     */
    public function __construct(private ProductRepository $productRepository)
    {
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
     * Save to DB if there are no errors
     * @param Request $request
     * @return Product
     */
    public function saveData(Request $request): Product
    {
        return $this->productRepository->save($request);
    }

    /**
     * Update in the DB if there are no errors
     * @param Request $request
     * @param int $id
     * @return Product
     */
    public function update(Request $request, int $id): Product
    {
        return $this->productRepository->update($request, $id);
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
     * @param int $id
     * @return void
     */
    public function deleteById(int $id): void
    {
        $this->productRepository->deleteById($id);
    }
}
