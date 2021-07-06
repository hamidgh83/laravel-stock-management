<?php

namespace Tests\Feature\Stock;

use App\Models\Stock;
use App\Modules\Stock\Resources\StockCollection;
use Tests\Feature\BaseFeatureTestCase;

class LoadStocksTest extends BaseFeatureTestCase
{
    public function testSuccess()
    {
        $stocks   = Stock::factory(10)->create();
        $response = $this->getJson(route('stock.list'));
        $results  =  StockCollection::make($stocks)->response()->getData(true);

        $response->assertSuccessful()->assertJson($results);
    }
}
