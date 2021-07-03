<?php

namespace App\Modules\Stock\Controllers;

use App\Modules\Stock\Requests\CreateClientRequest;
use App\Modules\Stock\Resources\ClientResource;
use App\Modules\Stock\Services\ClientService;

class CreateClientController
{
    /**
     * @var ClientService
     */
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function __invoke(CreateClientRequest $request): ClientResource
    {
        return ClientResource::make(
            $this->clientService->create($request->validated())
        );
    }
}
