<?php

namespace App\Http\Controllers;

use App\Models\Dustbin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DustbinController extends Controller
{

    public function index()
    {   
        $id=Auth()->user()->id;
        $dustbins = Dustbin::wheere('users.id',$id)->join('users','users.id','=','dustbins.user_id')->select('dustbins.*','users.name',)->get();
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
            "depth"=>request('depth'),
        ]);
        return response()->json([
            'message' => 'Dustbin added successfully'
        ],200);
    }

    public function show($id)
    {
        $dustbins = Dustbin::join('users','users.id','=','dustbins.user_id')->select('dustbins.*','users.name',)->get();
        return $dustbins;
    }

    public function edit(Dustbin $dustbin)
    {
        //
    }

    public function update()
    {
        
        $bin=Dustbin::where('dustbin_no', request('dustbin_no'))->first();
        $bin->level = ceil(((($bin->depth - request('level') )/ $bin->depth) * 100));
        $bin->update();
        return response()->json(['message'=>"Level updated successfully"],200);
    }

    public function destroy(Dustbin $dustbin)
    {
        //
    }
}
