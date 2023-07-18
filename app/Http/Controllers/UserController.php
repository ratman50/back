<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserRessource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserRessource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user=User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "user_name"=>$request->user_name,
            "password"=>$request->password,
            "role_id"=>$request->role
        ]);
        return new UserRessource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserRessource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->only("nomComplet", "email", "password", "role"));
        return new UserRessource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize("delete",User::class);
        $user->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
    public function getEventByUser(User $user){
        return $user->events;
    }
}
