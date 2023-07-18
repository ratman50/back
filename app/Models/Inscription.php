<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inscription extends Model
{
    use HasFactory;

    public function eleve():BelongsTo{
        return $this->belongsTo(Eleve::class);
    }
    public function classe():BelongsTo{
        return $this->belongsTo(Classe::class);
    }
    public function annee():BelongsTo{
        return $this->belongsTo(Annee::class);
    }
    public function notes():HasMany{
        return $this->hasMany(Note::class,"eleve_id");
    }
}
