<?php

namespace App\Repositories;

interface ClientRepositoryInterface
{
    public function getPaginate($filter = null, $perPage = 5);

    public function getByUUid(string $clientUuid);

    public function create(array $data);

    public function update(array $data, string $clientUuid);

    public function delete(string $clientUuid);
}
