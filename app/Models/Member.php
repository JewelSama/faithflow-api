<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'parish_id',
        'full_name',
        'gender',
        'phone',
        'email',
        'address',
        'dob',
        'joined_date',
    ];

    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
    
}
