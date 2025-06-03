<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'parish_id',
        'title',
        'description',
        'event_date',
        'time',
        'venue',
    ];
    
    // An event belongs to a parish
    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }

}
