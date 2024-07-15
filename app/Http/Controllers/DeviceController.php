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
        $devices = collect();
        
        $dvices = Device::all();
        foreach ($dvices as $device) {
            $dvs = collect(['owner'=>$device->owner->name,
        'id'=>$device->id,
        'mac'=>$device->device_mac,
        'name'=>$device->device_name,
        'status'=>$device->isOn,
        'updated_at'=>($device->updated_at)->diffForHumans()]);
            $devices->push($dvs);
        }
        return response()->json([
            'devices'=>$devices,
            'status' => true,
        ], 200);
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
                    'device_mac' => 'required|string|unique:devices,device_mac',
                    'device_name' => 'required|string',
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            Device::create([
                'user_id'=>Auth()->user()->id,
                'device_mac'=>request('device_mac'),
                'device_name'=>request('device_name'),
                'start'=>request('start'),
                'end'=>request('end'),
                'isOn'=>false
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Device Created Successfully',
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
        $devices = collect();
        $dvices = Device::where('user_id',$id)->get();
        foreach ($dvices as $device) {
            $dvs = collect(['owner'=>$device->owner->name,
        'id'=>$device->id,
        'mac'=>$device->device_mac,
        'name'=>$device->device_name,
        'status'=>$device->isOn,
        'updated_at'=>($device->updated_at)->diffForHumans()]);
            $devices->push($dvs);
        }
        return response()->json([
            'devices'=>$devices,
            'status' => true,
        ], 200);
    }

    public function edit($id)
    {
        $device = Device::findOrFail($id);
        $device->isOn = !($device->isOn);
        $device->update();
        return response()->json([
            'status' => true,
            'message' => 'State updated successfully',
        ], 200);
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
