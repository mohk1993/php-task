<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\Product;
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

    /**
     * Save to DB if there are no errors
     * @param mixed $request
     * @return String
     */
    public function saveProductData($request)
    {
        if($this->isValid($request))
        {
            $result = $this->productRepositoy->save($request);
        }

        return $result;
    }

   
    /**
     * Update in the DB if there are no errors
     * @param mixed $request
     * @param mixed $id
     * @return String
     */
    public function updateProduct($request, $id)
    {
        DB::beginTransaction();
        $product = $this->productRepositoy->update($request, $id);
        DB::commit();

        return $product;
    }

    /**
     * Get the specified product by id
     * @param mixed $id
     * @return String
     */
    public function getById($id)
    {
        return $this->productRepositoy->getProductById($id);
    }

    /**
     * Delete product by id
     * @param mixed $id
     * @return String
     */
    public function deleteById($id)
    {
        return $this->productRepositoy->deleteProductById($id);
    }

    /**
     * Check if the request is valid
     * @param mixed $request
     * @return boolean
     */
    public function isValid($request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'ean' => ['required', 'string', 'max:13'],
            'weight' => ['required','numeric'],
            'color' => ['required', 'string'],
            'image' => ['required'],
        ]); 

        return true;
    }
}