<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study_memory extends Model
{
    use HasFactory;
    
// （ここから）追記
    // Controllerのfill用
    protected $fillable = [
        'event_title',
        'event_body',
        'start_date',
        'end_date',
        'event_color',
        'event_border_color',
    ];
// （ここまで）
    
    public function user()
    {
    return $this->belongsTo(user::class);
    }
    
    public function subject()
    {
    return $this->belongsTo(subject::class);
    }
}
