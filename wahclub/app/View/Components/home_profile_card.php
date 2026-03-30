<?php
namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Connection;
use App\Models\User;

class home_profile_card extends Component
{
    public $loggedinUser;
    public $user;
    public $connections;
        /**
     * Create a new component instance.
     */
    public function __construct($loggedinUser, $user, $connections)
    {
        $this->loggedinUser = $loggedinUser;
        $this->user = $user;
        $this->connections = $connections;
    }

     public function render()
    {
        // Pass the component instance to the Blade view
        return view('components.home_profile_card', [
            'component' => $this
        ]);
    }
}
