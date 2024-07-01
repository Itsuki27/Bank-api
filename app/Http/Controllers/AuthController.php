<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class AuthController extends Controller
{
    public function login(Request $r){
        $validator = Validator::make($r->all(),[
            'username' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return $this->BadRequest($validator);
        }

        if(!auth()->attempt($validator->validated())){
            return $this->Unauthorized("Incorrect username and/or password");
        }

        $user = auth()->user();
        $token = $user->createToken("api-login")->accessToken;
        $user->token = $token;
        return $this->Ok($user,"Login Success!");
    }


    public function checkToken(Request $r){
        $user = $r->user();
        return $this->Ok($user,"User has been retrieved!");
    }

    public function revokeToken(Request $r){
        $r->user()->token()->revoke();
        return $this->Ok([],"Token has been revoked!");
    }

}
