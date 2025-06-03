<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrayerRequest extends Model
{
    protected $fillable = [
        'parish_id',
        'member_id',
        'request',
        'is_approved',
    ];
}
