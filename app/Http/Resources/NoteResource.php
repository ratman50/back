<?php

namespace App\Http\Resources;

use App\Models\Eleve;
use App\Models\Inscription;
use App\Models\Max_note;
use App\Models\Note;
use App\Models\Semestre;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $res=[];
        $res=[
            "eleve"=> new EleveResource($this->inscription->eleve),

            // "notes"=> NoteBisResource::collection( Note::where([
            //             ["eleve_id",$this->id],
            //             ["max_note_id",$this->max_note_id]
            //     ])->get())
            "notes"=>[
                Note::where([
                    ["eleve_id",$this->id],
                    ["max_note_id",$this->max_note_id]
            ])->get()
            ]
        ];
       
        return $res;
        
    }
}
