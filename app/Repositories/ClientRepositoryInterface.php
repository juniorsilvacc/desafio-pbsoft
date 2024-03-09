<?php

namespace App\Repositories;

interface ClientRepositoryInterface
{
    public function getPaginate($filter = null, $perPage = 5);

    public function createClient(array $data);

    public function getByUUid(string $clientUuid);

    public function updateClient(array $data, string $clientUuid);

    public function deleteClient(string $clientUuid);
}
