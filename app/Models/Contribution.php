<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'contributor_name',
        'phone',
        'amount',
        'payment_method',
        'payment_status',
        'description',
        'status',
        'added_by',
    ];

    /**
     * Treasurer user who recorded the contribution.
     */
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
