<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Connection;

class UserProfileCard extends Component
{
    public $user;
    public $loggedinUser;
    public $connections;
    public $myconnections;
    
    
    public function __construct($user, $loggedinUser, $connections)
    {
        $this->user = $user;
        $this->loggedinUser = $loggedinUser;
        $this->connections = $connections;
        
        $this->myconnections = Connection::where(function ($query) use ($user) {
            $query->where('user_id_1', $user->id)
                  ->orWhere('user_id_2', $user->id);
        })->get();
    }
 
    // public function render(): View|Closure|string
    
    public function render()
    {
        return view('components.user-profile-card');
    }
}
