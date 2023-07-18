<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Event_classSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inputs=[
            [
                "event_id"=>1,
                "classe_id"=>1
            ],
            [
                "event_id"=>2,
                "classe_id"=>2
            ],[
                "event_id"=>3,
                "classe_id"=>1
            ],
            
        ];
        DB::table("classe_event")->insert($inputs);
        
    }
}
