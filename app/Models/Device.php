<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'device_mac',
        'device_name',
        'start',
        'end',
        'isOn'
    ];
    public function owner(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
