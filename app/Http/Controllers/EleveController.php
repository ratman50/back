<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEleveRequest;
use App\Http\Requests\UpdateEleveRequest;
use App\Http\Resources\EleveResource;
use App\Http\Resources\UserRessource;
use App\Models\Annee;
use App\Models\Eleve;
use App\Models\Inscription;

class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EleveResource::collection(Eleve::all());
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEleveRequest $request)
    {
        ["classe"=>$classe,"annee"=>$annee]=$request->all();
        $ins=["classe"=>$request->classe,"annee"=>$request->annee];
        $info_eleve=array_diff_key($request->all(),$ins);
        $eleve=Eleve::insererEleve(
            $info_eleve
        );
        $inscription=new Inscription;
        $inscription->eleve_id=$eleve->id;
        $inscription->classe_id=$classe;
        $inscription->annee_id=$annee;
        $inscription->date_insc=now();
        $inscription->save();
        return new  EleveResource($eleve);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Eleve $eleve)
    {
        //
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEleveRequest $request, Eleve $eleve)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eleve $eleve)
    {
        //
    }
    public function getPartByEleve(string $id){
        // dd(Annee::actif());
        $ins=Inscription::where([
            ["eleve_id",$id],
            ["annee_id",Annee::actif()?->id]
        ]
        )->first();
        return $ins->classe->events;
    }
}
