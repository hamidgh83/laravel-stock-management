<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ClientRepository extends BaseRepository
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = [
        'username',
        'balance',
    ];

    public function getModel(): string
    {
        return Client::class;
    }

    public function getAllClients(): Collection
    {
        /** @var Client */
        $client = $this->makeModel();
        
        return $client::select(
            'clients.id', 
            'clients.username', 
            'clients.balance', 
            DB::raw('SUM((stocks.unit_price - clients_stocks.unit_price) * clients_stocks.volume) as profit')
        )
        ->join('clients_stocks', 'clients.id', '=', 'clients_stocks.client_id') 
        ->join('stocks', 'stocks.id', '=', 'clients_stocks.stock_id') 
        ->groupBy('clients.id') 
        ->get();
    }
}
