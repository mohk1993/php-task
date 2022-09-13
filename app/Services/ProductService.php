<?php

declare(strict_types = 1);

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService
{
    /**
     * @var $productRepositoy
     */
    protected $productRepositoy;

    /**
     * ProductService constructor
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepositoy = $productRepository;
    }

    /**
     * Get all products
     * @return String
     */
    public function getAll()
    {
        return $this->productRepositoy->getAllProducts();
    }
}