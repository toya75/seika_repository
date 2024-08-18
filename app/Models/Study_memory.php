<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study_memory extends Model
{
    use HasFactory;
    
    public function user()
    {
    return $this->belongsTo(user::class);
    }
    
    public function subject()
    {
    return $this->belongsTo(subject::class);
    }
}
