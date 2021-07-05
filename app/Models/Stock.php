<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'stocks';

    public function purchasedBy(): BelongsToMany
    {
        return $this
            ->belongsToMany(Client::class, 'clients_stocks')
            ->withPivot('volume', 'unit_price')
            ->withTimestamps();
    }
}
