<?php

namespace App\Modules\Stock\Services;

use App\Models\Client;
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
     * Get an identified client stocks
     *
     * @param Client $client
     * @return Collection
     */
    public function getClientStocks(Client $client): Collection
    {
        return $this->stockRepository->getClientStocks($client);
    }

    /**
     * Get all available stocks
     *
     * @return void
     */
    public function getAvailableStocks(): Collection
    {
        return $this->stockRepository->getAllStocks();
    }
}
