<?php

namespace App\Modules\Stock\Controllers;

use App\Modules\Stock\Resources\StockCollection;
use App\Modules\Stock\Services\StockService;

class GetStocksController
{
    /**
     * @var StockService
     */
    private $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService= $stockService;
    }

    public function __invoke()
    {
        return StockCollection::make(
            $this->stockService->getAvailableStocks()
        );
    }
}
