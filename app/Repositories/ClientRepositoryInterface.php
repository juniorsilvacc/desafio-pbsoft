<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ClientRepositoryInterface
{
    public function getPaginate(string $name = null, $perPage = 5): LengthAwarePaginator;

    public function getByUUid(string $clientUuid): ?Client;

    public function create(array $data): Client;

    public function update(array $data, string $clientUuid): ?Client;

    public function delete(string $clientUuid): void;
}
