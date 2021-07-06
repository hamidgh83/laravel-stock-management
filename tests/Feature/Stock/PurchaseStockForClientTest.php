<?php

namespace Tests\Feature\Stock;

use App\Models\Client;
use App\Models\Stock;
use App\Modules\Stock\Resources\ClientStocksCollection;
use Illuminate\Http\Response;
use Tests\Feature\BaseFeatureTestCase;

class PurchaseStockForClientTest extends BaseFeatureTestCase
{
    public function test422NoCredit()
    {
        $client = Client::factory()->noCredit()->create();
        $stock  = Stock::factory()->create();

        $response = $this->postJson(route('client.purchase-stock', ['client' => $client->id, 'stock' => $stock->id]), [
            'volume' => $this->faker->numberBetween(1, 5),
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)->assertJsonStructure([
            'error' => [
                'code', 'message',
            ],
        ]);
    }

    public function testSuccess()
    {
        $client = Client::factory()->create();
        $stock  = Stock::factory()->create();

        $response = $this->postJson(route('client.purchase-stock', ['client' => $client->id, 'stock' => $stock->id]), [
            'volume' => $this->faker->numberBetween(1, 5),
        ]);

        $result = ClientStocksCollection::make($client->stocks)->response()->getData(true);

        $response
            ->assertSuccessful()
            ->assertJson($result);
    }
}
