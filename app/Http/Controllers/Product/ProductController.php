<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

/**
 * class ProductController
 * @package App\Http\Controllers\Product
 */
class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * ProductService constructor
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the products
     * @return resource the page to be redirect to
     */
    public function viewProducts()
    {
        $products = $this->productService->getAll();

        return view('products.products',compact('products'));
    }
}
