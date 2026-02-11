<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    use HasFactory;
    protected $fillable = [
        "dustbin_id",
        "tracking_id",
        "date",
        "time",
        "location",
        "isPaid"
    ];
    public function bin(){
        return $this->belongsTo(Dustbin::class);
    }
}
