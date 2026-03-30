<?php 
namespace App\View\Components;

use Illuminate\View\Component;

class ConnectButton extends Component
{
    public $loggedinUser;
    public $user;
    public $connections;

    /**
     * Create a new component instance.
     *
     * @param  $loggedinUser  The logged-in user
     * @param  $user  The profile user
     * @param  $connections  The user's connections
     */
    public function __construct($loggedinUser, $user, $connections)
    {
        $this->loggedinUser = $loggedinUser;
        $this->user = $user;
        $this->connections = $connections;
    }

    /**
     * Get the view / contents that represent the component.
     */
     
     public function render()
    {
        // Pass the component instance to the Blade view
        return view('components.connect-button', [
            'component' => $this
        ]);
    }


    /**
     * Determine and return the button HTML based on the logic.
     */
    public function getButtonHtml()
    {
        // Check if logged-in user is set
        if ($this->loggedinUser) {
            // Check if the logged-in user is not the profile user
            if ($_SESSION['email'] !== $this->user->email) {
                $memberID = $this->user->id;

                // Check if connection exists
                if (isset($this->connections[$memberID])) {
                    // If connection is already accepted
                    if ($this->connections[$memberID] === 1) {
                        return ''; // Connection exists, no button or you can add custom logic here
                    } else {
                        // If connection is pending
                        return '<a href="javascript:void(0);" class="btn tj-btn-primary pending-connection">
                                    <i class="fa-regular fa-clock-three small" style="transform: none;"></i> Pending
                                </a>';
                    }
                } else {
                    // If no connection exists, check subscription status
                    if ($this->loggedinUser->subscription_status === 'paid') {
                        
                      if($this->user->subscription_status === 'paid') {
                        return '<a href="javascript:void(0);" class="btn tj-btn-primary connectprofile-btn" data-memberid="' . $this->user->id . '">
                                    <i class="fa fa-plus small" style="transform: none;"></i> Connect
                                </a>
                                <a href="javascript:void(0);" class="btn tj-btn-primary pending-connection" style="display: none;">
                                    <i class="fa-regular fa-clock-three small" style="transform: none;"></i> Pending
                                </a>';
                        }
                    } else {
                        // If user does not have a paid subscription, show the modal to upgrade
                        return '<a href="#paidFeature" class="btn tj-btn-primary" data-bs-toggle="modal">
                                    <i class="fa fa-plus small" style="transform: none;"></i> Connect
                                </a>';
                    }
                }
            }
        } else {
            // If user is not logged in
            return '<a href="#loginModal" class="btn tj-btn-primary" data-bs-toggle="modal">
                        <i class="fa fa-plus small" style="transform: none;"></i> Connect
                    </a>';
        }

        return ''; // Default return if no conditions match
    }
}
