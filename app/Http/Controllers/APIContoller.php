<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class APIContoller extends Controller
{
    public function index()
    {
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        Device::create([
            'user_id'=>request('user_id'),
            'device_mac'=>request('device_mac'),
            'device_name'=>request('device_name'),
            'start'=>request('start'),
            'end'=>request('end'),
            'isOn'=>request('isOn')
        ]);
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
