<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    // A Booking belongs to a User (for the 'Userid' field)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // A Booking belongs to a Member (for the 'Memberid' field)
    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    // A Booking has many attendees (via 'BookingAttendees' table)
    public function attendees()
    {
        return $this->hasMany(BookingAttendee::class, 'booking_id');
    }
    
}
