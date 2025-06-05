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
        'department_id'
    ];

    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function prayerRequests()
    {
        return $this->hasMany(PrayerRequest::class);
    }
    
    public function testimonies()
    {
        return $this->hasMany(Testimony::class);
    }

    public function offerings()
    {
        return $this->hasMany(Offering::class);
    }
    public function tithes()
    {
        return $this->hasMany(Tithe::class);
    }
    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
    
}
