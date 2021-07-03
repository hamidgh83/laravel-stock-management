<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    
    public function stocks(): BelongsToMany
    {
        return $this
                ->belongsToMany(Stock::class, 'clients_stocks')
                ->withPivot('volume', 'unit_price')
    	        ->withTimestamps();
    }    
}
