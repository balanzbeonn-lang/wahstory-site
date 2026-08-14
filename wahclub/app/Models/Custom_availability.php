<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custom_availability extends Model
{
    use HasFactory;
    
    protected $table = 'custom_availability';
     
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');  // Assuming you have a User model
    }
}
