<?php

namespace App\Modules\Stock\Controllers;

use App\Models\Client;
use App\Modules\Stock\Resources\ClientStocksCollection;
use App\Modules\Stock\Services\StockService;

class GetClientStocksController
{
    /**
     * @var StockService
     */
    private $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function __invoke(Client $client)
    {
        return ClientStocksCollection::make(
            $this->stockService->getClientStocks($client)
        );
    }
}
