<?php

namespace App\Models;

use App\Traits\JointureTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Niveau extends Model
{
    use HasFactory,JointureTrait;

    protected $fillable=[
        "libelle"
    ];
    protected $hidden=[
        "created_at",
        "updated_at"
   ];

   public function classes():HasMany{
    return $this->hasMany(Classe::class);
   }
}
