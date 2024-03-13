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
            'name' => $this->name,
            'social_name' => $this->social_name,
            'birth_date' => $this->birth_date,
            'cpf' => $this->cpf,
            'photo' => $this->photo,
        ];
    }
}
