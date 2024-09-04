<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public function study_memories()   
    {
    return $this->hasMany(study_meomory::class);  
    }
    

}
