<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    protected $fillable = [
        'parish_id',
        'member_id',
        'content',
        'date',  // date testimony was shared or recorded
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }
}
