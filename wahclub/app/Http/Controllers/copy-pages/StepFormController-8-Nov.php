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
use App\Models\LetsWorkQuery;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use OpenAI\Laravel\Facades\OpenAI;


use Illuminate\Support\Facades\Mail;
use App\Mail\YourMailable;



class StepFormController extends Controller
{
 
    public function combinedMethod($userid)
    {
        // Call logic from both methods
        $industries = Industry::all();  
        $skills = Skill::all();  
        $tools = Tool::all();
        $attributes = Attribute::all();   

        $user = User::find($userid);
        
        if (!$user) {
            // Handle case when user is not found
            return redirect('/')->with('error', 'User not found');
        }
        
        //Get Selected Data By User
        $socials = Sociallink::where('user_id', $user->id)->get();
        
        
        $WAHUser = DB::connection('secondary_mysql')
                    ->table('users')
                    ->where('ClubId', $user->id)
                    ->first();
        
        if (!$WAHUser) {
            $WAHUserStory = null;
        }else{
            $WAHUserStory = DB::connection('secondary_mysql')
                    ->table('stories')
                    ->where('userid', $WAHUser->id)
                    ->first();
        }
         
        
        $UserIndustry = $user->industries;
        
        $UserSkills = $user->skills;
        
        $UserTools = $user->tools;
        
        $UserAttributes = $user->attributes;
        
        $UserExperiences = Experience::where('user_id', $user->id)->get();
        
        $UserEducations = Education::where('user_id', $user->id)->get();
        
        $UserProjects = Project::where('user_id', $user->id)->get();
        
        $UserAwards = Award::where('user_id', $user->id)->get();  
        
        $UserTestimonials = Testimonial::where('user_id', $user->id)->get();
        
        $UserBlogs = Blog::where('user_id', $user->id)->get();
         
        
        
        $UserStory = Story::where('user_id', $user->id)->first();
        
        // Return response (adjust this based on your needs)
        return view('build-my-presence', compact('industries', 'skills', 'tools', 'attributes', 'user', 'socials', 'WAHUserStory', 'UserIndustry', 'UserSkills', 'UserTools', 'UserAttributes', 'UserExperiences', 'UserEducations', 'UserProjects', 'UserAwards', 'UserTestimonials', 'UserBlogs', 'UserStory')); 
    }
    
    
    
    // Fetch the user based on the slug_username
        // $user = User::whereSlugUsername($slugUsername)->first();
        
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
        
        $UserAttributes = $user->attributes;

        
        $projects = Project::where('user_id', $user->id)->get();
        
        $experiences = Experience::where('user_id', $user->id)->orderBy('durationfrom', 'desc')->get();

        $educations = Education::where('user_id', $user->id)->orderBy('yearfrom', 'desc')->get();

        $awards = Award::where('user_id', $user->id)->get();
        
        $testimonials = Testimonial::where('user_id', $user->id)->get();

        $blogs = Blog::where('user_id', $user->id)->get();


