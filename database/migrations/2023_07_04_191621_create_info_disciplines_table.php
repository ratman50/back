<?php

use App\Models\Annee;
use App\Models\Classe;
use App\Models\Discipline;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('info_disciplines', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Classe::class)->constrained();
            $table->foreignIdFor(Discipline::class)->constrained();
            $table->foreignIdFor(Annee::class)->constrained();
            $table->boolean("etat")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_disciplines');
    }
};
