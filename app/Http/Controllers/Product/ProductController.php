<?php

declare(strict_types=1);

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

        return view('products.products', compact('products'));
    }

    /**
     * Redirect to the product details with the resource
     * @param mixed $id
     * @return resource product_detail page view to be redirected to
     */
    public function viewInfo($id)
    {
        $productInfo = $this->getProductById($id);

        return view('products.product_details',compact('productInfo'));
    }

    /**
     * Redirect to the add_product page
     * @return resource add_product page view to be redirect to
     */
    public function viewAddProduct()
    {
        return view('products.add_product');
    }

    /**
     * Redirect to the udate page 
     * @param mixed $id
     * @return resource update page with injected product information
     */
    public function viewUpdateProduct($id)
    {
        $productI = $this->productService->getById($id);

        return view('products.update', compact('productI'));
    }

    /**
     * Get the specfied product by the id
     * @param mixed $id
     * @return mixed the specified product fields
     */
    public function getProductById($id)
    {
        $result = $this->productService->getById($id);

        return $result;
    }

    /**
     * Store product data
     * @param Request $request
     * @return resource redirect back
     */
    public function addProduct(Request $request)
    {
        $data = $this->productService->saveProductData($request);

        return redirect()->back();
    }

    /**
     * Update product data in the DB
     * @param Request $request
     * @param mixed $id
     * @return resource redirect to products view page
     */
    public function update(Request $request, $id)
    {
        $result = $this->productService->updateProduct($request, $id);

        return view('products.update');
    }

    /**
     * Delete product by id
     * @param mixed $id
     * @return resource to redirect to dashboard
     */
    public function delete($id)
    {
        $product = $this->productService->deleteById($id);

        return view('dashboard');
    }
}
