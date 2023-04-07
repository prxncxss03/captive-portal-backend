<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserAuthController extends Controller
{
    //
    public function register(Request $request){
        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'user_type' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);
        $token = $user->createToken('auth_token')->accessToken;
        return response(['user' => $user, 'access_token' => $token], 201);



    }

    public function login(Request $request){
        $data = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $isApproved = User::where('email', $request->email)->first()->is_approved;
        if(!$isApproved){
            return response(['message' => 'Account is pending for admin approval'], 401);
        }

        if(!auth()->attempt($data)){
            return response(['message' => 'Invalid Credentials'], 401);
        }

        $token = auth()->user()->createToken('auth_token')->accessToken;
        //return json response
        return response(['user' => auth()->user(), 'access_token' => $token], 200);
    }
}
