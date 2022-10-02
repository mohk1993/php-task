<?php

namespace App\Services;

use App\Charts\PriceHistoryChart;
use App\Models\Product;
use App\Repositories\PriceRepository;
use Illuminate\Support\Collection;

/**
 * @package App\Services
 */
class PriceService
{
    /**
     * PriceService constructor
     * @param PriceRepository $priceRepository
     */
    public function __construct(private PriceRepository $priceRepository)
    {
    }

    /**
     * @param int $id
     * @return PriceHistoryChart
     */
    public function getPriceHistory(int $id): PriceHistoryChart
    {
        $priceHistory = $this->priceRepository->getPriceHistory($id);

        return $this->priceHistoryChart($priceHistory);
    }

    /**
     * @param Product $data
     * @return void
     */
    public function addPriceHistory(Product $data): void
    {
        $this->priceRepository->addPriceToHistory($data);
    }

    /**
     * @param Collection $priceData
     * @return PriceHistoryChart
     */
    private function priceHistoryChart(Collection $priceData): PriceHistoryChart
    {
        $chart = new PriceHistoryChart;
        $chart->labels($priceData->keys());
        $chart->dataset('Price History', 'line', $priceData->values());
        return $chart;
    }
}
