<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class User extends Model
{
    use HasFactory;
    use Searchable;

    protected $guarded = [];
    

    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($user) {
            $user->slug_username = User::createUniqueSlug($user->firstname, $user->lastname);
        });
        
        static::saved(function ($user) {
            $user->load([
                'skills', 'experiences', 'tools', 'educations', 'stories'
            ]);
            $user->searchable();
        });
    }
    
    
    public static function createUniqueSlug($firstName, $lastName)
    {
        $slug = Str::slug($firstName . '-' . $lastName);
        $originalSlug = $slug;
        $count = 1;
    
        while (static::whereSlugUsername($slug)->exists()) {  // Corrected method name
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
    
        return $slug;
    }
    
    
    public function toSearchableArray()
    {
        return [
            'name' => $this->firstname . ' ' . $this->lastname,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'skills' => $this->skills->pluck('skill')->toArray(),
            'experiences' => $this->experiences->pluck('company_name')->toArray(),
            'roles' => $this->experiences->pluck('role')->toArray(),
            'tools' => $this->tools->pluck('name')->toArray(),
            'educations' => $this->educations->pluck('degree')->toArray(),
            'story_title' => optional($this->stories)->title,
        ];
    }



    public function sociallinks(){
        return $this->hasMany(Sociallink::class);
    }

    public function stories(){
        return $this->hasOne(Story::class);
    }
    
    public function industries()
    {
        return $this->belongsToMany(Industry::class, 'industry_user', 'user_id', 'industry_id');
    }
    
    public function hobbies()
    {
        return $this->belongsToMany(hobby::class, 'hobby_user', 'user_id', 'hobby_id');
    }
    
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'skill_user', 'user_id', 'skill_id');
    }

    public function tools()
    {
        return $this->belongsToMany(Tool::class, 'tool_user', 'user_id', 'tool_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function lets_work_queries()
    {
        return $this->hasMany(LetsWorkQuery::class);
    }
    
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
    public function educations()
    {
        return $this->hasMany(Education::class);
    }
    public function awards()
    {
        return $this->hasMany(Award::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
    
    public function connections()
    {
        return $this->belongsToMany(User::class, 'connections', 'user_id_1', 'user_id_2');
    }
    
    public function timezones()
    {
        return $this->belongsTo(Timezone::class);
    }
    
    public function availabilities()
    {
        return $this->hasMany(Availability::class, 'user_id');
    }
    
    public function customavailabilities()
    {
        return $this->hasMany(Custom_availability::class, 'user_id');
    }
    
    //Bookings ########################
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    public function memberBookings()
    {
        return $this->hasMany(Booking::class, 'member_id');
    }

    public function bookingAttendees()
    {
        return $this->hasMany(BookingAttendee::class, 'user_id');
    }
    //Bookings ########################

     

}
