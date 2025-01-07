<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'pickupId',
        'merchant_reference',
        'payment_account',
        'tracking_id',
        'amount',
        'payment_method',
        'confirmation_code',
        'payment_status_description',
        'redirect_url'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
