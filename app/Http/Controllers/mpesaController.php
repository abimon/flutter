<?php

namespace App\Http\Controllers;

use App\Models\Mpesa;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class mpesaController extends Controller
{
    function generate_token(){
        
        $consumer_key=env('MPESA_CONSUMER_KEY');
        $consumer_secret=env('MPESA_CONSUMER_SECRET');
        $credentials = base64_encode($consumer_key.":".$consumer_secret);
        $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials));
        curl_setopt($curl, CURLOPT_HEADER,false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $access_token=json_decode($curl_response);
        return $access_token->access_token;

    }
    public function lipaNaMpesaPassword()
    {
        $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        $BusinessShortCode = 174379;
        $timestamp =date('YmdHis');
        $lipa_na_mpesa_password = base64_encode($BusinessShortCode.$passkey.$timestamp);
        return $lipa_na_mpesa_password;
    }
    function stkpush(){
        $collection = collect();
        $sum=request()->amount;
        $serial = 'AK' . date('dmYHis');
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generate_token()));
        $curl_post_data = [
            //Fill in the request parameters with valid values
            'BusinessShortCode' => 174379,
            'Password' => $this->lipaNaMpesaPassword(),
            'Timestamp' => date('YmdHis'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $sum,
            'PartyA' => request()->phone, // replace this with your phone number
            'PartyB' => 174379,
            'PhoneNumber' => request()->phone, // replace this with your phone number
            'CallBackURL' => 'https://treasury.ausaakenya.com/api/v1/callback/'.$serial,
            'AccountReference' =>'Trial',
            'TransactionDesc' =>$serial
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        $res=json_decode($curl_response);
        if($res->ResponseCode==0){
            return response()->json('success',200);
        }
        else{
            echo 'An error was found. Please try again';
        }
    }
    
    public function Callback($serial)
    {
        $content=json_decode(request()->getContent());
        if($content->ResultCode==0){
            Mpesa::create([
                'TransactionType'=>'Paybill',
                'Receipt'=>$serial,
                'MpesaReceiptNumber'=>$content->MpesaReceiptNumber,
                'TransactionDate'=>$content->TransactionDate,
                'TransAmount'=>$content->TransAmount,
                'PhoneNumber'=>$content->PhoneNumber,
                'response'=>$content
            ]);
            
        }
        
        // Responding to the confirmation request
        $response = new Response();
        $response->headers->set("Content-Type","text/xml; charset=utf-8");
        $response->setContent(json_encode(["C2BPaymentConfirmationResult"=>"Success"]));
        return $response;
    }
}
