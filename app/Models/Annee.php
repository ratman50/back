<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Annee extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
       'libelle',
       "etat",
   ];
   protected $hidden=[
        "created_at",
        "updated_at"
   ];
   public function inscriptions():HasMany{
    return $this->HasMany(Inscription::class,"inscriptions");
   }
   public function info_disciplines():HasMany{
    return $this->hasMany(Info_discipline::class);
    }
    public static function actif():Model{
        return Annee::where("etat",1)->first();
    }
}
