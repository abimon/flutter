<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(['user'=>Auth()->user()],200);
    }
    public function create()
    {
        try {
            $validateUser = Validator::make(request()->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt(request()->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', request()->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'user'=>Auth()->user(),
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validateUser = Validator::make(
                request()->all(),
                [
                    'name' => 'required|string|unique:users,name',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:8',
                    'contact' => 'required|min:9',
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name'=>request('name'),
                'contact'=>request('contact'),
                'email'=>request('email'),
                'password'=>request('password'),
                'role'=>'User'
            ]);

            return response()->json([
                'user' => $user,
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => request()->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user,200);
    }
    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    
    {
        $user = User::findOrFail($id);
        
        if (request()->has('name')) {
            $user->name = request()->name;
        }
        if (request()->has('email')) {
            $user->email = request()->email;
        }
        if (request()->has('contact')) {
            $code = request()->code;
            $originalStr = request()->contact;
            $prefix = substr($originalStr, 0, 1);
            $contact = str_replace('0', $code, $prefix) . substr($originalStr, 1);
            $user->contact = $contact;
        }
        if (request()->has('password') && Hash::check(request()->oldpassword, $user->password)) {
            $user->password = Hash::make(request()->password);
        }
        if ((request()->has('role')) && (Auth()->user()->role == 'Admin')) {
            $user->role = request()->role;
        }
        $user->update();
        return response()->json([
            'status' => true,
            'message' => 'User updated Successfully',
        ], 200);
    }

    public function destroy($id)
    {
        //
    }
}
