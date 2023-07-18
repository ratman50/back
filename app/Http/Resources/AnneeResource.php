<?php

namespace App\Http\Resources;

use App\Models\Annee;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnneeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                "current_annee"=>Annee::where("etat",1)->first(),
                "anneees"=>Annee::all()
        ];
    }
}
