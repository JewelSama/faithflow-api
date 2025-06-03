<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
    protected $fillable = [
        'name',
        'location',
        'city',
        'country',
    ];

        // A parish has many users (admins)
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // A parish has many members
    public function members()
    {
        return $this->hasMany(Member::class);
    }

    // A parish has many events
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    // A parish has many donations
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    // A parish has many attendance records
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

}
