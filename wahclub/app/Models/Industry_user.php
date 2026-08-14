<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry_user extends Model
{
    use HasFactory;

    // Specify the table if it doesn't follow Laravel's naming convention
    protected $table = 'industry_user';

    // If you don't want timestamps, you can disable them
    public $timestamps = false;

     // Define relationships if needed
     public function industry()
     {
         return $this->belongsTo(Industry::class, 'industry_id');
     }
 
     public function user()
     {
         return $this->belongsTo(User::class, 'user_id');
     }
}
