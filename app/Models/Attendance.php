<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'parish_id',
        'date',
        'service_type',
        'adults',
        'children',
        'men',
        'women',
        'total',
    ];

    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }

}
