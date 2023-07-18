<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GroupeDiscipline extends Model
{
    use HasFactory;
    protected $fillable=[
        "libelle"
    ];

    public function disciplines():HasMany{
        return $this->hasMany(Discipline::class);
    }
}