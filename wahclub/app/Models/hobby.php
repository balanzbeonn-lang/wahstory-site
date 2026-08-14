<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hobby extends Model
{
    use HasFactory;
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'hobby_user', 'hobby_id', 'user_id');
    }
}
