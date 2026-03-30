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

use App\Http\Controllers\MainController;

class ToolController extends Controller
{
    
    protected $MainController;
    
    public function __construct(MainController $MainController) {
        
         $this->MainController = $MainController;
    }
    
    public function getUsersRandomly($limit)
    {
        $chunkSize = 8;
        return User::with(['stories', 'sociallinks', 'skills', 'tools', 'attributes', 'projects', 'experiences', 'educations', 'awards', 'testimonials', 'blogs'])
            ->has('stories')
            ->has('sociallinks')
            ->has('skills')
            ->has('tools')
            ->has('attributes') 
            ->has('experiences')
            ->has('educations') 
            ->inRandomOrder()
            ->paginate($chunkSize);
    }
    
    public function getAllUsers($chunkSize)
    {
        return User::with(['stories', 'sociallinks', 'skills', 'tools', 'attributes', 'projects', 'experiences', 'educations', 'awards', 'testimonials', 'blogs'])
            ->has('stories')
            ->has('sociallinks')
            ->has('skills')
            ->has('tools')
            ->has('attributes') 
            ->has('experiences')
            ->has('educations')
            ->paginate($chunkSize);
    }
    
    
    public function getMemberBySlug($slug) {
        $chunkSize = 8;
    
        return User::with([
                'stories', 'sociallinks', 'skills', 'tools', 'attributes',
                'projects', 'experiences', 'educations', 'awards', 'testimonials', 'blogs'
            ])
            ->whereHas('tools', function ($query) use ($slug) {
                $query->where('tools.slug', $slug);
            })
            ->has('stories')
            ->has('sociallinks')
            ->has('skills')
            ->has('tools')
            ->has('attributes')
            ->has('experiences')
            ->has('educations')
            ->paginate($chunkSize);
    }
    
    public function getMembersByTool($slug, Request $request)
    {
        try {
            // Ensure session is started, but ideally, Laravel manages sessions
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
    
            // Fetch users by tool slug
            $users = $this->getMemberBySlug($slug);
    
            // If no users, fetch random users
            // $randomUsers = null;
            // if ($users->isEmpty()) {
            //     $users = $this->getUsersRandomly(12);
            //     $randomUsers = 1;
            // }
    
            // Get the current tool and all available tools
            $currenttool = Tool::where('slug', $slug)->firstOrFail();
            $tools = Tool::all();
    
            // Get logged-in user from session if available
            $loggedinUser = null;
            if (!empty($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $loggedinUser = User::where('email', $email)->first();
            }
    
            // Get user connections
            $connections = $this->MainController->getConnections($loggedinUser, $users);
    
            // Handle AJAX request for pagination
            if ($request->ajax()) {
                return response()->json([
                    'view' => view('partials.user-list', compact('currenttool', 'tools', 'users', 'loggedinUser', 'connections'))->render(),
                    'next_page' => $users->nextPageUrl(),
                    'current_page' => $users->currentPage(),
                    'last_page' => $users->lastPage(),
                ]);
            }
            
            $ExploreTools = Tool::withCount('users')
                             ->having('users_count', '>', 4)  // Filters tools that have at least one user
                             ->inRandomOrder()  // Randomize the order
                             ->take(6)  // Limit to 6 tools
                             ->get();
            
            // Return the full view for the tool page
            return view('singletool', [
                'users' => $users,
                'loggedinUser' => $loggedinUser,
                'connections' => $connections,
                'tools' => $tools,
                'currenttool' => $currenttool,
                'ExploreTools' => $ExploreTools,
                'message' => $users->isEmpty() ? 'No Users Found' : null,
            ]);
    
        } catch (\Exception $e) {
            // Log error for debugging purposes
            // \Log::error('Error fetching users by tool: ' . $e->getMessage());
    
            // Return view with empty users collection
            return view('singletool')->with(['users' => collect()]);
        }
    }

    
}
