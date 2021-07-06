<?php

namespace Tests\Feature\Stock;

use App\Models\Client;
use App\Modules\Stock\Resources\ClientCollection;
use Tests\Feature\BaseFeatureTestCase;

class LoadClientsTest extends BaseFeatureTestCase
{
    public function testSuccess()
    {
        $clients  = Client::factory(10)->create();
        $response = $this->getJson(route('client.list'));
        $results  =  ClientCollection::make($clients)->response()->getData(true);

        $response->assertSuccessful()->assertJson($results);
    }
}
