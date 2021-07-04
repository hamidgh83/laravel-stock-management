<?php

namespace App\Modules\Stock\Controllers;

use App\Models\Stock;
use App\Modules\Stock\Requests\UpdateStockRequest;
use App\Modules\Stock\Resources\StockResource;
use App\Modules\Stock\Services\StockService;

class UpdateStockController
{
    /**
     * @var StockService
     */
    private $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function __invoke(Stock $stock, UpdateStockRequest $request): StockResource
    {
        return StockResource::make(
            $this->stockService->update($stock, $request->validated())
        );
    }
}
