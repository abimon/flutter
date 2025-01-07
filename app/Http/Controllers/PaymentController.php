<?php

namespace App\Http\Controllers;

use App\Models\Pay;
use App\Models\Payment;
use App\Models\Pickup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    function generate_token()
    {
        $consumer_key = 'faduXH8HzaWbjXUEVg9kUZG3RXY7oGjY';
        $consumer_secret = 'vdUGrVv1seP0JuH9BKKTfep7uow=';
        $data = json_encode([
            'consumer_key' => $consumer_key,
            'consumer_secret' => $consumer_secret
        ]);
        $url = 'https://pay.pesapal.com/v3/api/Auth/RequestToken';
        $response = Http::withOptions(['verify' => false])->withBody($data, 'application/json')->withHeaders(['Content-Type : application/json'])->post($url);
        $access_token = json_decode($response);
        return $access_token->token;
    }
    function generate_ipn()
    {
        $data = json_encode([
            'ipn_notification_type' => 'POST',
            'url' => 'https://krapms.apektechinc.com/pay'
        ]);
        $url = 'https://pay.pesapal.com/v3/api/URLSetup/RegisterIPN';
        $response = Http::withOptions(['verify' => false])->withToken($this->generate_token())->withBody($data, 'application/json')->withHeaders(['Content-Type : application/json'])->post($url);
        return json_decode($response)->ipn_id;
    }
    function pay($id, $pickupId)
    {
        $tid = strtoupper(uniqid());
        $user = User::find($id);
        $pay = Payment::where([['pickupId', $pickupId]])->first();
        if (!$pay) {
            $data = json_encode([
                "id" => $tid,
                "currency" => "KES",
                "amount" =>10,
                "description" => "Waste pickup charges",
                "callback_url" => "https://ics.apektechinc.com/api/payments/save",
                "redirect_mode" => "",
                "notification_id" => $this->generate_ipn(),
                "branch" => "Main Store",
                "billing_address" => [
                    "email_address" => $user->email,
                    "phone_number" => $user->contact,
                    "country_code" => "KE",
                    "first_name" => $user->name,
                    "last_name" => $user->name,
                ]
            ]);
            $res = Http::withOptions(['verify' => false])->withToken($this->generate_token())->withBody($data, 'application/json')->withHeaders(['Content-Type : application/json'])->post('https://pay.pesapal.com/v3/api/Transactions/SubmitOrderRequest');
            $response = json_decode($res);
            // return $response->merchant_reference;
            $order_tracking_id = $response->order_tracking_id;
            $merchant_reference = $response->merchant_reference;
            $redirect_url = $response->redirect_url;
            Payment::create([
                'pickupId' => $pickupId,
                'amount' => 10,
                'merchant_reference' => $merchant_reference,
                'tracking_id' => $order_tracking_id,
                'redirect_url' => $redirect_url,
            ]);

            return response()->json([
                'status' => true,
                'url'=>$redirect_url
            ], 200);
        } elseif ($pay->payment_status_description != 'Completed') {
            $redirect_url = $pay->redirect_url;
            return response()->json([
                'status' => true,
                'url'=>$redirect_url
            ], 200);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Payment already processed.',
            ], 200);
        }

    }
    public function index()
    {
        if (Auth::user()->isAdmin) {
            $items = Payment::all();
        } else {
            $items = Payment::where('user_id', Auth::user()->id)->get();
        }
        return view('payments.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        
    }
    public function save()
    {
        $pay = Payment::where([["tracking_id", request('OrderTrackingId')], ['merchant_reference', request('OrderMerchantReference')]])->first();
        $url = 'https://pay.pesapal.com/v3/api/Transactions/GetTransactionStatus?orderTrackingId=' . $pay->tracking_id;
        $res = Http::withToken($this->generate_token())->withHeaders(['Content-Type : application/json'])->get($url);
        $response = json_decode($res);
        if ($response->status == '200') {
            $pay->payment_account = $response->payment_account;
            $pay->amount = $response->amount;
            $pay->payment_method = $response->payment_method;
            $pay->confirmation_code = $response->confirmation_code;
            $pay->payment_status_description = $response->payment_status_description;
            $pay->update();
            Pickup::where('id', $pay->pickupId)->update(['isPaid' => true]);
            return redirect('/payee')->with('success', 'Payment made successfully.');
        }
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
