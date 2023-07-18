<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClasseResource;
use App\Http\Resources\InscriptionResource;
use App\Http\Resources\NoteResource;
use App\Models\Annee;
use App\Models\Classe;
use App\Models\Info_discipline;
use App\Models\Inscription;
use App\Models\Max_note;
use App\Models\Note;
use App\Models\Semestre;
use App\Models\Semestre_actif;
use App\Models\Type_note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ClasseController extends Controller
{
    public function index(){
        return ClasseResource::collection(Classe::all());
    }
    public function show(Classe $classe){
        
        return new ClasseResource($classe);
    }
    public function store(Request $request){
        $request->validate([
            "classe"=>["required","string","unique:classes,libelle"],
            "niveau"=>["required","numeric","exists:App\Models\Niveau,id"]
        ]);

        $classe=Classe::create([
            "libelle"=>strtoupper($request->classe),
            "niveau_id"=>$request->niveau
        ]);

        return new ClasseResource($classe);
    }
    public function addCoeff(Request $request, $classe){
        $request->validate([
            "discipline"=>["required","exists:App\Models\Discipline,id"],
            "annee"=>["required","exists:App\Models\Annee,id"],
            "type_note"=>["required","exists:App\Models\Type_note,id"]
        ]);
        $info_discipline=DB::table("info_disciplines")
        ->where("discipline_id",$request->discipline)
        ->where("classe_id", $classe)
        ->where("annee_id", $request->annee)
        ->first();
        if($info_discipline){
            $id=$info_discipline->id;
            $type_id=Type_note::find($request->type_note)->id;
            DB::table("max_notes")
            ->where("type_note_id",$type_id)
            ->where("info_discipline_id",$id)
            ->update(["max_note"=>$request->max_note]);
            return;
        }
        return response([
            "message"=>["impossible de modifier discipline"],
            Response::HTTP_NOT_FOUND
        ]);
    }
    public function addNote(Request $request, $classe, $discipline, $evaluation){
        // 
        // dd($request->collect("notes")-each());
        $request->validate([
            "notes"=>["array"]
        ]);
        $semestre=Semestre_actif::where("classe_id",$classe)->first("id");
        $id_info=Info_discipline::where([
            ["classe_id",$classe],
            ["discipline_id",$discipline],
            ["annee_id",$request->annee]
        ])->first("id");
        if($id_info && $semestre){
            $id_max=Max_note::where([
                ["info_discipline_id",$id_info->id],
                ["type_note_id",$evaluation]
            ])->first(["id","max_note"]);
            $request->collect("notes")->each(function($note) use( $semestre, $id_max){
                if($id_max->max_note>=$note["eleve"] && $note["eleve"]>=0)
                {

                    $note=Note::UpdateOrInsert(
                        [
                        "eleve_id"=>$note["eleve"],
                        "semestre_id"=>$semestre->id,
                        "max_note_id"=>$id_max->id,
                        "val_note"=>$note["eleve"]
                        ],
                        ["val_note"=>$note["eleve"]]
                );
                }
                return $note;
            });
        }
       
    }
    public function getNote($classe, $eleve=null){
        // return NoteResource::collection(Note::all());
        if($eleve)
            return  new InscriptionResource(Inscription::findOrFail($eleve)->where("classe_id", $classe)->first());
            
        
        return  InscriptionResource::collection(Inscription::all()->where("classe_id", $classe));
    }

    public function getNoteByDiscipline($classe, $discipline){
        $infoDisci = Info_discipline::where([
            ["classe_id", $classe],
            ["discipline_id", $discipline],
            ["annee_id", Annee::where("etat",1)->first("id")->id]
        ])->first()->max()->get("id")->pluck("id");
        $notes=Note::whereIn("max_note_id",$infoDisci)->get();
        // dd($notes);
        return  NoteResource::collection(collect($notes)->unique("eleve_id"));

    }
}
