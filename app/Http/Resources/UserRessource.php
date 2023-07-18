<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "email"=>$this->email,
            "nom"=>$this->name,
            "user_name"=>$this->user_name,
            "role"=>$this->role->libelle
        ];
    }
}
