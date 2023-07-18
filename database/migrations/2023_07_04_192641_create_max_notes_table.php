<?php

use App\Models\Info_discipline;
use App\Models\Type_note;
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
        Schema::create('max_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Info_discipline::class)->constrained();
            $table->foreignIdFor(Type_note::class)->constrained();
            $table->integer("max_note");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('max_notes');
    }
};
