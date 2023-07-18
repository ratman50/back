<?php

namespace Database\Seeders;

use App\Models\Discipline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $disciplines=[
            [
                "libelle"=>"Activtés de mesure",
                "groupe_discipline_id"=>1
            ],
            [
                "libelle"=>"communication",
                "groupe_discipline_id"=>2
            ],
        ];
        Discipline::insert($disciplines);
    }
}
