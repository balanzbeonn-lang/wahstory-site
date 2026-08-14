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
            ->limit(10)
            ->get(); 
            
            if ($users->isEmpty()) {
                return view('mainpage')->with('message', 'No Users Found'); 
            }
            
             $loggedinUser = null;
                if (!empty($_SESSION['email'])) {  // Check if the email session exists
                    $email = $_SESSION['email'];
                    $loggedinUser = User::where('email', $email)->first();
                }
            
    
            return view('mainpage', compact('users', 'loggedinUser'));
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
    
            return view('singleskill', [
                'users' => $users,
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
      
        /*$users = User::all();
        return view('search-results', compact('users'));*/
        
        
        
         $chunkSize = 8; // Number of users to load at once

        // Get the offset from the request
        $offset = $request->input('offset', 0);
        
        // Fetch users based on the offset
        $users = User::skip($offset)->take($chunkSize)->get(); 
        
        // Check if the request is an AJAX request
        if ($request->ajax()) {
            // Make sure to pass the users variable to the partial view
            return view('partials.user-list', compact('users'));
        }
        
        // For the initial page load
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
    
    
    public function checkconnections(Request $request, $userId, $memberId) 
    {
        
            // Check if users are already connected
        $connection = Connection::where(function ($query) use ($userId, $memberId) {
            $query->where('user_id_1', $userId)
                ->where('user_id_2', $memberId);
        })
        ->orWhere(function ($query) use ($userId, $memberId) {
            $query->where('user_id_1', $memberId)
                ->where('user_id_2', $userId);
        }) 
        ->first();
 
        // If a connection already exists,  return a message or perform an update
        /*if ($Connection) {
            return view('mainpage', compact('Connection'));
        }*/
        
        return response()->json(['connection' => $connection]);
        
    
    }
    
    public function connectwithclubMember(Request $request)
    {
      try {
          
        $memberId = $request->input('memberid');
        $userId = $request->input('userid');
        
        // Check if the logged-in user exists
        $loggedInUser = User::find($userId);
        
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
        $reverseConnection = new Connection();
        $reverseConnection->user_id_1 = $memberId;
        $reverseConnection->user_id_2 = $userId;
        $reverseConnection->status = 0; // Pending status
        $reverseConnection->save();
 
        
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
