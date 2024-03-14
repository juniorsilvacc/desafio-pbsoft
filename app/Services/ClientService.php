<?php

namespace App\Services;

use App\Models\Client;
use App\Repositories\ClientRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ClientService
{
    private $repository;

    public function __construct(ClientRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getPaginate($name = null): LengthAwarePaginator
    {
        $clients = $this->repository->getPaginate($name);

        return $clients;
    }

    public function getByUUid(string $clientUuid): ?Client
    {
        $client = $this->repository->getByUUid($clientUuid);

        return $client;
    }

    public function create(array $data): Client
    {
        $newClient = $this->repository->create($data);

        return $newClient;
    }

    public function update(array $data, string $clientUuid): ?Client
    {
        $client = $this->repository->update($data, $clientUuid);

        return $client;
    }

    public function delete(string $clientUuid): void
    {
        $this->repository->delete($clientUuid);
    }
}
