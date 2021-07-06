<?php

namespace Tests\Feature\Stock;

use Illuminate\Http\Response;
use Tests\Feature\BaseFeatureTestCase;

class CreateClientTest extends BaseFeatureTestCase
{
    public function test422()
    {
        $response = $this->postJson(route('client.create'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)->assertJsonStructure([
            'errors' => [ 'username' ],
        ]);
    }

    public function testSuccess()
    {
        $response = $this->postJson(route('client.create'), [
            'username' => $username = $this->faker->username,
        ]);

        $this->assertDatabaseHas('clients', [
            'username' => $username,
            'balance' => 1000,
        ]);

        $response->assertSuccessful()->assertJsonStructure([
            'data' => [
                'id',
                'username',
                'balance',
                'profit',
            ],
        ]);
    }
}
