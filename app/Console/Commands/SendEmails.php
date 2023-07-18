<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Inscription;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command desaacription.
     *
     * @var string
     */
    protected $description = 'Sending emails to the users.';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        
        $data=array('name'=>'xxxx');
        Mail::send('emails.test', $data, function ($message) {
            $message->from('ratma96@gmail.com');
            $delai=Carbon::now()->subDay(5);
            $current_events=Event::where([
                ["date_event",">",$delai],
                ["send",0]
                ]
            )->with("classes")->get();
            foreach ($current_events as $current_event) {
                $classes_id=$current_events->pluck("classes.*.id");
                foreach ($classes_id as $classe_id) {
                    $emails=Inscription::where([
                        ["annee_id",1],["classe_id",$classe_id[0]]
                        ])
                    ->with("eleve")
                    ->get()
                    ->pluck("eleve.email")
                    ;
                    foreach ($emails as $email) {
                        $message->to($email)->subject("Notification d'événements")
                        ->with("data",$current_event);
                        
                    }

                }
            }
        });

        $this->info('The emails are send successfully!');



    }
}
