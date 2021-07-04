<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\Stock;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class StockRepository extends BaseRepository
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = [
        'company_name',
        'unit_price',
    ];

    public function getModel(): string
    {
        return Stock::class;
    }

    public function getClientStocks(Client $client): Collection
    {
        return $client->stocks()->get();
    }

    public function getAllStocks(): Collection
    {
        return $this->query()->get();
    }

    public function purchase(Client $client, Stock $stock, $volume): Collection
    {
        $stock->purchasedBy()->attach($client->id, ['volume' => $volume, 'unit_price' => $stock->unit_price]);

        return $client->stocks()->get();
    }
}
