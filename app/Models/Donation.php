<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'parish_id',
        'member_id',
        'amount',
        'category', 
        'donation_date',
        'mode',
    ];

    // A donation belongs to a parish
    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }

    // A donation may belong to a member (nullable)
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    
}
