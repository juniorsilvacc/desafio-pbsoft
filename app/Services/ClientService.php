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
        $trucks = $this->repository->getPaginate($filter);

        return $trucks;
    }

    public function getByUUid($clientUuid)
    {
        $travel = $this->repository->getByUUid($clientUuid);

        return $travel;
    }
}
