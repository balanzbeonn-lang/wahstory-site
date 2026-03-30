<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sociallink;
use App\Models\Story;
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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     

     public function SkillAndAttributesAndToolsForForm()
    {
        $industries = Industry::all();  
        $skills = Skill::all();  
        $tools = Tool::all();
        $attributes = Attribute::all();   

         // Determine which view to return based on the current route
        $routeName = request()->route()->getName();

        if ($routeName == 'index') {
            return view('index', compact('industries', 'skills', 'tools', 'attributes')); 
        } 
        return view('build-my-presence', compact('industries', 'skills', 'tools', 'attributes')); 

    }

    public function getUserPortfolioBySlug($slugUsername)
    {
        // Fetch the user based on the slug_username
        $user = User::whereSlugUsername($slugUsername)->first();

        // Check if the user exists
        if (!$user) {
            // If the user is not found, you can return a 404 response or a custom message
            return response()->json(['message' => 'User not found'], 404);
            // return redirect()->route('index')->with('error', 'User not found');
        }

        
        $story = Story::whereUserId($user->id)->first();
 
        $socials = Sociallink::where('user_id', $user->id)->get();

        // Fetch all skill IDs for the user
        $skillIds = Skill_user::where('user_id', $user->id)->pluck('skill_id');
        $skills = Skill::whereIn('id', $skillIds)->get();

        // Fetch all Tool IDs for the user
        $toolIds = Tool_user::where('user_id', $user->id)->pluck('tool_id');
        $tools = Tool::whereIn('id', $toolIds)->get();

        
        $projects = Project::where('user_id', $user->id)->get();
        
        $experiences = Experience::where('user_id', $user->id)->get();

        $educations = Education::where('user_id', $user->id)->get();

        $awards = Award::where('user_id', $user->id)->get();
        
        $testimonials = Testimonial::where('user_id', $user->id)->get();

        $blogs = Blog::where('user_id', $user->id)->get();


        // If the user is found, return the user details (or pass it to a view)
        return view('mypresence', compact('user', 'story', 'socials', 'skills', 'tools', 'projects', 'experiences', 'educations', 'awards', 'testimonials', 'blogs'));
    }


    public function index()
    {
        $users = User::all(); // Fetch all users from the database
        return view('index', ['users' => $users]); // Pass users to the view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'honorifics' => 'required|string|max:10',
            'firstname' => 'required|string|max:55',
            'lastname' => 'required|string|max:55',
            'dialCode' => 'required|string|max:10',  
            'email' => 'required|email|max:55',  
            'profilephoto' => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:3072',
            'facebookUrl' => 'nullable|url',
            'instagramUrl' => 'nullable|url',
            'linkedinUrl' => 'nullable|url',
            'twitterUrl' => 'nullable|url',            
            'storyTitle' => 'nullable|string|max:255',
            'ques1' => 'nullable|string|max:255',
            'ques2' => 'nullable|string|max:255',
            'ques3' => 'nullable|string|max:255',
            'ques4' => 'nullable|string|max:255',
            'industries' => 'nullable|array',
            'industries.*' => 'exists:industries,id',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
            'tools' => 'nullable|array',
            'tools.*' => 'exists:tools,id',
            'attributes' => 'nullable|array',
            'attributes.*' => 'exists:attributes,id'
        ]);

            // Initialize $imageName
            $imageName = null;

            // Handle profile photo upload if present
            if ($request->hasFile('profilephoto')) {
                $image = $request->file('profilephoto');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('img/photos'), $imageName);
            }

            $otpData = Session::get('otp_data');

        // Create and save user details
        $user = new User();
        $user->title = $validatedData['honorifics'];
        $user->firstname = $validatedData['firstname'];
        $user->lastname = $validatedData['lastname'];
        $user->dialcode = $validatedData['dialCode'];
        $user->phone = $otpData['phone'];
        $user->email = $validatedData['email'];

        
        if($request->has("totalexperience")) {
            $user->totalexperience = $request->input("totalexperience");
        }
        if($request->has("totalproject")) {
            $user->totalproject = $request->input("totalproject");
        }
        if($request->has("totalclients")) {
            $user->totalclients = $request->input("totalclients");
        }
        if($request->has("totalawards")) {
            $user->totalawards = $request->input("totalawards");
        }

        $user->photo = $imageName; // Store image name if available
        $user->save();

        // Generate a random password
        $password = Str::random(12);

        // Hash the password using Laravel's Hash::make()
        $hashedPassword = Hash::make($password);


        $existingUser = DB::connection('secondary_mysql')
                    ->table('users')
                    ->where('email', $validatedData['email'])
                    ->first();

        //If User has already Registered with WAHStory        
            if ($existingUser) {
            
                DB::connection('secondary_mysql')
                ->table('users')
                ->where('email', $validatedData['email'])
                ->update(['ClubId' => $user->id]);

                Session::put('expire', time() + (60 * 30));
                Session::put('userid', $existingUser->id);
                Session::put('email', $validatedData['email']);
                Session::put('portfolioURL', $user->slug_username);


            }else{
            
                $newWahUserId = DB::connection('secondary_mysql')->table('users')->insertGetId([
                    'name' => $validatedData['firstname'] . ' ' . $validatedData['lastname'],  
                    'phone' => $otpData['phone'],
                    'email' => $validatedData['email'], 
                    'password' => $hashedPassword, 
                    'ClubId' => $user->id,  
                ]);
                
                Session::put('expire', time() + (60 * 30));
                Session::put('userid', $newWahUserId);
                Session::put('email', $validatedData['email']);
                Session::put('portfolioURL', $user->slug_username);
                
                 

            }


            // Save social media links if any URL is provided
            $links = [
                'facebook' => $request->facebookUrl,
                'instagram' => $request->instagramUrl,
                'linkedin' => $request->linkedinUrl,
                'twitter' => $request->twitterUrl,
            ];

            // Iterate over each social link and save it individually
            foreach ($links as $platform => $url) {
                if ($url) { // Save only if the URL is provided
                    $socialLink = new Sociallink();
                    $socialLink->user_id = $user->id; // Set the user ID
                    $socialLink->platform = ucfirst($platform); // Capitalize platform name (e.g., Instagram)
                    $socialLink->link = $url; // Set the profile link
                    $socialLink->save(); // Save the social link record
                }
            }

        $story = new Story();
        $story->user_id = $user->id; // Assuming user_id is passed
        $story->title = $validatedData['storyTitle'] ?? null;
        $story->q1 = $validatedData['ques1'] ?? null;
        $story->q2 = $validatedData['ques2'] ?? null;
        $story->q3 = $validatedData['ques3'] ?? null;
        $story->q4 = $validatedData['ques4'] ?? null;
        $story->q5 = $validatedData['ques5'] ?? null;
        $story->save();  
        
            // Attach selected industries to the user
        if ($request->has('industries')) {
            // The industries array contains the industries IDs
            $user->industries()->attach($request->industries);
        }

            // Attach selected skills to the user
        if ($request->has('skills')) {
            // The skills array contains the skill IDs
            $user->skills()->attach($request->skills);
        }
        
        // Attach selected tools to the user
        if ($request->has('tools')) {
            // The tools array contains the tool IDs
            $user->tools()->attach($request->tools);
        }
 
        $attributes = array_filter($request->input('attributes', []), function ($value) {
            return !empty($value) && is_numeric($value);
        }); 
        if (!empty($attributes)) {
            $user->attributes()->attach($attributes);
        }

        // // Attach selected attributes to the user
        // if ($request->has('attributes')) {
        //     // The attributes array contains the attribute IDs
        //     $user->attributes()->attach($request->attributes);
        // }


        $projectCount = 1;

         
            // Loop until no more projects are found
            while ($request->has("project{$projectCount}name") && !empty($request->input("project{$projectCount}name")) ) {
                // Retrieve the project details
                $projectname = $request->input("project{$projectCount}name");
                $projectlink = $request->input("project{$projectCount}link");
                $projectobjective = $request->input("project{$projectCount}Objective");
                $projectrole = $request->input("project{$projectCount}Role");
                $projectoutcome = $request->input("project{$projectCount}Outcome");
                $projectfile = $request->file("project{$projectCount}file");
        
                // Save the image if uploaded
                $ProjectimagePath = null;
                if ($projectfile) { 
                    $projectimageName = time() . '.' . $projectfile->getClientOriginalExtension();
                    $projectfile->move(public_path('img/projects'), $projectimageName);
                    
                }
        
                // Save the project in the database
                $project = new Project();
                $project->user_id = $user->id; 
                $project->project_name = $projectname;
                $project->project_link = $projectlink;
                $project->project_objective = $projectobjective;
                $project->project_role = $projectrole;
                $project->project_outcome = $projectoutcome;
            if ($projectfile) { 
                $project->project_photo = $projectimageName;
            }
                $project->save();
                    
                $projectCount++;
            }
        
            //Experience:
            $experienceCount = 1;

            // Loop until no more experiences are found
            while ($request->has("exp{$experienceCount}company") && !empty($request->input("exp{$experienceCount}company")) ) {
                // Retrieve the experience details
                $experienceCompany = $request->input("exp{$experienceCount}company");
                $experienceRole = $request->input("exp{$experienceCount}role");

            $validatedData1 = $request->validate([
                "exp{$experienceCount}start-month" => 'nullable|date_format:Y-m',
                "exp{$experienceCount}end-month" => 'nullable|date_format:Y-m', 
            ]);

                $experienceSmonth = $validatedData1["exp{$experienceCount}start-month"] . '-01';
                $experienceEmonth = $validatedData1["exp{$experienceCount}end-month"] . '-01';
                $experiencedesc = $request->input("exp{$experienceCount}desc"); 

                // Save the experience in the database
                $experience = new Experience();
                $experience->user_id = $user->id; 
                $experience->company_name = $experienceCompany;
                $experience->role = $experienceRole;
                $experience->durationfrom = $experienceSmonth;
                $experience->durationto = $experienceEmonth;
                $experience->description = $experiencedesc; 
                
                $experience->save();
                    
                $experienceCount++;
            }

            //Education

            $educationCount = 1;
            // Loop until no more educations are found
            while ($request->has("edu{$educationCount}university") && !empty($request->input("edu{$educationCount}university")) ) {
                // Retrieve the education details
                $educationUniversity = $request->input("edu{$educationCount}university");
                $educationCourse = $request->input("edu{$educationCount}course");
                $educationSmonth = $request->input("edu{$educationCount}start-month");
                $educationEmonth = $request->input("edu{$educationCount}end-month"); 

                // Save the education in the database
                $education = new Education();
                $education->user_id = $user->id; 
                $education->institution_name = $educationUniversity;
                $education->degree = $educationCourse;
                $education->yearfrom = $educationSmonth;
                $education->yearto = $educationEmonth; 
                
                $education->save();
                    
                $educationCount++;
            }

            //Awards

            $awardCount = 1;
         
            // Loop until no more awards are found
            while ($request->has("awd{$awardCount}title") && !empty($request->input("awd{$awardCount}title")) ) {
                // Retrieve the award details
                $awardTitle = $request->input("awd{$awardCount}title");
                $awardBody = $request->input("awd{$awardCount}body");
                $awardYear = $request->input("awd{$awardCount}year"); 
                $awardFile = $request->file("awd{$awardCount}file");
                $awardDesc1 = $request->input("awd{$awardCount}desc1"); 
                $awardDesc2 = $request->input("awd{$awardCount}desc2");  
        
                // Save the image if uploaded 
                if ($awardFile) { 
                    $awardimageName = time() . '.' . $awardFile->getClientOriginalExtension();
                    $awardFile->move(public_path('img/awards'), $awardimageName);
                    
                }
        
                // Save the award in the database
                $award = new Award();
                $award->user_id = $user->id; 
                $award->award_title = $awardTitle;
                $award->awarding_body = $awardBody;
                $award->year = $awardYear;

            if ($awardFile) { 
                $award->award_photo = $awardimageName;
            }
                $award->whyreceiving = $awardDesc1;
                $award->careerimpact = $awardDesc2;
                $award->save();
                    
                $awardCount++;
            }

            
            //Testimonials

            $testimonialCount = 1;
                    
            // Loop until no more testimonials are found
            while ($request->has("tstm{$testimonialCount}name") && !empty($request->input("tstm{$testimonialCount}name")) ) {
                // Retrieve the testimonial details
                $testimonialName = $request->input("tstm{$testimonialCount}name"); 
                $testimonialFile = $request->file("tstm{$testimonialCount}file");
                $testimonialDesig = $request->input("tstm{$testimonialCount}designation"); 
                $testimonialCompany = $request->input("tstm{$testimonialCount}company"); 
                $testimonialContent = $request->input("tstm{$testimonialCount}content"); 

                // Save the image if uploaded 
                if ($testimonialFile) { 
                    $testimonialimageName = time() . '.' . $testimonialFile->getClientOriginalExtension();
                    $testimonialFile->move(public_path('img/testimonials'), $testimonialimageName);
                    
                }        
                // Save the testimonial in the database
                $testimonial = new Testimonial();
                $testimonial->user_id = $user->id; 
                $testimonial->client_name = $testimonialName; 
                $testimonial->client_position = $testimonialDesig;
                $testimonial->client_company = $testimonialCompany;
                $testimonial->client_review = $testimonialContent;

            if ($testimonialFile) { 
                $testimonial->client_photo = $testimonialimageName;
            }
                $testimonial->save();
                    
                $testimonialCount++;
            }


            //For Blogs

            $blogCount = 1;
         
            // Loop until no more blogs are found
            while ($request->has("blog{$blogCount}title") && !empty($request->input("blog{$blogCount}title")) ) {
                // Retrieve the blog details
                $blogTitle = $request->input("blog{$blogCount}title"); 
                $blogFile = $request->file("blog{$blogCount}file");
                $blogLink = $request->input("blog{$blogCount}link");  

                // Save the image if uploaded 
                if ($blogFile) { 
                    $blogimageName = time() . '.' . $blogFile->getClientOriginalExtension();
                    $blogFile->move(public_path('img/blogs'), $blogimageName);
                    
                }        
                // Save the blog in the database
                $blog = new Blog();
                $blog->user_id = $user->id; 
                $blog->blog_title = $blogTitle; 
                $blog->blog_link = $blogLink; 
                
            if ($blogFile) { 
                $blog->blog_image = $blogimageName;
            }
                $blog->save();
                    
                $blogCount++;
            }            

        // Redirect or return a response
        return redirect()->route('thankyou')->with('success', 'Data saved successfully!');

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        
    }


    // Function to savedatainsteps and store 
    public function savedatainsteps(Request $request)
    {
          

        return response()->json([
           'status' => 'success', // 'success' is usually written in lowercase for consistency
           'message' => 'OTP generated and sent successfully', 
       ]);
    }


     // Function to generate OTP and store in session
     public function generateOtp(Request $request)
     {
         $request->validate([
             'phone' => 'required|regex:/^[0-9]{10,15}$/|max:15',
             'dialcode' => 'required',
         ]);
 
         // Generate a 6-digit OTP
         $otp = rand(100000, 999999);
 
         // Store OTP, phone number, and expiration time in session
         $otpData = [
             'otp' => $otp,
             'dialcode' => $request->input('dialcode'),
             'phone' => $request->input('phone'),
             'expires_at' => now()->addMinutes(5) // OTP expires in 5 minutes
         ];  
         Session::put('otp_data', $otpData);
 
         return response()->json([
            'status' => 'success', // 'success' is usually written in lowercase for consistency
            'message' => 'OTP generated and sent successfully',
            'otp' => $otpData['otp'],
        ]);
     }
     
      // Function to verify OTP
    public function verifyOtp(Request $request)
    {
        // Validate the OTP
        $request->validate([
            'otp' => 'required|digits:6', 
        ]);

        $otpData = Session::get('otp_data');

        if (!$otpData) {
            return response()->json([
                'status' => 'error',
                'message' => 'OTP session expired. Please request a new OTP.'
            ], 400);
        }

        if ($otpData['otp'] == $request->input('otp') && now()->lt($otpData['expires_at'])) {

            $phoneNumber = Session::get('otp_data.phone');

            Session::forget('otp_data');

            Session::put('otp_data.phone', $phoneNumber); 
            
            return response()->json([
                'status' => 'success',
                'message' => 'OTP verified successfully'
            ]);
        }

        return response()->json([
            'status' => 'error',             
            'message' => 'Invalid or expired OTP'
        ], 400);
    }





}


