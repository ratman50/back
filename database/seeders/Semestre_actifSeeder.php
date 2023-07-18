<?php

namespace Database\Seeders;

use App\Models\Semestre_actif;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Semestre_actifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semestre_actifs=[
            [
                "semestre_id"=>1,
                "classe_id"=>1
            ],[
                "semestre_id"=>1,
                "classe_id"=>2
            ]
            ];
        Semestre_actif::insert($semestre_actifs);
    }
}
