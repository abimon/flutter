<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dustbin extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'dustbin_no',
        'level',
    ];
}
