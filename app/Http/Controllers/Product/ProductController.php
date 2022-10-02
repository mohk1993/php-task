<?php

declare(strict_types=1);

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
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
     * ProductService constructor
     * @param ProductService $productService
     */
    public function __construct(private ProductService $productService)
    {
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $products = $this->productService->getAll();

        return view('products.index', compact('products'));
    }

    /**
     * Redirect to the add_product page
     * @return View
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Store product data
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->productService->saveData($request);

        return redirect()->back();
    }

    /**
     * Redirect to the product details with the resource
     * @param int $id
     * @return view
     */
    public function show(int $id): View
    {
        $productInfo = $this->productService->getById($id);

        return view('products.show', compact('productInfo'));
    }

    /**
     * Redirect to the update page
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $productI = $this->productService->getById($id);

        return view('products.edit', compact('productI'));
    }

    /**
     * Update product data in the DB
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $this->productService->update($request, $id);

        return redirect()->route('products.index');
    }

    /**
     * Delete product by id
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->productService->deleteById($id);

        return redirect()->back();
    }
}
