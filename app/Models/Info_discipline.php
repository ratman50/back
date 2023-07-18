<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Info_discipline extends Model
{
    use HasFactory;
    protected $fillable=[
        "classe_id",
        "discipline_id",
        "annee_id"
    ];
    public function classe():BelongsTo{
        return $this->belongsTo(Classe::class);
    }
    public function discipline():BelongsTo{
        return $this->belongsTo(Discipline::class);
    }
   
    public function annee():BelongsTo{
        return $this->belongsTo(Annee::class);
    }
    public function max():HasMany{
        return $this->hasMany(Max_note::class);
    }
}
