<?php

namespace App\Modules\Stock\Controllers;

use App\Models\Stock;
use App\Modules\Stock\Services\StockService;

class DeleteStockController
{
    /**
     * @var StockService
     */
    private $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function __invoke(Stock $stock): void
    {
        $this->stockService->delete($stock);
    }
}
