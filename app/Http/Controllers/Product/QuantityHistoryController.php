<?php

declare(strict_types=1);

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Services\QuantityService;
use Illuminate\View\View;

/**
 * Class QuantityHistoryController extends Controller
 * @package App\Http\Controllers\Product
 */
class QuantityHistoryController extends Controller
{
    /**
     * ProductService constructor
     * @param ProductService $productService
     * @param QuantityService $quantityService
     */
    public function __construct(private ProductService $productService, private QuantityService $quantityService)
    {
    }

    /**
     * @param int $id
     * @return view
     */
    public function show(int $id): view
    {
        $quantityChart = $this->quantityService->getQuantityHistory($id);
        $productInfo = $this->productService->getById($id);

        return view('products.show', compact('productInfo', 'quantityChart'));
    }
}
