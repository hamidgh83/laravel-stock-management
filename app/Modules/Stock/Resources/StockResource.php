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
class StockResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'company' => $this->company_name,
            'unit_price' => $this->unit_price,
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
