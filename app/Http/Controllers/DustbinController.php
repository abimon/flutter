<?php

namespace App\Http\Controllers;

use App\Models\Dustbin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DustbinController extends Controller
{

    public function index()
    {
        if(Auth::user()->role == 'Admin'){
            $dustbins = Dustbin::join('users', 'users.id', '=', 'dustbins.user_id')->select('dustbins.*', 'users.name',)->get();
        }else{
            $id = Auth()->user()->id;
            $dustbins = Dustbin::where('users.id', $id)->join('users', 'users.id', '=', 'dustbins.user_id')->select('dustbins.*', 'users.name',)->get();
        }
        return response()->json([
            'status' => true,
            'message' => 'Dustbins retrieved successfully',
            'data' => $dustbins
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Dustbin::create([
            "user_id" => Auth::user()->id,
            "dustbin_no" => request('dustbin_no'),
            "level" => request('level'),
            "depth" => request('depth'),
        ]);
        return response()->json([
            'message' => 'Dustbin added successfully'
        ], 200);
    }

    public function show($id)
    {
        $dustbins = Dustbin::join('users', 'users.id', '=', 'dustbins.user_id')->select('dustbins.*', 'users.name',)->get();
        return $dustbins;
    }

    public function edit(Dustbin $dustbin)
    {
        //
    }

    public function update()
    {

        $bin = Dustbin::where('dustbin_no', request('dustbin_no'))->first();
        if(request('level')!=null){$bin->level = ceil(((($bin->depth - request('level')) / $bin->depth) * 100));
        $bin->update();
        if ($bin->level >= 80) {
            $phone = $bin->user->phone;
            $message = "Waste-bin no: " . $bin->dustbin_no . " is full. Please empty it.";
            $this->sendSMS($phone, $message);
        } else if ($bin->level >= 60) {
            $phone = $bin->user->phone;
            $message = "Waste-bin no: " . $bin->dustbin_no . " is almost full. Please check it and schedule its pickup.";
            $this->sendSMS($phone, $message);
        }}

        return response()->json(['message' => "Level updated successfully with " . request('level') . ' from the device.'], 200);
    }

    public function destroy($id)
    {
        if (!Auth::attempt(request()->only(['password']))) {
            return response()->json([
                'status' => false,
                'message' => 'Password does not match with our record.',
            ], 401);
        }else{
            Dustbin::destroy($id);
            return response()->json([
                'message' => 'Dustbin deleted successfully'
            ], 200);
        }
    }
    public function sendSMS($phone, $message)
    {
        $api_key = env('MOBITECH_API_KEY');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.mobitechtechnologies.com/sms/sendsms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                "mobile" => $phone,
                "sender_name" => "FULL_CIRCLE",
                "service_id" => 0,
                "message" => $message
            )),
            CURLOPT_HTTPHEADER => array(
                'h_api_key: ' . $api_key,
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        // curl_close($curl);
        $res = json_decode($response);
        return $res->status_code;
    }
}
