<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingAttendee extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
     // A BookingAttendee belongs to a Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    // A BookingAttendee belongs to a User (for the 'Userid' field)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
