<?php

namespace App\Services;

use App\Charts\QuantityHistoryChart;
use App\Models\Product;
use App\Repositories\QuantityRepository;
use Illuminate\Support\Collection;

/**
 * @package App\Services
 */
class QuantityService
{
    /**
     * QuantityService constructor
     * @param QuantityRepository $quantityRepository
     */
    public function __construct(private QuantityRepository $quantityRepository)
    {
    }

    /**
     * @param int $id
     * @return QuantityHistoryChart
     */
    public function getQuantityHistory(int $id): QuantityHistoryChart
    {
        $quantityHistory = $this->quantityRepository->getQuantityHistory($id);

        return $this->quantityHistoryChart($quantityHistory);
    }

    /**
     * @param Product $data
     * @return void
     */
    public function addQuantityHistory(Product $data): void
    {
        $this->quantityRepository->addQuantityToHistory($data);
    }

    /**
     * @param Collection $quantityData
     * @return QuantityHistoryChart
     */
    private function quantityHistoryChart(Collection $quantityData): QuantityHistoryChart
    {
        $chart = new QuantityHistoryChart();
        $chart->labels($quantityData->keys());
        $chart->dataset('Quantity History', 'line', $quantityData->values());
        return $chart;
    }
}
