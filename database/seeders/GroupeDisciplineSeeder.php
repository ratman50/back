<?php

namespace Database\Seeders;

use App\Models\GroupeDiscipline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupeDisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groupe_disciplines=[
            ["libelle"=>"langue et communication"],
            ["libelle"=>"mathématiques"]
        ];

        GroupeDiscipline::insert($groupe_disciplines);
    }
}
