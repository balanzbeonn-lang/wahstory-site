<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
