<?php

namespace App\Modules\Stock\Controllers;

use App\Models\Client;
use App\Models\Stock;
use App\Modules\Stock\Requests\CreateClientStockRequest;
use App\Modules\Stock\Resources\ClientStocksCollection;
use App\Modules\Stock\Services\StockService;

class CreateClientStockController
{
    /**
     * @var StockService
     */
    private $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function __invoke(Client $client, Stock $stock, CreateClientStockRequest $request): ClientStocksCollection
    {
        return ClientStocksCollection::make(
            $this->stockService->purchaseStock($client, $stock, $request->get('volume'))
        );
    }
}
