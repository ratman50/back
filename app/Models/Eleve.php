<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Mockery\Matcher\Not;

class Eleve extends Model
{
    use HasFactory;
    protected $fillable=[
        "numero",
        "prenom",
        "nom",
        "date_naiss",
        "lieu_naiss",
        "type",
        "sexe"
    ];

   public function inscriptions():BelongsToMany{
    return $this->belongsToMany(Inscription::class);
   }
    static public function generateNumero()
    {
        $exclus = DB::table('eleves')
        ->whereNotNull("numero")
        ->where("etat","=",0)
        ->orderBy("numero")
        ->get();

        $eleve_find=null;
        if($exclus)
        {
            foreach ($exclus as $eleve) {
                $find=DB::table('eleves')
                ->where("numero",$eleve->numero)
                ->where("etat","=",1)
                ->first();
                if(!$find){
                    $eleve_find=$eleve;
                    break;
                }
            }
            if($eleve_find)
                return $eleve_find->numero;
        }
        return DB::table('eleves')
        ->where("etat","=",1)
        ->max("numero","=",0)
         + 1;
    }
    static public function insererEleve($data){
        if($data["profil"]){
           
            $value=Eleve::generateNumero();
            $tab=[...$data,$value];

            return Eleve::create(
                [...$data,"numero"=>$value]
            );

        }
        return Eleve::create($data);
    }
}
