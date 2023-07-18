<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Info_discipline;
use App\Models\Type_note;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Max_note extends Model
{
    use HasFactory;
    public function info_discipline():BelongsTo{
        return $this->belongsTo(Info_discipline::class);
    }
    public function type_note():BelongsTo{
        return $this->belongsTo(Type_note::class);
    }
    public function notes():HasMany{
        return $this->hasMany(Note::class);
    }

}
