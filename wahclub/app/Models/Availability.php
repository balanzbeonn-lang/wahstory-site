<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;
    
    protected $table = 'availability';
     
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');  // Assuming you have a User model
    }
}
