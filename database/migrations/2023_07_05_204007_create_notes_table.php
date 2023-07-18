<?php

use App\Models\Eleve;
use App\Models\Inscription;
use App\Models\Max_note;
use App\Models\Semestre;
use App\Models\Semestre_actif;
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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Inscription::class)->constrained();
            $table->foreignIdFor(Max_note::class)->constrained();
            $table->foreignIdFor(Semestre_actif::class)->constrained();
            $table->integer("val_note");
            $table->boolean("etat")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
