<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }

    public function store()
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

            $device=Device::create([
                'user_id'=>Auth()->user()->id,
                'device_mac'=>request('device_mac'),
                'device_name'=>request('device_name'),
                'start'=>request('start'),
                'end'=>request('end'),
                'isOn'=>request('isOn')
            ]);

            return response()->json([
                'device' => $device,
                'status' => true,
                'message' => 'Device Created Successfully',
                'token' => request()->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
        
    }

    public function show()
    {
        //
    }

    public function edit()
    {
        //
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }
}
