<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events=[
            [
                "libelle"=>"Composition",
                "description"=>"composition des élèves de primaire",
                "date_event"=> date("2023-07-10"),
                "user_id"=>'4'
            ],
            [
                "libelle"=>"Fosco",
                "description"=>"fetes organises pour les élèves",
                "date_event"=>date("2023-07-08"),
                "user_id"=>'3'
            ],
            [
                "libelle"=>"Ressource",
                "description"=>" évaluation de mathématiques",
                "date_event"=>date("2023-07-11"),
                "user_id"=>'3'
            ],
        ];
        Event::insert($events);
    }
}
