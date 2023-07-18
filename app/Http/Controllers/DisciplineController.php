<?php

namespace App\Http\Controllers;

use App\Http\Resources\DisciplineResource;
use App\Models\Classe;
use App\Models\Discipline;
use App\Models\GroupeDiscipline;
use App\Models\Info_discipline;
use App\Models\Max_note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class DisciplineController extends Controller
{
    public function addDiscipline(Request $request, $classe){
        $request->validate([
            "classe"=>["required","exists:App\Models\Classe,id"],
            "discipline"=>["required","exists:App\Models\Discipline,id"],
            "annee"=>["required","exists:App\Models\Annee,id"]
        ]
        );
        $niveau=Classe::find($classe)->niveau_id;
        $types=DB::table("type_notes")->where("niveau_id",$niveau)->get();
        $info_discipline=Info_discipline::create(
            [
                "classe_id"=>$request->classe,
                "discipline_id"=>$request->discipline,
                "annee_id"=>$request->annee
            ]
        );
        foreach ($types as $type) {
            $id_type=$type->id;
            $max_note= new Max_note();
            $max_note->info_discipline_id=$info_discipline->id;
            $max_note->type_note_id=$id_type;
            $max_note->max_note=0;
            $max_note->save();

        }

        

    }

    public function index(){
        return DisciplineResource::collection(Discipline::all());
    }
    public function store(Request $request){
        $request->validate([
            "discipline"=>["required","string"],
            "groupe"=>["sometimes","required"]
        ]);
        $input=["libelle"=>$request->discipline];
        $groupe="";
        if($request->groupe){
            $groupe=$request->groupe;
            $matching=preg_match('/^[0-9]+$/', $groupe);
            if($matching && !GroupeDiscipline::find($groupe)){
                return response(["message"=>"le groupe avec id=$groupe n'existe pas "],Response::HTTP_NOT_FOUND);
            }elseif(!$matching){
                $groupe=GroupeDiscipline::create([
                    "libelle"=>$groupe
                ])->id;
            }
            $input["groupe_discipline_id"]=$groupe;
           
        }
        $discipline=Discipline::create($input);
    }
    function update(Request $request, Discipline $discipline) {
        $request->validate(
            [
                "discipline"=>["sometimes","required"],
                "groupe"=>["sometimes","required"]
            ]
        );

    }
}
