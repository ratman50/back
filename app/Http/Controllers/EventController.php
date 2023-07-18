<?php

namespace App\Http\Controllers;

use App\Http\Resources\EleveResource;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function store(Request $request){
        // dd($request->user());
        
        $credentials=$request->validate(
            [
                "description"=>["required","string"],
                "libelle"=>["required","string"],
                // "user"=>["required","integer","exists:App\Models\User,id"],
                "date"=>["required","date"]
            ]
            );
        $this->authorize('create', Event::class);
            
        // $event=Event::create([
        //     "libelle"=>$request->libelle,
        //     "description"=>$request->description,
        //     "date_event"=>$request->date,
        //     "user_id"=>$request->user
        // ]);
        $event=Event::create([
            "libelle"=>$request->libelle,
            "description"=>$request->description,
            "date_event"=>$request->date,
            "user_id"=>$request->user()->id
        ]);
        return new EventResource($event);
    }
    public function update(Request $request, Event $event){

    }
    public function show(Event $event){
        dd($event);
    }
}
