<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\Models\Product;
/**
 * Class ProductRepository
 * @package App\Repositories 
 */
class ProductRepository
{
    /**
     * @var Product
     */
    protected $product;

    /**
     * ProductRepository constructor
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get all products
     * @return Product
     */
    public function getAllProducts()
    {
        return $this->product::paginate(5);
    }

    /**
     * Save Product to DB
     * @param mixed $reqest
     * @return Product
     */
    public function save($reqest)
    {
        $product = $this->product;
        $product->name =$reqest['name'];
        $product->ean =$reqest['ean'];
        $product->weight =$reqest['weight'];
        $product->color =$reqest['color'];
        $product->image =$this->getImageUrl($reqest);
        $product->save();
        
        return $product;
    }

    /**
     * Update product data in the DB
     * @param mixed $request
     * @param mixed $id
     * @return Product
     * 
     */
    public function update($request, $id)
    {
        $product = $this->product->find($id);
        $product->name =$request['name'];
        $product->ean =$request['ean'];
        $product->weight =$request['weight'];
        $product->color =$request['color'];
        $product->image =$this->getImageUrl($request);
        $product->save();
        
        return $product;
    }

    /**
     * Get product by id
     * @param mixed $id
     * @return Product
     */
    public function getProductById($id)
    {
        return $this->product::findOrFail($id);
    }

    /**
     * Delete product by id
     * @param mixed $id
     * @return Product
     */
    public function deleteProductById($id)
    {
        return $this->product::findOrFail($id)->delete();
    }

    /**
     * Save the image to a specific location and get the url
     * @param mixed $reqest
     * @return String
     */
    protected function getImageUrl($reqest)
    {
        $image = $reqest->file('image');
        @unlink(public_path('public/images/product_images/'.$reqest->image));
        $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('public/images/product_images'),$image_name);
        $image_url = 'public/images/product_images'.$image_name;

        return $image_url;
    }
}
