<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "libelle"=>$this->libelle,
            "description"=>$this->description,
            "date"=>$this->date_event,
            "user"=>$this->user->name
        ];
    }
}
