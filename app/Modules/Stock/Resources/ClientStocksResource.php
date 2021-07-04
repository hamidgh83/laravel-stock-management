<?php

namespace App\Modules\Stock\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ClientResource
 *
 * @property int id
 * @property string username
 * @property int balance
 *
 * @package App\Modules\Client\Resources
 */
class ClientStocksResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'company' => $this->company_name,
            'volume' => $this->pivot->volume,
            'purchase_price' => $this->pivot->unit_price,
            'current_price' => $this->unit_price,
            'profit' => ($this->unit_price - $this->pivot->unit_price) * $this->pivot->volume,
            'created_at' => $this->pivot->created_at->toDateTimeString(),
            'updated_at' => $this->pivot->updated_at->toDateTimeString(),
        ];
    }
}
