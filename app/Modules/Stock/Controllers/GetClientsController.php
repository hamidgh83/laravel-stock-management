<?php

namespace App\Modules\Stock\Controllers;

use App\Models\Client;
use App\Modules\Stock\Resources\ClientCollection;
use App\Modules\Stock\Services\ClientService;

class GetClientsController
{
    /**
     * @var ClientService
     */
    private $clientService;

    public function __construct(clientService $clientService)
    {
        $this->clientService= $clientService;
    }

    public function __invoke(): ClientCollection
    {
        return ClientCollection::make(
            $this->clientService->getAllClients()
        );
    }
}
