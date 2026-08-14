<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sociallink;
use App\Models\Project;
use App\Models\Industry_user;
use App\Models\Industry;
use App\Models\Skill_user;
use App\Models\Skill;
use App\Models\Tool_user;
use App\Models\Tool;
use App\Models\Attribute;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Award;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\Story;
use App\Models\Connection;
use App\Models\Notification;

use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class MainController extends Controller
{
    
    
    public function MainPageData()
    {
        try {
            
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            $users = User::with(['stories', 'sociallinks', 'skills', 'tools', 'attributes', 'projects', 'experiences', 'educations', 'awards', 'testimonials', 'blogs'])
            ->has('stories')
            ->has('sociallinks')
            ->has('skills')
            ->has('tools')
            ->has('attributes') 
            ->has('experiences')
            ->has('educations') 
            ->limit(40)
            ->get(); 
            
            if ($users->isEmpty()) {
                return view('mainpage')->with('message', 'No Users Found'); 
            }
            
             $loggedinUser = null;
             $connections = [];
             
                if (!empty($_SESSION['email'])) {  // Check if the email session exists
                    $email = $_SESSION['email'];
                    $loggedinUser = User::where('email', $email)->first();
                }
                
                
        if ($loggedinUser) {
            foreach ( $users as $member) {
                
                $userId = $loggedinUser->id;
                $memberId = $member->id;
                
                $connection = Connection::where(function ($query) use ($userId, $memberId) {
                    $query->where('user_id_1', $userId)
                        ->where('user_id_2', $memberId);
                })
                ->orWhere(function ($query) use ($userId, $memberId) {
                    $query->where('user_id_1', $memberId)
                        ->where('user_id_2', $userId);
                }) 
                ->first();
                
                
                $connections[$memberId] = $connection ? $connection->status : null;
                
            }    
        }
        
        
        // #################################################=>
            //Getting All Users For Single Category
        // #################################################=>
        
        $keywords = ['Professional Service', 'Industry experts', 'Career professional', 'Business', 'Skilled professional', 'Professional development', 'Experienced professional', 'consultant', 'Corporate', 'Leadership', 'Qualified', 'Professional networks', 'Professional growth', 'Professional certifications', 'Job professional', 'Freelance', 'Certified experts', 'Professional advice', 'High-level professional', 'Executive professional', 'Legal', 'Financial', 'Medical', 'Marketing', 'IT'];

        if ($keywords) {
            
             $ProfessionalCatUsers = User::with([
            'stories', 'sociallinks', 'skills', 'tools', 'attributes', 
            'projects', 'experiences', 'educations', 'awards', 
            'testimonials', 'blogs'
        ])
        ->has('stories')
        ->has('sociallinks')
        ->has('skills')
        ->has('tools')
        ->has('attributes')
        ->has('experiences')
        ->has('educations')
        ->where(function ($query) use ($keywords) {
            // Loop through the keywords and add a condition for each
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('skills', function ($query) use ($keyword) {
                          $query->where('skill', 'like', '%' . $keyword . '%');
                      });
            }
        })
        ->get();
                 
               
        } else {
            
            $ProfessionalCatUsers = User::take(10)->get();
        }
                return view('mainpage', compact('users', 'loggedinUser', 'connections', 'ProfessionalCatUsers'));
            
        } catch (\Exception $e) {
            // Handle any potential errors (optional)
            return view('mainpage')->with('error', 'An error occurred while fetching users.');
        }
    }
    
    
    public function GetConnectionsByUserid($userID)
    {   
      
        try {
     
               $myconnections = Connection::where(function ($query) use ($userID) {
                $query->where('user_id_1', $userID)
                      ->orWhere(function($query) use ($userID) {
                          $query->where('user_id_2', $userID);
                      });
            })->get();
    
            return view('mainpage', compact('myconnections'));
            
        } catch (\Exception $e) {
            // Handle any potential errors (optional)
            return view('mainpage')->with('error', 'An error occurred while fetching users.');
        }
        
    }
    
    public function getUsersbySkillId($skillId)
    {   
      
        try {
            
            
            
            $users = User::with(['stories', 'sociallinks', 'skills', 'tools', 'attributes', 'projects', 'experiences', 'educations', 'awards', 'testimonials', 'blogs'])
                ->whereHas('skills', function ($query) use ($skillId) {
                    $query->where('skills.id', $skillId);
                })
                ->limit(10)
                ->get(); 
                
            $allskills = Skill::all(); 
            
            return view('singleskill', [
                'users' => $users,
                'allskills' => $allskills,
                'message' => $users->isEmpty() ? 'No Users Found' : null,
            ]);
        } catch (\Exception $e) {
            // Log the error for debugging
            // \Log::error('Error fetching users by skill: ' . $e->getMessage());
            
            return view('singleskill')->with('error', 'An error occurred while fetching users.')->with('users', collect()); // Pass an empty collection for users
        }
    }
    
    
    
    public function getAllUsers(Request $request)
    {   
      
        if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        
         $chunkSize = 8;  
         
        $offset = $request->input('offset', 0);
        
        $users = User::with([
            'stories', 'sociallinks', 'skills', 'tools', 'attributes',
            'projects', 'experiences', 'educations', 'awards', 'testimonials', 'blogs'
        ])
        ->has('stories')
        ->has('sociallinks')
        ->has('skills')
        ->has('tools')
        ->has('attributes') 
        ->has('experiences')
        ->has('educations')
        ->skip($offset)
        ->take($chunkSize)
        ->get();
            
        // $users = User::skip($offset)->take($chunkSize)->get(); 
        
         $loggedinUser = null;
             $connections = [];
             
                if (!empty($_SESSION['email'])) {  // Check if the email session exists
                    $email = $_SESSION['email'];
                    $loggedinUser = User::where('email', $email)->first();
                }
                
                
        if ($loggedinUser) {
            foreach ( $users as $member) {
                
                $userId = $loggedinUser->id;
                $memberId = $member->id;
                
                $connection = Connection::where(function ($query) use ($userId, $memberId) {
                    $query->where('user_id_1', $userId)
                        ->where('user_id_2', $memberId);
                })
                ->orWhere(function ($query) use ($userId, $memberId) {
                    $query->where('user_id_1', $memberId)
                        ->where('user_id_2', $userId);
                }) 
                ->first();
                
                $connections[$memberId] = $connection ? $connection->status : null;
            }    
        }
        
        if ($request->ajax()) {
            return view('partials.user-list', compact('users', 'loggedinUser', 'connections'));
        }
        
        return view('showallusers', [
            'users' => $users,
            'offset' => $offset + $chunkSize,
        ]);
        
    }
    
    
    public function getUserswithSearch(Request $request)
    {   
        $searchTerm = $request->input('search');

        if ($searchTerm) {
            // If a search term is provided, filter users by their name
             $users = User::where('firstname', 'like', '%' . $searchTerm . '%')
                     ->orWhere('lastname', 'like', '%' . $searchTerm . '%')->get();
        } else {
            // If no search term is provided, retrieve all users
            $users = User::take(10)->get();
        }
    
        return view('search-results', compact('users'));
        
    }
    
    public function getProfessionalCategoryUsers(Request $request)
    {   
        // $searchTerm = $request->input('search');
        
        $keywords = ['Sharma', 'Kumar'];

        if ($keywords) {
            
             $ProfessionalCatUsers = User::where(function ($query) use ($keywords) {
                 
                 foreach ($keywords as $keyword) {
                        $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                              ->orWhere('lastname', 'like', '%' . $keyword . '%');
                    }
                    
             })->get();
                 
               
        } else {
            // If no search term is provided, retrieve all users
            $ProfessionalCatUsers = User::take(10)->get();
        }
    
        return view('search-results', compact('ProfessionalCatUsers'));
        
    }
    
     
    
    public function connectwithclubMember(Request $request)
    {
      try {
          
        $memberId = $request->input('memberid');
        $useremail = $request->input('useremail');
        
        // Check if the logged-in user exists
        
        $loggedInUser = User::where('email', $useremail)->first();
         $userId = $loggedInUser->id;
        
        $targetUser = User::find($memberId);

        if (!$loggedInUser || !$targetUser) {
            
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.'
            ]);
        }

        // Check if users are already connected
        $existingConnection = Connection::where(function ($query) use ($userId, $memberId) {
            $query->where('user_id_1', $userId)
                ->where('user_id_2', $memberId);
        })
        ->orWhere(function ($query) use ($userId, $memberId) {
            $query->where('user_id_1', $memberId)
                ->where('user_id_2', $userId);
        })
        ->first();

        // If a connection already exists, return a message or perform an update
        if ($existingConnection) {
            // return redirect()->back()->with('error', 'You are already connected with this user.');
            return response()->json([
                'status' => 'error',
                'message' => 'You are already connected with this user.'
            ]);
        }

        // Create a new connection with a default status (e.g., 0 - pending)
        $connection = new Connection();
        $connection->user_id_1 = $userId;
        $connection->user_id_2 = $memberId;
        $connection->status = 0; // Pending status, you can change it as needed
        $connection->save();

        // Optionally, create the reverse connection (user_id_1 <-> user_id_2) with the same status
        // $reverseConnection = new Connection();
        // $reverseConnection->user_id_1 = $memberId;
        // $reverseConnection->user_id_2 = $userId;
        // $reverseConnection->status = 0; 
        // $reverseConnection->save();
        
        
        $Notification = new Notification();
        $Notification->sender_id = $userId;
        $Notification->receiver_id = $memberId;
        $Notification->notification = "You have a new connection";
        $Notification->isread = 0; // Pending status
        $Notification->link = 'user.clubconnections.php'; // Pending status
        $Notification->save();
 
          return response()->json([
                'status' => 'success',
                'message' => 'Connection successful.'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
        
    }




     
    
}
