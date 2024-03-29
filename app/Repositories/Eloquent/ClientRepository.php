<?php

namespace App\Repositories\Eloquent;

use App\Models\Client;
use App\Repositories\ClientRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ClientRepository implements ClientRepositoryInterface
{
    private $model;

    public function __construct(Client $client)
    {
        $this->model = $client;
    }

    public function getPaginate(string $name = null, $perPage = 5): LengthAwarePaginator
    {
        $query = $this->model->orderBy('created_at', 'asc');

        if ($name !== null) {
            $query->where('name', 'LIKE', "%{$name}%");
        }

        return $query->paginate($perPage);
    }

    public function getByUUid(string $clientUuid): ?Client
    {
        $client = $this->model->where('id', $clientUuid)->first();

        return $client;
    }

    public function create(array $data): Client
    {
        $newClient = $this->model->create($data);

        return $newClient;
    }

    public function update(array $data, string $clientUuid): ?Client
    {
        $client = $this->model->where('id', $clientUuid)->first();

        $client->update($data);

        return $client;
    }

    public function delete(string $clientUuid): void
    {
        $client = $this->model->findOrFail($clientUuid);

        $client->delete();
    }
}
