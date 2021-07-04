<?php

namespace App\Modules\Stock\Services;

use App\Models\Client;
use App\Models\Stock;
use App\Repositories\StockRepository;
use Illuminate\Database\Eloquent\Collection;

class StockService
{
    /**
     * @var StockRepository
     */
    protected $stockRepository;

    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    /**
     * Create a new stock
     *
     * @param array $data
     *
     * @return Stock
     */
    public function create(array $data): Stock
    {
        return $this->stockRepository->create($data);
    }

    /**
     * Get an identified client stocks
     *
     * @param Client $client
     *
     * @return Collection
     */
    public function getClientStocks(Client $client): Collection
    {
        return $this->stockRepository->getClientStocks($client);
    }

    /**
     * Get all available stocks
     *
     * @return Collection
     */
    public function getAvailableStocks(): Collection
    {
        return $this->stockRepository->getAllStocks();
    }

    /**
     * Purchase a stock for a client
     *
     * @param Client $client
     * @param Stock $stock
     * @param float $volume
     *
     * @return Collection
     */
    public function purchaseStock(Client $client, Stock $stock, $volume): Collection
    {
        return $this->stockRepository->purchase($client, $stock, $volume);
    }
}
