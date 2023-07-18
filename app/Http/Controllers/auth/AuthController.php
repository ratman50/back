<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request){
        $credentials=$request->validate([
            "user_name"=>["required","string"],
            "password"=>["required","string"]
        ]);
        if(Auth::attempt($credentials))
        {
            $token=$request->user()->createToken("login_token");
            return ["token"=>$token->plainTextToken];
        }
        return response(["message"=>"UNAUTHORIZED"],Response::HTTP_NOT_ACCEPTABLE);
    }
}