        // If the user is found, return the user details (or pass it to a view)
        return view('mypresence', compact('user', 'story', 'socials', 'skills', 'tools', 'UserAttributes', 'projects', 'experiences', 'educations', 'awards', 'testimonials', 'blogs'));
        
        
        
    }
    
    

    // Function to savedatainsteps and store 
    public function savedatainsteps(Request $request)
    {

        $validatedData = $request->validate([  
            'facebookUrl' => 'nullable|url',
            'instagramUrl' => 'nullable|url',
            'linkedinUrl' => 'nullable|url',
            'twitterUrl' => 'nullable|url',  
        ]);


        if ($request->hasFile('profilephoto')) {
            
            if ($request->input('UserIDCurrent')) {
        
                $idd = $request->input('UserIDCurrent');
                
                $user = User::findOrFail($idd);
                
                $oldImage = $user->photo;
                
                // Unlink (delete) the old image if it exists
                if ($oldImage && file_exists(public_path('img/photos/' . $oldImage))) {
                    unlink(public_path('img/photos/' . $oldImage));
                }
            }
            
        }



        // Initialize $imageName
        $imageName = null;

        // Handle profile photo upload if present
        if ($request->hasFile('profilephoto')) {
            
            
            $image = $request->file('profilephoto');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/photos'), $imageName);
        }

        $user = User::updateOrCreate(
            ['email' => $request->input('email')],  // This is the condition to check (if user exists by email)
            array_filter([
                'photo' => isset($imageName) ? $imageName : null, // Only set if $imageName is not null
                'title' => $request->input('honorifics') ?? null,
                'totalexperience' => $request->input('totalexperience') ?? null,
                'totalproject' => $request->input('totalproject') ?? null,
                'totalclients' => $request->input('totalclients') ?? null,
                'totalawards' => $request->input('totalawards') ?? null,
                'otherIndustries' => $request->input('otherIndustries') ?? null,
                'otherSkills' => $request->input('otherSkills') ?? null,
                'otherTools' => $request->input('otherTools') ?? null,
            ])
        );

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
                Sociallink::updateOrCreate(
                    [
                        'user_id' => $user->id,  // Match by user ID and platform
                        'platform' => ucfirst($platform),
                    ],
                    [
                        'link' => $url // Set or update the profile link
                    ]
                );
            }
        }

            // Attach selected industries to the user
            if ($request->has('industries')) {
            // The industries array contains the industries IDs
            $user->industries()->sync($request->industries);
        }

            // Attach selected skills to the user
        if ($request->has('skills')) {
            // The skills array contains the skill IDs
            $user->skills()->sync($request->skills);
        }
         
        // Attach selected tools to the user
        if ($request->has('tools')) {
            // The tools array contains the tool IDs
            $user->tools()->sync($request->tools);
        }
    
        $attributes = array_filter($request->input('attributes', []), function ($value) {
            return !empty($value) && is_numeric($value);
        }); 
        if (!empty($attributes)) {
            $user->attributes()->sync($attributes);
        }
    

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
            $projectimageName = null;
            if ($projectfile) { 
                $projectimageName = time() . '.' . $projectfile->getClientOriginalExtension();
                $projectfile->move(public_path('img/projects'), $projectimageName);
            }
            
            $projectId = $request->input("project{$projectCount}id");
            
            $projectsearchCriteria = [
                    'user_id' => $user->id,
                ];
                
            if ($projectId) {
                $projectsearchCriteria['id'] = $projectId;
            }
            
            
            $projectdata = [
                'project_name' => $projectname,
                'project_link' => $projectlink,
                'project_objective' => $projectobjective,
                'project_role' => $projectrole,
                'project_outcome' => $projectoutcome,
            ];
             
            if (!empty($projectimageName)) {
                $projectdata['project_photo'] = $projectimageName;
            }
            
            Project::updateOrCreate(
                $projectsearchCriteria,
                $projectdata 
            );
            
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
                "exp{$experienceCount}start-month" => 'nullable',
                "exp{$experienceCount}end-month" => 'nullable', 
                "exp{$experienceCount}currentworking" => 'nullable', 
            ]);

                $experienceSmonth = $validatedData1["exp{$experienceCount}start-month"] . '-01';
                // $experienceEmonth = $validatedData1["exp{$experienceCount}end-month"] . '-01';
                
                 $experienceEmonth = !empty($validatedData1["exp{$experienceCount}end-month"]) ? $validatedData1["exp{$experienceCount}end-month"] . '-01' : null;
                 
                 $exptillpresent = $request->input("exp{$experienceCount}currentworking", null);
                 
                $experiencedesc = $request->input("exp{$experienceCount}desc"); 
            
            $experienceId = $request->input("exp{$experienceCount}id");
            
            $searchCriteria = [
                    'user_id' => $user->id,
                ];
                
            if ($experienceId) {
                $searchCriteria['id'] = $experienceId;
            }

            // Save or update the Experience in the database
            Experience::updateOrCreate(
                $searchCriteria,
                [   
                    'company_name' => $experienceCompany,
                    'role' => $experienceRole,
                    'durationfrom' => $experienceSmonth,
                    'durationto' => $experienceEmonth,
                    'present' => $exptillpresent,
                    'description' => $experiencedesc
                ]
            ); 
                
            $experienceCount++;
        }
    
    
        $educationCount = 1;
            // Loop until no more educations are found
            while ($request->has("edu{$educationCount}university") && !empty($request->input("edu{$educationCount}university")) ) {
                // Retrieve the education details
                $educationUniversity = $request->input("edu{$educationCount}university");
                $educationCourse = $request->input("edu{$educationCount}course");
                $educationSmonth = $request->input("edu{$educationCount}start-month");
                
                // $educationEmonth = $request->input("edu{$educationCount}end-month"); 
                
                
                $educationEmonth = $request->input("edu{$educationCount}end-month", null);
                 
                 $edutillpresent = $request->input("edu{$educationCount}currentpursuing", null);
                
                
                $educationSmonth = str_replace('/', '-', $educationSmonth);
                
                if($educationEmonth !== NULL) {
                    $educationEmonth = str_replace('/', '-', $educationEmonth);
                }
                
                
            $EducationId = $request->input("edu{$educationCount}id");
            $EDsearchCriteria = [
                    'user_id' => $user->id
                    // 'institution_name' => $educationUniversity
                ];
            if ($EducationId) {
                $EDsearchCriteria['id'] = $EducationId;
            }

                // Save or update the Experience in the database
                Education::updateOrCreate(
                    $EDsearchCriteria,
                    [   
                        'institution_name' => $educationUniversity,
                        'degree' => $educationCourse,
                        'yearfrom' => $educationSmonth,
                        'yearto' => $educationEmonth,
                        'present' => $edutillpresent
                    ]
                ); 
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
            
            $awardimageName = NULL;
            // Save the image if uploaded 
            if ($awardFile) { 
                $awardimageName = time() . '.' . $awardFile->getClientOriginalExtension();
                $awardFile->move(public_path('img/awards'), $awardimageName);
                
            }
            
            $AwardId = $request->input("awd{$awardCount}id");
            
            $AwdsearchCriteria = [
                    'user_id' => $user->id,
                ];
                
            if ($AwardId) {
                $AwdsearchCriteria['id'] = $AwardId;
            }
            
            
            $awarddata = [
                'award_title' => $awardTitle,
                'awarding_body' => $awardBody,
                'year' => $awardYear, 
                'whyreceiving' => $awardDesc1,
                'careerimpact' => $awardDesc2,
            ];
             
            if (!empty($awardimageName)) {
                $awarddata['award_photo'] = $awardimageName;
            }
            
            Award::updateOrCreate(
                $AwdsearchCriteria,
                $awarddata 
            );
                
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

            $testimonialimageName = NULL;
            // Save the image if uploaded 
            if ($testimonialFile) { 
                $testimonialimageName = time() . '.' . $testimonialFile->getClientOriginalExtension();
                $testimonialFile->move(public_path('img/testimonials'), $testimonialimageName);
                
            }  
            
            $TestimonialId = $request->input("tstm{$testimonialCount}id");
            
            $TstmsearchCriteria = [
                    'user_id' => $user->id,
                ];
                
            if ($TestimonialId) {
                $TstmsearchCriteria['id'] = $TestimonialId;
            }
            
            $testimonialdata = [
                'client_name' => $testimonialName,
                'client_position' => $testimonialDesig,
                'client_company' => $testimonialCompany, 
                'client_review' => $testimonialContent,
            ];
             
            if (!empty($testimonialimageName)) {
                $testimonialdata['client_photo'] = $testimonialimageName;
            }
            
            Testimonial::updateOrCreate(
                $TstmsearchCriteria,
                $testimonialdata 
            );
            
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

            $blogimageName = NULL;
            // Save the image if uploaded 
            if ($blogFile) { 
                $blogimageName = time() . '.' . $blogFile->getClientOriginalExtension();
                $blogFile->move(public_path('img/blogs'), $blogimageName);
                
            }     
            
            $BlogCountId = $request->input("blog{$blogCount}id");
            
            $BlogsearchCriteria = [
                    'user_id' => $user->id,
                ];
                
            if ($BlogCountId) {
                $BlogsearchCriteria['id'] = $BlogCountId;
            }
            
            
            $blogdata = [
                'blog_title' => $blogTitle,
                'blog_link' => $blogLink
            ];
             
            if (!empty($blogimageName)) {
                $blogdata['blog_image'] = $blogimageName;
            }
            
            Blog::updateOrCreate(
                 $BlogsearchCriteria,
                $blogdata 
            );
            
            $blogCount++;
        }  
        
        //Storing Story Data
        if (!empty($request->input('StoryType'))) {
            
            if ($request->input('StoryType') == "OLDStory") {
                
                //Story From WAHStory
                $storyData = [
                    'title' => $request->input('WAH_storyTitle') ?? null,
                    'storycontent' => $request->input('WAH_Story') ?? null,
                ]; 
                
            } elseif ($request->input('StoryType') == "NEWStory") {
               
              
              if (!empty($request->input('WAH_storyTitle')) && !empty($request->input('WAH_Story'))) {
                  
                  //Story From WAHStory
                    $storyData = [
                        'title' => $request->input('WAH_storyTitle') ?? null,
                        'storycontent' => $request->input('WAH_Story') ?? null,
                    ]; 
                  
              } else {
                  
                  //Fresh written Story Bia Form
                    $q1 = $request->input('ques1') ?? null;
                    $q2 = $request->input('ques2') ?? null;
                    $q3 = $request->input('ques3') ?? null;
                    $q4 = $request->input('ques4') ?? null;
                    $q5 = $request->input('ques5') ?? null;
                if ($q1 !== null && $q2 !== null && $q3 !== null && $q4 !== null && $q5 !== null) {
                    $storyData['storycontent'] = '<p>' . $q1 . '</p> <p> ' . $q2 . '</p> <p> ' . $q3 . '</p> <p> ' . $q4 . '</p> <p> ' . $q5 . '</p>';
                } else{
                    $storyData['storycontent'] = '';
                }
                  
              }
              
                
                
            } elseif ($request->input('StoryType') == "AIStory") {
                
                $storyData = [
                    'title' => $request->input('storyTitle') ?? null,
                    'storycontent' => $request->input('generatedStory') ?? null,
                ];
                
            }
            
        if (!empty($storyData['storycontent'])) {
            $story = Story::updateOrCreate(
                    ['user_id' => $user->id],  
                    $storyData
                );
        }
                
            
        }//Storing Story Data
         
         
         if ($request->input('final_step') === 'final') {
             return redirect()->route('thankyou')->with('success', 'Data saved successfully!');
         }
        
        return response()->json([
            'status' => 'success', 
            'message' => 'Successfully', 
         ]);        
       
    }


     // Make sure you have the OpenAI package installed

     public function regenerate(Request $request)
    {
        
        if (!empty($request->input('ques1')) && !empty($request->input('ques2')) && !empty($request->input('ques3')) && !empty($request->input('ques4')) && !empty($request->input('ques5'))) {
            
            
            $previousStory1 = $request->input('ques1'); 
            $previousStory2 = $request->input('ques2'); 
            $previousStory3 = $request->input('ques3'); 
            $previousStory4 = $request->input('ques4'); 
            $previousStory5 = $request->input('ques5'); 
    
            try {
                $response = OpenAI::chat()->create([
                    'model' => 'gpt-3.5-turbo', // or 'gpt-4'
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a professional content editor and writer with over 10 years of professional experience.'],
                            ['role' => 'user', 'content' => "Here is the story: \"$previousStory1\". Rewrite this story by adding emotions while writing about an individual's personal challenges and overcoming. The story should begin with a compelling statement that resonates with the reader. Ensure each section is well-structured, curating a journey in a professional yet dramatic manner. Write in the first person, making the final story impactful and inspiring, ensuring it feels human rather than AI-generated."],
                    ],
                ]);
                
    
                $response2 = OpenAI::chat()->create([
                    'model' => 'gpt-3.5-turbo', // or 'gpt-4'
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a professional content editor and writer with over 10 years of professional experience.'],
                        ['role' => 'user', 'content' => "Here is the story: \"$previousStory2\". Rewrite this story by adding emotions while writing about an individual's personal challenges and overcoming. The story should begin with a compelling statement that resonates with the reader. Ensure each section is well-structured, curating a journey in a professional yet dramatic manner. Write in the first person, making the final story impactful and inspiring, ensuring it feels human rather than AI-generated."],
                    ],
                ]);
    
                $response3 = OpenAI::chat()->create([
                    'model' => 'gpt-3.5-turbo', // or 'gpt-4'
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a professional content editor and writer with over 10 years of professional experience.'],
                        ['role' => 'user', 'content' => "Here is the story: \"$previousStory3\". Rewrite this story by adding emotions while writing about an individual's personal challenges and overcoming. The story should begin with a compelling statement that resonates with the reader. Ensure each section is well-structured, curating a journey in a professional yet dramatic manner. Write in the first person, making the final story impactful and inspiring, ensuring it feels human rather than AI-generated."],
                    ],
                ]);
    
                $response4 = OpenAI::chat()->create([
                    'model' => 'gpt-3.5-turbo', // or 'gpt-4'
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a professional content editor and writer with over 10 years of professional experience.'],
                        ['role' => 'user', 'content' => "Here is the story: \"$previousStory4\". Rewrite this story by adding emotions while writing about an individual's personal challenges and overcoming. The story should begin with a compelling statement that resonates with the reader. Ensure each section is well-structured, curating a journey in a professional yet dramatic manner. Write in the first person, making the final story impactful and inspiring, ensuring it feels human rather than AI-generated."],
                    ],
                ]);
    
                $response5 = OpenAI::chat()->create([
                    'model' => 'gpt-3.5-turbo', // or 'gpt-4'
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a professional content editor and writer with over 10 years of professional experience.'],
                        ['role' => 'user', 'content' => "Here is the story: \"$previousStory5\". Rewrite this story by adding emotions while writing about an individual's personal challenges and overcoming. The story should begin with a compelling statement that resonates with the reader. Ensure each section is well-structured, curating a journey in a professional yet dramatic manner. Write in the first person, making the final story impactful and inspiring, ensuring it feels human rather than AI-generated."],
                    ],
                ]);
    
                $newStory1 = $response['choices'][0]['message']['content'];
                $newStory2 = $response2['choices'][0]['message']['content'];
                $newStory3 = $response3['choices'][0]['message']['content'];
                $newStory4 = $response4['choices'][0]['message']['content'];
                $newStory5 = $response5['choices'][0]['message']['content'];
    
    
                $CompleteStory = $newStory1 .' ' . $newStory2 .' ' . $newStory3 .' ' . $newStory4 .' ' . $newStory5;
                
                $TitleResponce = OpenAI::chat()->create([
                    'model' => 'gpt-3.5-turbo', // or 'gpt-4'
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a professional editor.'],
                        ['role' => 'user', 'content' => "Here is the story: \"$CompleteStory\". Please provide a title to this story in 50 to 60 characters"],
                    ],
                ]);
    
                $StoryTitle = $TitleResponce['choices'][0]['message']['content'];
    
    
                return response()->json([
                    'status' => 'success',
                    'newStory' => $newStory1,
                    'newStory2' => $newStory2,
                    'newStory3' => $newStory3,
                    'newStory4' => $newStory4,
                    'newStory5' => $newStory5,
                    'StoryTitle' => $StoryTitle,
    
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error generating story: ' . $e->getMessage()
                ]);
            }
            
            
            
        }else{
            //Story Is Beinge Generate By Old WAH Story
            
            $WAH_Story = $request->input('WAH_Story'); 
    
            try {
                $response = OpenAI::chat()->create([
                    'model' => 'gpt-3.5-turbo', // or 'gpt-4'
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a professional editor.'],
                        ['role' => 'user', 'content' => "Here is the story: \"$WAH_Story\". Please rewrite this story to be more professional and concise. Ensure that each section is clearly divided in p tag."],
                    ],
                ]);
                
     
                $newStoryContent = $response['choices'][0]['message']['content']; 
       
    
                return response()->json([
                    'status' => 'success',
                    'newStory' => $newStoryContent,
    
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error generating story: ' . $e->getMessage()
                ]);
            }
            
            
        }
        


    } //function

     
     
     
     
    public function testregeneratestory(Request $request)
        {
            $previousStory1 = $request->input('ques1'); 
                $previousStory2 = $request->input('ques2'); 
                $previousStory3 = $request->input('ques3'); 
                $previousStory4 = $request->input('ques4'); 
                $previousStory5 = $request->input('ques5');
    
            try {
                    $response = OpenAI::chat()->create([
                        'model' => 'gpt-3.5-turbo', // or 'gpt-4'
                        'messages' => [
                            ['role' => 'system', 'content' => 'You are a professional content editor and writer with over 10 years of professional experience.'],
                            ['role' => 'user', 'content' => "Here is the story: \"$previousStory1\". Rewrite this story by adding emotions while writing about an individual's personal challenges and overcoming. The story should begin with a compelling statement that resonates with the reader. Ensure each section is well-structured, curating a journey in a professional yet dramatic manner. Write in the first person, making the final story impactful and inspiring, ensuring it feels human rather than AI-generated."],
                        ],
                    ]);
                    
        
                    $response2 = OpenAI::chat()->create([
                        'model' => 'gpt-3.5-turbo', // or 'gpt-4'
                        'messages' => [
                            ['role' => 'system', 'content' => 'You are a professional content editor and writer with over 10 years of professional experience.'],
                            ['role' => 'user', 'content' => "Here is the story: \"$previousStory2\". Rewrite this story by adding emotions while writing about an individual's personal challenges and overcoming. The story should begin with a compelling statement that resonates with the reader. Ensure each section is well-structured, curating a journey in a professional yet dramatic manner. Write in the first person, making the final story impactful and inspiring, ensuring it feels human rather than AI-generated."],
                        ],
                    ]);
        
                    $response3 = OpenAI::chat()->create([
                        'model' => 'gpt-3.5-turbo', // or 'gpt-4'
                        'messages' => [
                            ['role' => 'system', 'content' => 'You are a professional content editor and writer with over 10 years of professional experience.'],
                            ['role' => 'user', 'content' => "Here is the story: \"$previousStory3\". Rewrite this story by adding emotions while writing about an individual's personal challenges and overcoming. The story should begin with a compelling statement that resonates with the reader. Ensure each section is well-structured, curating a journey in a professional yet dramatic manner. Write in the first person, making the final story impactful and inspiring, ensuring it feels human rather than AI-generated."],
                        ],
                    ]);
        
                    $response4 = OpenAI::chat()->create([
                        'model' => 'gpt-3.5-turbo', // or 'gpt-4'
                        'messages' => [
                            ['role' => 'system', 'content' => 'You are a professional content editor and writer with over 10 years of professional experience.'],
                            ['role' => 'user', 'content' => "Here is the story: \"$previousStory4\". Rewrite this story by adding emotions while writing about an individual's personal challenges and overcoming. The story should begin with a compelling statement that resonates with the reader. Ensure each section is well-structured, curating a journey in a professional yet dramatic manner. Write in the first person, making the final story impactful and inspiring, ensuring it feels human rather than AI-generated."],
                        ],
                    ]);
        
                    $response5 = OpenAI::chat()->create([
                        'model' => 'gpt-3.5-turbo', // or 'gpt-4'
                        'messages' => [
                            ['role' => 'system', 'content' => 'You are a professional content editor and writer with over 10 years of professional experience.'],
                            ['role' => 'user', 'content' => "Here is the story: \"$previousStory5\". Rewrite this story by adding emotions while writing about an individual's personal challenges and overcoming. The story should begin with a compelling statement that resonates with the reader. Ensure each section is well-structured, curating a journey in a professional yet dramatic manner. Write in the first person, making the final story impactful and inspiring, ensuring it feels human rather than AI-generated."],
                            
                        ],
                    ]);
        
                    $newStory1 = $response['choices'][0]['message']['content'];
                    $newStory2 = $response2['choices'][0]['message']['content'];
                    $newStory3 = $response3['choices'][0]['message']['content'];
                    $newStory4 = $response4['choices'][0]['message']['content'];
                    $newStory5 = $response5['choices'][0]['message']['content'];
        
        
                    $CompleteStory = $newStory1 .' ' . $newStory2 .' ' . $newStory3 .' ' . $newStory4 .' ' . $newStory5;
                    
                    $TitleResponce = OpenAI::chat()->create([
                        'model' => 'gpt-3.5-turbo', // or 'gpt-4'
                        'messages' => [
                            ['role' => 'system', 'content' => 'You are a professional editor.'],
                            ['role' => 'user', 'content' => "Here is the story: \"$CompleteStory\". Please provide a title to this story in 50 to 60 characters"],
                        ],
                    ]);
        
                    $StoryTitle = $TitleResponce['choices'][0]['message']['content'];
                    
                    // return view('your_view', [
                    //     'status' => 'success',
                    //     'newStory' => $newStory1,
                    //     'newStory2' => $newStory2,
                    //     'newStory3' => $newStory3,
                    //     'newStory4' => $newStory4,
                    //     'newStory5' => $newStory5,
                    //     'StoryTitle' => $StoryTitle,
                    // ]);
        
                    return redirect()->to(url()->previous())->with([
                        'status' => 'success',
                        'newStory' => $newStory1,
                        'newStory2' => $newStory2,
                        'newStory3' => $newStory3,
                        'newStory4' => $newStory4,
                        'newStory5' => $newStory5,
                        'StoryTitle' => $StoryTitle,
        
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Error generating story: ' . $e->getMessage()
                    ]);
                }
    
    }
     
     

    /*public function sendEmail()
    {
        $data = ['message' => 'This is a test email!'];
    
        Mail::to('elements.officialpavan@gmail.com')->send(new YourMailable($data));
    
        return 'Email sent!';
    }
    */
    public function sendEmail()
    {
        Mail::raw('This is a test email.', function ($message) {
            $message->to('elements.officialpavan@gmail.com')
                    ->subject('Test Email from Laravel');
        });
    
        return 'Test Email Sent!';
    }
    
    
     public function letsconnectformsubmit(Request $request)
    {
        
        if ($request->input('UserIDCurrent') && $request->input('email')) {
            
                $emailId = $request->input('email');
                $name = $request->input('fname') . ' ' . $request->input('lname');
        
            $idd = $request->input('UserIDCurrent');        
            
            $user = User::findOrFail($idd);
            
            if($user) {
                
                $updateQuery = LetsWorkQuery::updateOrCreate(
                [
                    'email' => $request->input('email'), 
                    'user_id' => $user->id
                ],    
                array_filter([ 
                    
                    'firstname' => $request->input('fname') ?? null,
                    'lastname' => $request->input('lname') ?? null,
                    'dialcode' => $request->input('dialcode') ?? null,
                    'phone' => $request->input('phone') ?? null,
                    'message' => $request->input('message') ?? null
                ])
            );
                
                
                // return redirect()->route('thankyou')->with('success', 'Query send successfully!');
                return redirect()->to(url()->previous() . '#contact-section')->with([
                            'success' => 'Thankyou, your query has been sent successfully!',
                            'email' => $emailId,
                            'name' => $name
                    ]);
 
                
            }
            
        
        }
        
    } 




}
