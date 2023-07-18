<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classe extends Model
{
    use HasFactory;
    public function niveau():BelongsTo{
        return $this->belongsTo(Niveau::class,"niveau_id");
    }

    protected $fillable=[
        "libelle",
        "niveau_id"
    ];
    // protected $casts = [
    //     'libelle' => 'upperCase',
    // ];
    public function events():BelongsToMany{
        return $this->belongsToMany(Event::class);
    }
    public function inscriptions():HasMany{
        return $this->HasMany(Inscription::class);
    }
    public function info_disciplines():HasMany{
        return $this->hasMany(Info_discipline::class);
    }
}
