<?php

namespace App\Repositories\Eloquent;

use App\Models\Client;
use App\Repositories\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{
    private $model;

    public function __construct(Client $client)
    {
        $this->model = $client;
    }

    public function getPaginate($filter = null, $perPage = 5)
    {
        $query = $this->model->orderBy('created_at', 'asc');

        if ($filter) {
            $query->where(function ($query) use ($filter) {
                $query->where('name', 'LIKE', "%{$filter}%")
                      ->orWhere('cpf', 'LIKE', "%{$filter}%");
            });
        }

        return $query->paginate($perPage);
    }

    public function createClient(array $data)
    {
    }

    public function getByUUid(string $clientUuid)
    {
        $client = $this->model->where('id', $clientUuid)->first();

        return $client;
    }

    public function updateClient(array $data, string $clientUuid)
    {
    }

    public function deleteClient(string $clientUuid)
    {
    }
}
