<?php

namespace App\Modules\Stock\Services;

use App\Exceptions\HttpExceptions\InsufficientCreditException;
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

    /**
     * Deduct given amount from client balance
     *
     * @param Client $client
     * @param float $value
     *
     * @throws InsufficientCreditException
     *
     * @return Client
     */
    public function deductFromBalance(Client $client, float $amount): Client
    {
        $balance = $client->balance - $amount;

        if ($balance < 0) {
            throw new InsufficientCreditException();
        }

        return $this->clientRepository->update(['balance' => $balance], $client);
    }
}
