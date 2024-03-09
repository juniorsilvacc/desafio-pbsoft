<?php

namespace App\Repositories;

interface ClientRepositoryInterface
{
    public function getPaginate($filter = null, $perPage = 5);

    public function createClient(array $data);

    public function getById(string $truckId);

    public function updateClient(array $data, string $clientId);

    public function deleteClient(string $clientId);
}
