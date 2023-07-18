<?php

namespace Database\Seeders;

use App\Models\Type_note;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Type_noteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type_notes=[
            ['libelle'=>"RESSOURCE","niveau_id"=>2],
            ['libelle'=>"COMPOSITION","niveau_id"=>2],
            ['libelle'=>"DEVOIR","niveau_id"=>1],
            ['libelle'=>"EXAMEN","niveau_id"=>1],
        ];
        Type_note::insert($type_notes);
    }
}
