<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Inscription;
use App\Models\Max_note;
class Note extends Model
{
    use HasFactory;
    public function inscription():BelongsTo{
        return $this->belongsTo(Inscription::class,"eleve_id");
    }
    public function  max_note():BelongsTo{
        return $this->belongsTo(Max_note::class);
    }
}
