<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'parish_id',
        'title',
        'message',
        'is_global',
        'published_at',
    ];
    
}
