<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class ProductCollection extends ResourceCollection
{

    /**
     * @var Product
     */
    protected Product $product;

    /**
     * ProductRepository constructor
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|Arrayable|JsonSerializable
    {
        return [
            'id' => $this->product->id,
            'name' => $this->product->name,
            'ean' => $this->product->ean,
            'weight' => $this->product->weight,
            'color' => $this->product->color,
            'price' => $this->product->price,
            'quantity' => $this->product->quantity,
            'image' => $this->product->image
        ];
    }
}
