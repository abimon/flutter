<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class APIContoller extends Controller
{
    public function index()
    {
        Log::channel("teltonika")->info(json_encode([request('sensor'),request('value1'),request('value2'),request('value3'),request('api_key')]));
        return response()->json('success',200);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
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
