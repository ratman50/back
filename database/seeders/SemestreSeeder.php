<?php

namespace Database\Seeders;

use App\Models\Semestre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semestres=[
            [
                "libelle"=>"trimestre 1",
                "niveau_id"=>2
            ],
            [
                "libelle"=>"trimestre 2",
                "niveau_id"=>2
            ],
            [
                "libelle"=>"trimestre 3",
                "niveau_id"=>2
            ],
            [
                "libelle"=>"semestre 1",
                "niveau_id"=>1
            ],
            [
                "libelle"=>"semestre 2",
                "niveau_id"=>1
            ],
        ];
        Semestre::insert($semestres);
        
        
    }
}
