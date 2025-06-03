<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offering extends Model
{
    protected $fillable = [
        'parish_id',
        'member_id',
        'amount',
        'date',
        'service_type',
    ];
}
