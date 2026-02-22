<?php

namespace App\Http\Controllers;

use App\Models\Pickup;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PickupController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'Admin') {
            $picks = Pickup::orderBy('pickups.created_at', 'desc')->join('dustbins', 'dustbins.id', 'pickups.dustbin_id')->join('users', 'users.id', '=', 'dustbins.user_id')->select('dustbins.*', 'users.name', 'pickups.date', 'pickups.location', 'pickups.isPaid','pickups.tracking_id as tID')->get();
        } else {
            $id = Auth()->user()->id;
            $picks = Pickup::orderBy('pickups.created_at', 'desc')->where('users.id', $id)->join('dustbins', 'dustbins.id', 'pickups.dustbin_id')->join('users', 'users.id', '=', 'dustbins.user_id')->select('dustbins.*', 'users.name', 'pickups.date', 'pickups.location', 'pickups.isPaid','pickups.tracking_id as tID')->get();
        }
        return response()->json([
            'status' => true,
            'message' => 'Pick-ups retrieved successfully',
            'data' => $picks
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store()
    {
        try {
            $validateVal = Validator::make(
                request()->all(),
                [
                    'dustbin_id' => 'required',
                    'date' => 'required',
                    'time' => 'required',
                    'location' => 'required',
                ]
            );

            if ($validateVal->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateVal->errors()
                ], 401);
            }

            if (!Pickup::where([['dustbin_id', request('dustbin_id')], ['isPicked', false]])->first()) {
                Pickup::create([
                    'dustbin_id' => request('dustbin_id'),
                    'tracking_id' => strtoupper(uniqid()),
                    'date' => request('date'),
                    'time' => request('time'),
                    'location' => request('location'),
                    'isPin' => request('isPin'),
                    'isPaid' => false,
                    'isPicked' => false
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Pick-up scheduled successfully',
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Pick-up already scheduled for this dustbin',
                ], 401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $picks = Pickup::join('dustbins', 'dustbins.id', 'pickups.dustbin_id')->join('users', 'users.id', '=', 'dustbins.user_id')->select('dustbins.*', 'users.name', 'pickups.date', 'pickups.location', 'users.id as uid')->get();
        return $picks->where('uid', $id);
    }

    public function edit(Pickup $pickup)
    {
        //
    }
    public function update(Request $request, Pickup $pickup)
    {
        $pickup = Pickup::where('tracking_id', request('tracking_id'))->first();
        if ($pickup) {
            if(request('isPicked')!=null){
                $pickup->isPicked = request('isPicked');
            }
            $pickup->update();
            return response()->json([
                'status' => true,
                'message' => 'Pick-up updated successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Pick-up not found',
            ], 401);
        }
    }

    public function destroy(Pickup $pickup)
    {
        //
    }
}
