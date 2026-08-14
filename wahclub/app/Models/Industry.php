<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use HasFactory;
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'industry_user', 'industry_id', 'user_id');
    }
}
