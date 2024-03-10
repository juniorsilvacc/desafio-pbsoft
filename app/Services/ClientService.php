<?php

namespace App\Services;

use App\Repositories\ClientRepositoryInterface;

class ClientService
{
    private $repository;

    public function __construct(ClientRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getPaginate($filter = null)
    {
        $clients = $this->repository->getPaginate($filter);

        return $clients;
    }

    public function getByUUid(string $clientUuid)
    {
        $client = $this->repository->getByUUid($clientUuid);

        return $client;
    }

    public function create(array $data)
    {
        $newClient = $this->repository->create($data);

        return $newClient;
    }

    public function update(array $data, string $clientUuid)
    {
        $client = $this->repository->update($data, $clientUuid);

        return $client;
    }

    public function delete(string $clientUuid)
    {
        $this->repository->delete($clientUuid);
    }
}
