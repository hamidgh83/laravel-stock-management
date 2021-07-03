<?php

namespace App\Modules\Stock\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ClientStocksCollection extends ResourceCollection
{
    public $collects = ClientStocksResource::class;
}
