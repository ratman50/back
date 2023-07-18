<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
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
        if ($user->matched("Administrator")|| $user->matched("surveillant")) {
            return true;
        }
        return null;
    }
    public function delete(User $user){
        if ($user->matched("Administrator")|| $user->matched("surveillant")) {
            return true;
        }
    
        return false;  
    }
}
