<?php

namespace Tests\Feature\Stock;

use App\Models\Stock;
use App\Modules\Stock\Resources\StockResource;
use Illuminate\Http\Response;
use Tests\Feature\BaseFeatureTestCase;

class UpdateStockTest extends BaseFeatureTestCase
{
    public function test422()
    {
        $stock = Stock::factory()->create();

        $response = $this->putJson(route('stock.update', ['stock' => $stock->getKey()]));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)->assertJsonStructure([
            'errors' => ['unit_price'],
        ]);
    }

    public function test404()
    {
        $stock = Stock::factory()->create();

        $response = $this->putJson(route('stock.update', ['stock' => $this->faker->md5]));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testSuccess()
    {
        $stock = Stock::factory()->create();

        $response = $this->putJson(
            route('stock.update', ['stock' => $stock->getKey()]),
            ['unit_price' => $unitPrice = $this->faker->numberBetween(100, 110)]
        );

        $this->assertDatabaseHas('stocks', [
            'unit_price' => $unitPrice,
        ]);

        $this->assertDatabaseMissing('stocks', [
            'unit_price' => $stock->unit_price,
        ]);

        $newStock                       = StockResource::make($stock)->response()->getData(true);
        $newStock['data']['unit_price'] = $unitPrice;
        $newStock['data']['updated_at'] = $response->json()['data']['updated_at'];

        $response->assertSuccessful()->assertJson($newStock);
    }
}
