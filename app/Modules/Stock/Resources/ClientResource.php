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
class ClientResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'balance' => $this->balance ?? 0,
            'profit' => $this->profit ?? 0,
        ];
    }
}
