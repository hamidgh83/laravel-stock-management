<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';

    public function clients(): BelongsToMany
    {
        return $this
                ->belongsToMany(Client::class, 'clients_stocks', 'stock_id', 'client_id')
                ->withPivot('volume', 'unit_price')
    	        ->withTimestamps();
    }
}
