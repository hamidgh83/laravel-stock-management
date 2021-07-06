<?php

namespace Tests\Feature\Stock;

use Illuminate\Http\Response;
use Tests\Feature\BaseFeatureTestCase;

class CreateStockTest extends BaseFeatureTestCase
{
    public function test422()
    {
        $response = $this->postJson(route('stock.create'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)->assertJsonStructure([
            'errors' => [
                'company_name', 'company_name',
            ],
        ]);
    }

    public function testSuccess()
    {
        $data = [
            'company_name' => $this->faker->company,
            'unit_price' => $this->faker->numberBetween(10, 100),
        ];

        $response = $this->postJson(route('stock.create'), $data);

        $this->assertDatabaseHas('stocks', [
            'company_name' => $data['company_name'],
            'unit_price' => $data['unit_price'],
        ]);

        $response->assertSuccessful()->assertJsonStructure([
            'data' => [
                'id',
                'company',
                'unit_price',
                'updated_at',
            ],
        ]);
    }
}
