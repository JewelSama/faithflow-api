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
    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
