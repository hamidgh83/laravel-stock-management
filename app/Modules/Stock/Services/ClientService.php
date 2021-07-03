<?php

namespace App\Modules\Stock\Services;

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
     * Get all clients
     *
     * @return Collection
     */
    public function getAllClients(): Collection
    {
        return $this->clientRepository->getAllClients();
    }
}
