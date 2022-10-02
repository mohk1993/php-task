<?php

namespace Tests\Unit;

use App\Charts\PriceHistoryChart;
use App\Charts\QuantityHistoryChart;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery\MockInterface;
use Tests\TestCase;

/**
 * @group product
 */
class ProductTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function testGetProductList(): void
    {
        $this->partialMock(ProductRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('getAll')
                ->once()
                ->andReturn(new LengthAwarePaginator([], 0, 20));
        });

        $result = $this->getTestClassInstance()->getAll();

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    }

    /**
     * @return ProductService
     * @throws BindingResolutionException
     */
    private function getTestClassInstance(): ProductService
    {
        return app()->make(ProductService::class);
    }

    /**
     * @return void
     * @throws BindingResolutionException
     */
    public function testGetQuantityHistoryChart(): void
    {
        $id = $this->faker->randomNumber();

        $this->partialMock(ProductRepository::class, function (MockInterface $mock) use ($id) {
            $mock->shouldReceive('getQuantityHistory')
                ->once()
                ->with($id)
                ->andReturn(collect([
                    [
                        'id' => $id,
                        'name' => '::fake_name::',
                    ]
                ]));
        });

        $this->mock('overload:' . QuantityHistoryChart::class, function (MockInterface $mock) {
            $mock->shouldReceive('labels')
                ->once();

            $mock->shouldReceive('dataset')
                ->once();
        });

        $result = $this->getTestClassInstance()->getQuantityHistory($id);

        $this->assertInstanceOf(QuantityHistoryChart::class, $result);
    }

    /**
     * @return void
     * @throws BindingResolutionException
     */
    public function testGetPriceHistoryChart(): void
    {
        $id = $this->faker->randomNumber();

        $this->partialMock(ProductRepository::class, function (MockInterface $mock) use ($id) {
            $mock->shouldReceive('getPriceHistory')
                ->once()
                ->with($id)
                ->andReturn(collect([
                    [
                        'id' => $id,
                        'name' => '::fake_name::',
                    ]
                ]));
        });

        $this->mock('overload:' . PriceHistoryChart::class, function (MockInterface $mock) {
            $mock->shouldReceive('labels')
                ->once();

            $mock->shouldReceive('dataset')
                ->once();
        });

        $result = $this->getTestClassInstance()->getPriceHistory($id);

        $this->assertInstanceOf(PriceHistoryChart::class, $result);
    }


}
