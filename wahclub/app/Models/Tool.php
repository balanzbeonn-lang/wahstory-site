<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tool extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'tool_user', 'tool_id', 'user_id');
    }
    
    protected static function booted()
    {
        static::saving(function ($tool) {
            $tool->slug = Str::slug($tool->tool); // Assuming 'name' is the field you want to create the slug from
        });
    }
    
    
}
