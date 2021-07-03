<?php

namespace Database\Factories;

use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $createdAt = Carbon::createFromTimestamp($this->faker->dateTimeBetween('-6 month', '-1 day')->getTimeStamp()) ;
        $updatedAt = Carbon::createFromFormat('Y-m-d H:i:s', now())->addHours($this->faker->numberBetween(-5, 0));

        return [
            'company_name' => $this->faker->company,
            'unit_price' => $this->faker->numberBetween(10, 100),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
            // 'deleted_at' => $this->faker->optional()->dateTime(),
        ];
    }
}
