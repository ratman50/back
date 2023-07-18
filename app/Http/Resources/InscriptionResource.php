<?php

namespace App\Http\Resources;

use App\Models\Max_note;
use App\Models\Semestre;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        ["id"=>$id,"nom"=>$nom,"sexe"=>$sexe,
        "prenom"=>$prenom,"date_naiss"=>$date_naiss,
        "lieu_naiss"=>$lieu_naiss,"email"=>$email,
        "numero"=>$numero]=$this->eleve;
        $res=[
            "id"=>$id,
            "nom"=>$nom,
            "prenom"=>$prenom,
            "date_naiss"=>$date_naiss,
            "lieu_naiss"=>$lieu_naiss,
            "email"=>$email,
            "sexe"=>$sexe?"masculin":"feminin",
        ];
        if($numero)
        {
            $res["numero"]=$this->numero;
            $res["type"]="interne";
        }else
            $res["type"]="externe";
        $copie=[];
       foreach ($this->notes as $note) {
            $id_max=Max_note::find($note->max_note_id);
            $svg=$id_max->info_discipline;
            $copie[]=[
                "note_id"=>$note->id,
                "note"=>$note->val_note,
                "discipline"=>$svg->discipline->libelle,
                "groupe"=>$svg->discipline->groupe ? $svg->discipline->groupe->libelle : $svg->discipline->groupe,
                "evaluation"=>$id_max->type_note->libelle,
                "semestre"=>Semestre::find($note->semestre_id)->libelle
            ];
       }
       $res["notes"]=$copie;
        return $res;
        }
}
