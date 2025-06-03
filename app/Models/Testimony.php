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
        'is_approved',
    ];
}
