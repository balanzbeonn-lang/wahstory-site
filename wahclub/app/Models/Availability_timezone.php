<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability_timezone extends Model
{
    use HasFactory;
    
    // Specify the table if it doesn't follow Laravel's naming convention
    protected $table = 'avalability_timezone';

    // If you don't want timestamps, you can disable them
    public $timestamps = false;
    
    // Define relationships if needed
     public function timezone()
     {
         return $this->belongsTo(Timezone::class, 'timezone_id');
     }
 
     public function user()
     {
         return $this->belongsTo(User::class, 'user_id');
     }
     
}
