<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class dataController extends Controller
{
    function register(){
        $rules= [
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|string|min:8'
        ];
        $validator = Validator::make(request()->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $user=User::create([
            'name'=>request()->name,
            'email'=>request()->email,
            'password'=>Hash::make(request()->password),
        ]);
        $token = $user->createToken('Personal Access Token')->plainTextToken;
        $data = [
            'token'=>$token,
            'user'=>$user
        ];
        return response()->json($data,200);
    }
    function login(){
        $rules= [
            'email'=>'required|email',
            'password'=>'required'
        ];
       request()->validate($rules);
       $user=User::where('email', request()->email)->first();
       if($user && Hash::check(request()->password, $user->password)){
            $token = $user->createToken('Personal Access Token')->plainTextToken;
            $data = [
                'token'=>$token,
                'user'=>$user
            ];
            return response()->json($data,200);
       }
       $data=['message'=>'Incorrect email or password'];
       return response()->json($data,400);

    }
}
