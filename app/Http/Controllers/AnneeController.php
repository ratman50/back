<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnneeRequest;
use App\Http\Requests\UpdateAnneeRequest;
use App\Models\Annee;
use Symfony\Component\HttpFoundation\Response;

class AnneeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            "data"=>[
                "current_annee"=>Annee::where("etat",1)->first(),
                "annees"=>Annee::all()
            ]
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnneeRequest $request)
    {
        $annee=Annee::create([
            "libelle"=>$request->libelle
        ]);
        return [$annee];
    }

    /**
     * Display the specified resource.
     */
    public function show(Annee $annee)
    {
        return["data"=>$annee];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnneeRequest $request, Annee $annee)
    {
        if($request->all()){
            if($request->etat && $request->etat==1)
            {
                $actif=Annee::where("etat", 1)->first();
                if($actif)
                    $actif->update(["etat"=>0]);
            }
            $annee->update($request->only("libelle","etat"));
            
            return ["data"=>$annee];
        }
        return response(["message"=>"Tous les champs ne peuvent pas etre vides"], Response::HTTP_NOT_FOUND);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Annee $annee)
    {
        dd($annee);
    }
}
