<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;
    protected $fillable=[
        "libelle",
        "description",
        "date_event",
        "user_id"
    ];
    protected $hidden=[
        "send" ,
		"user_id" ,
		"created_at" ,
		"updated_at" 
    ];
    public function user():BelongsTo{
        return $this->BelongsTo(User::class,"user_id");
    }
    public function classes():BelongsToMany{
        return $this->belongsToMany(Classe::class);
    }
}
