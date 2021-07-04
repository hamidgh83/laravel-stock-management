<?php

namespace App\Modules\Stock\Controllers;

use App\Models\Client;
use App\Models\Stock;
use App\Modules\Stock\Requests\CreateClientStockRequest;
use App\Modules\Stock\Resources\ClientStocksCollection;
use App\Modules\Stock\Services\ClientService;
use App\Modules\Stock\Services\StockService;

class CreateClientStockController
{
    /**
     * @var StockService
     */
    private $stockService;

    /**
     * @var ClientService
     */
    private $clientService;

    public function __construct(StockService $stockService, ClientService $clientService)
    {
        $this->stockService  = $stockService;
        $this->clientService = $clientService;
    }

    public function __invoke(Client $client, Stock $stock, CreateClientStockRequest $request): ClientStocksCollection
    {
        $collection = $this->stockService->purchaseStock($client, $stock, $request->get('volume'));
        $amount     = $request->get('volume') * $stock->unit_price;

        $this->clientService->deductFromBalance($client, $amount);

        return ClientStocksCollection::make($collection);
    }
}
