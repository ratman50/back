<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    /**
     * Create a new policy instance.
     */
    
    public function __construct()
    {
        //
    }
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isSimpleUser()) {
            return false;
        }
    
        return null;
    }
    public function create(User $user){
        return true;   
    }
    
    
    public function update(User $user, Event $event){
        return $user->id === $event->user_id || $user->isAdministrator();
    }
    public function delete(User $user, Event $event){
        return $user->id === $event->user_id || $user->isAdministrator();
    }
}
