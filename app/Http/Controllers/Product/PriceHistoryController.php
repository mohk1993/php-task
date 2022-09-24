<?php

namespace App\Http\Controllers\Product;

use App\Charts\PriceHistoryChart;
use App\Http\Controllers\Controller;
use App\Services\ChartService;
use App\Services\ProductService;
use Illuminate\View\View;

class PriceHistoryController extends Controller
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
    public function getPriceHistoryChart(int $id): view
    {
        $priceChart = $this->productService->getPriceHistory($id);
        $productInfo = $this->productService->getById($id);

        return view('products.product_details', compact('productInfo', 'priceChart'));
    }
}
