<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateNiveauRequest;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Joinable;

class NiveauController extends Controller
{
    use Joinable;
    public function index(){
        return[
            "data"=>Niveau::all()
        ];
    }
    public function show(Niveau $niveau)
    {
        // dd(Niveau::query());
        return $niveau->join("classes");
        // return[
        //     "data"=>$niveau
        // ];
    }
    public function store(Request $request){
        $request->validate(
            ["libelle"=>["required","unique:niveaux"]]
        );
        $niveau=Niveau::create($request->all());
        return[
            "data"=>$niveau
        ];
    }
    public function update(UpdateNiveauRequest $request, Niveau $niveau){
        
       
        $niveau->update($request->all());
        return ["data"=>$niveau];
    }
}
