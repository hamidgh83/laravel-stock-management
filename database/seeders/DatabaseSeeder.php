<?php

namespace Database\Seeders;

use App\Models\ClientStock;
use App\Models\Stock;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Stock::factory(5)->create();

        ClientStock::factory(10)->create();
    }
}
