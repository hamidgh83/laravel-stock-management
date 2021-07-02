<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\ClientStock;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientStockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClientStock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $stock = Stock::where('deleted_at', '=', null)->get()->random();

        return [
            'client_id' => Client::factory()->create(),
            'stock_id' => $stock->id,
            'volume' => $this->faker->numberBetween(100, 1000),
            'unit_price' => $this->faker->numberBetween(
                $stock->unit_price - ($stock->unit_price * 0.2), 
                $stock->unit_price + ($stock->unit_price * 0.2)
            ),
            'created_at' => $this->faker->dateTimeBetween($stock->created_at, 'now'),
        ];
    }
}
