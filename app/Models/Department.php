<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'parish_id',
        'name',
    ];


    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class); // if members belong to departments
    }
}
