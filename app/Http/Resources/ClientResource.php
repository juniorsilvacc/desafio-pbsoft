<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->name,
            'nome_social' => $this->social_name,
            'data_nascimento' => $this->birth_date,
            'cpf' => $this->cpf,
            'foto' => $this->photo,
        ];
    }
}
