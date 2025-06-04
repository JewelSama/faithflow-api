<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrayerRequest extends Model
{
    protected $fillable = [
        'parish_id',
        'member_id',
        'request',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
    
    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }
}
