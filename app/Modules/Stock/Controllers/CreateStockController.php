<?php

namespace App\Modules\Stock\Controllers;

use App\Modules\Stock\Requests\CreateStockRequest;
use App\Modules\Stock\Resources\StockResource;
use App\Modules\Stock\Services\StockService;

class CreateStockController
{
    /**
     * @var StockService
     */
    private $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function __invoke(CreateStockRequest $request): StockResource
    {
        return StockResource::make(
            $this->stockService->create($request->validated())
        );
    }
}
