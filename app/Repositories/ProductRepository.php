<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\Models\Product;

/**
 * Class ProductRepository
 * @package App\Repositories 
 */
class ProductRepository
{
    /**
     * @var Product
     */
    protected $product;

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
     * @return Product
     */
    public function getAllProducts()
    {
        return $this->product->get();
    }
}
