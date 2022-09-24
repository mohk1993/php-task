<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\View\View;

class QuantityHistoryController extends Controller
{
    /**
     * @var ProductService
     */
    private ProductService $productService;

    /**
     * ProductService constructor
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param int $id
     * @return view
     */
    public function getQuantityHistoryChart(int $id): view
    {
        $quantityChart = $this->productService->getQuantityHistory($id);
        $productInfo = $this->productService->getById($id);

        return view('products.product_details', compact('productInfo', 'quantityChart'));
    }
}
