<?php

namespace App\Modules\Stock\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StockCollection extends ResourceCollection
{
    public $collects = StockResource::class;
}
