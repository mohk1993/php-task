<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Events\PriceHistoryCreated;
use App\Events\QuantityHistoryCreated;
use App\Models\PriceHistory;
use App\Models\Product;
use App\Models\QuantityHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * Class ProductRepository
 * @package App\Repositories
 */
class ProductRepository
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
     * @param Request $request
     * @return Application|ResponseFactory|Response
     * @throws ValidationException
     */
    public function logIn(Request $request): Application|ResponseFactory|Response
    {

        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw validationException::withMessages([
                'email' => ['incorrect ']
            ]);
        }
        $token = $user->createToken('myapp-token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
     * Get all products
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return Cache::remember('productList-page-' . request('page', 1), now()->addMinutes(5), function () {
            return $this->product::paginate(5);
        });
    }

    /**
     * Update product data in the DB
     * @param Request $request
     * @param int $id
     * @param string $getImageUrl
     * @return Product
     */
    public function update(Request $request, int $id, string $getImageUrl): Product
    {
        $product = $this->product->find($id);
        $product->name = $request['name'];
        $product->ean = $request['ean'];
        $product->weight = $request['weight'];
        $product->color = $request['color'];
        $product->quantity = $request['quantity'];
        $product->price = $request['price'];
        $product->image = $getImageUrl;
        $product->save();

        event(new PriceHistoryCreated($product));
        event(new QuantityHistoryCreated($product));

        return $product;
    }

    /**
     * Save Product to DB
     * @param Request $request
     * @param string $getImageUrl
     * @return Product
     */
    public function save(Request $request, string $getImageUrl): Product
    {
        $product = $this->product;
        $product->name = $request['name'];
        $product->ean = $request['ean'];
        $product->weight = $request['weight'];
        $product->color = $request['color'];
        $product->quantity = $request['quantity'];
        $product->price = $request['price'];
        $product->image = $getImageUrl;
        $product->save();

        event(new PriceHistoryCreated($product));
        event(new QuantityHistoryCreated($product));

        return $product;
    }

    /**
     * @param Product $data
     * @return void
     */
    public function addPriceToHistory(Product $data): void
    {
        PriceHistory::create([
            'product_id' => $data->id,
            'price' => $data->price
        ]);

        Cache::flush();
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getPriceHistory(int $id): Collection
    {
        return PriceHistory::where('product_id', $id)
            ->where('created_at', '>', Carbon::now()->subDays(90))->pluck('price', 'created_at');
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getQuantityHistory(int $id): Collection
    {
        return QuantityHistory::where('product_id', $id)
            ->where('created_at', '>', Carbon::now()->subDays(90))->pluck('quantity', 'created_at');
    }

    /**
     * @param Product $data
     * @return void
     */
    public function addQuantityToHistory(Product $data): void
    {
        QuantityHistory::create([
            'product_id' => $data->id,
            'quantity' => $data->quantity
        ]);
    }

    /**
     * Get product by id
     * @param int $id
     * @return Product
     */
    public function getById(int $id): Product
    {
        return $this->product::findOrFail($id);
    }


    /**
     * @param int $id
     * @return void
     */
    public function deleteById(int $id): void
    {
        $this->product::findOrFail($id)->delete();

        Cache::flush();
    }
}
