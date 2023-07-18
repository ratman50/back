<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discipline extends Model
{
    use HasFactory;

    protected $fillable=[
        "libelle",
        "groupe_discipline_id",
    ];

    protected $hidden=[
        "created_at",
		"updated_at"
    ];

    public function groupe():BelongsTo{
        return $this->belongsTo(GroupeDiscipline::class,"groupe_discipline_id");
    }
    public function info_disciplines():HasMany{
        return $this->hasMany(Info_discipline::class);
    }
}
