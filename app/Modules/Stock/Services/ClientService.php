<?php

namespace App\Modules\Stock\Services;

use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Database\Eloquent\Collection;

class ClientService
{
    /**
     * @var ClientRepository
     */
    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * Create a new client
     *
     * @param array $data
     *
     * @return Client
     */
    public function create(array $data): Client
    {
        return $this->clientRepository->create(
            array_merge($data, [ 'balance' => Client::DEFAULT_BALANCE ])
        );
    }

    /**
     * Get all clients
     *
     * @return Collection
     */
    public function getAllClients(): Collection
    {
        return $this->clientRepository->getAllClients();
    }
}
