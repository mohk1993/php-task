<?php

declare(strict_types=1);

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Services\PriceService;
use App\Services\ProductService;
use Illuminate\View\View;

/**
 * Class PriceHistoryController extends Controller
 * @package App\Http\Controllers\Product
 */
class PriceHistoryController extends Controller
{
    /**
     * ProductService constructor
     * @param ProductService $productService
     * @param PriceService $priceService
     */
    public function __construct(private ProductService $productService, private PriceService $priceService)
    {
    }

    /**
     * @param int $id
     * @return view
     */
    public function show(int $id): view
    {
        $priceChart = $this->priceService->getPriceHistory($id);
        $productInfo = $this->productService->getById($id);

        return view('products.show', compact('productInfo', 'priceChart'));
    }
}
