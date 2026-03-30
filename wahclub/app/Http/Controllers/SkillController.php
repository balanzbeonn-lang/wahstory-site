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

class SkillController extends Controller
{
    
    protected $MainController;
    
    public function __construct(MainController $MainController) {
        
         $this->MainController = $MainController;
    }
    
    public function getUsersRandomly($limit)
    {
        return User::with(['stories', 'sociallinks', 'skills', 'tools', 'attributes', 'projects', 'experiences', 'educations', 'awards', 'testimonials', 'blogs'])
            ->has('stories')
            ->has('sociallinks')
            ->has('skills')
            ->has('tools')
            ->has('attributes') 
            ->has('experiences')
            ->has('educations') 
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }
    
    
    public function getMemberBySlug($slug) {
        
        $chunkSize = 8;
    
        return User::with([
                'stories', 'sociallinks', 'skills', 'tools', 'attributes',
                'projects', 'experiences', 'educations', 'awards', 'testimonials', 'blogs'
            ])
            ->whereHas('skills', function ($query) use ($slug) {
                $query->where('skills.slug', $slug);
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
    
    
    
     public function GetMembersBySkill($slug, Request $request)
    {
       
      try {
          
          if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            $users = $this->getMemberBySlug($slug);
            
            $currentskill = Skill::where('slug', $slug)->firstOrFail();
            $skills = Skill::all();
            
            $loggedinUser = null;
            if (!empty($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $loggedinUser = User::where('email', $email)->first();
            }
    
            $connections = $this->MainController->getConnections($loggedinUser, $users);
            
            
            // Handle AJAX request for pagination
            if ($request->ajax()) {
                return response()->json([
                    'view' => view('partials.user-list', compact('currentskill', 'skills', 'users', 'loggedinUser', 'connections'))->render(),
                    'next_page' => $users->nextPageUrl(),
                    'current_page' => $users->currentPage(),
                    'last_page' => $users->lastPage(),
                ]);
            }
            
            $ExploreSkills = Skill::withCount('users')
                             ->having('users_count', '>', 4)  // Filters tools that have at least one user
                             ->inRandomOrder()  // Randomize the order
                             ->take(6)  // Limit to 6 tools
                             ->get();
            
            // Return the full view for the tool page
            return view('singleskill', [
                'users' => $users,
                'loggedinUser' => $loggedinUser,
                'connections' => $connections,
                'skills' => $skills,
                'currentskill' => $currentskill,
                'ExploreSkills' => $ExploreSkills,
                'message' => $users->isEmpty() ? 'No Users Found' : null,
            ]);
            
    
        } catch (\Exception $e) {
                
                return view('singleskill')->with('users', collect()); 
        }
    }
    
    
}
