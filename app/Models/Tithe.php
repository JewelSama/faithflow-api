<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tithe extends Model
{
    protected $fillable = [
        'parish_id',
        'member_id',
        'amount',
        'month_year',  // format: "YYYY-MM"
    ];
}
