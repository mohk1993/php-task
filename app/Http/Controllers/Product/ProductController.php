<?php

declare(strict_types=1);

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * class ProductController
 * @package App\Http\Controllers\Product
 */
class ProductController extends Controller
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
     * @return View
     */
    public function view(): view
    {
        $products = $this->productService->getAll();

        return view('products.products', compact('products'));
    }

    /**
     * Redirect to the product details with the resource
     * @param int $id
     * @return view
     */
    public function viewInfo(int $id): view
    {
        $productInfo = $this->getById($id);

        return view('products.product_details', compact('productInfo'));
    }

    /**
     * Get the specified product by the id
     * @param int $id
     * @return Product
     */
    public function getById(int $id): Product
    {
        return $this->productService->getById($id);
    }

    /**
     * Redirect to the add_product page
     * @return View
     */
    public function viewAdd(): View
    {
        return view('products.add_product');
    }

    /**
     * Redirect to the update page
     * @param int $id
     * @return View
     */
    public function viewUpdate(int $id): View
    {
        $productI = $this->productService->getById($id);

        return view('products.update', compact('productI'));
    }

    /**
     * Store product data
     * @param Request $request
     * @return RedirectResponse
     */
    public function add(Request $request): RedirectResponse
    {
        $this->productService->saveData($request);

        return redirect()->back();
    }

    /**
     * Update product data in the DB
     * @param Request $request
     * @param int $id
     * @return View
     */
    public function update(Request $request, int $id): View
    {
        $this->productService->update($request, $id);

        return view('products.update');
    }

    /**
     * Delete product by id
     * @param int $id
     * @return View
     */
    public function delete(int $id): View
    {
        $this->productService->deleteById($id);

        return view('dashboard');
    }
}
