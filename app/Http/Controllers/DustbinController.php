<?php

namespace App\Http\Controllers;

use App\Models\Dustbin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DustbinController extends Controller
{

    public function index()
    {
        $dustbins = Dustbin::join('users','users.id','=','dustbins.user_id')->select('dustbins.*','users.name')->get();
        return $dustbins;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Dustbin::create([
            "user_id"=>request('user_id'),
            "dustbin_no"=>request('dustbin_no'),
            "level"=>request('level'),
        ]);
        return response()->json([
            'message' => 'Dustbin added successfully'
        ],200);
    }

    public function show($id)
    {
        $dustbins = Dustbin::where('user_id', $id)->get();
        return $dustbins;
    }

    public function edit(Dustbin $dustbin)
    {
        //
    }

    public function update($dustbin_no,$level)
    {
        Dustbin::where('dustbin_no', $dustbin_no)->update([
            'level' => $level
        ]);
        return response()->json(['message'=>"Level updated successfully"],200);
    }

    public function destroy(Dustbin $dustbin)
    {
        //
    }
}
