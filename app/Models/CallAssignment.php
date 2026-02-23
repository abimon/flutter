<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'caller_phone',
        'contact_name',
        'contact_phone',
    ];
}
