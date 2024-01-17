<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('email', request()->email)->first();
        if ($user && Hash::check(request()->password, $user->password)) {
            return response()->json($user, 200);
        }
        return response()->json('Wrong email or password. Please try again', 400);
    }

    public function create()
    {
        $phone = request()->contact;
        $code = '+254';
        $first = substr($phone, 0, 1);
        if ($first == '0') {
            $contact = substr_replace($phone, $code, 0, 1);
        } else {
            $contact = $code . $phone;
        }
        $user = User::create([
            'name' => request()->name,
            'email' => request()->email,
            'contact' => $contact,
            'avatar' => 'user.png',
            'role'=> 'Client',
            'password' => Hash::make(request()->password),
        ]);
        return response()->json($user,200);
    }

    public function store($id)
    {
        $extension=request()->file('avatar')->getClientOriginalExtension();
        $filenametostore='user_'.time().'.'.$extension;   
        $path=request()->file('avatar')->storeAs('public/profile_images', $filenametostore);
        User::where('id',$id)->update(['avatar'=>$filenametostore]);
        return response()->json($path,200);

    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
