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
use App\Models\Timezone;
use App\Models\Availability;

use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class MainController extends Controller
{
    
    public function getUsers($limit)
    {
        return User::with(['stories', 'sociallinks', 'skills', 'tools', 'attributes', 'projects', 'experiences', 'educations', 'awards', 'testimonials', 'blogs'])
            ->has('stories')
            ->has('sociallinks')
            ->has('skills')
            ->has('tools')
            ->has('attributes') 
            ->has('experiences')
            ->has('educations')
            ->orderBy('views', 'desc')
            ->limit($limit)
            ->get();
    }
    
    public function getConnections($loggedinUser, $users)
    {
        $connections = [];
    
        if ($loggedinUser) {
            foreach ($users as $member) {
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
    
        return $connections;
    }
    
// ######################################################
// Getting Club Members - Professional
// ######################################################
    
    public function getClubMembersProfessionals($limit)
    {
        
        $keywords = ['Engineer', 'Programmer', 'DevOps',  'Cloud', 'Cybersecurity', 'Accountant', 'Recruiter', 'Doctor', 'Pharmacist', 'Technician', 'Epidemiologist', 'Paralegal', 'Professor', 'Legal Advisor', 'Investment'];
        
        return User::with([
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
        ->where('featured_home', 'Yes')
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('stories', function ($query) use ($keyword) {
                          $query->where('title', 'like', '%' . $keyword . '%');
                      });
            }
        })
        ->orderBy('views', 'desc')
        ->limit($limit)
        ->get();
    }
    
// ######################################################
// Getting Club Members - Founders
// ######################################################
    
    public function getClubMembersFounders($limit)
    {
        
        $keywords = ['Entrepreneur', 'Founder', 'Co-Founder', 'CEO', 'Chief Operating Officer', 'COO', 'Managing Director', 'Owner', 'President', 'Principal', 'Corporate Founder', 'Chief Executive Officer', 'Chief Visionary Officer', 'CVO', 'Chief Technology Officer', 'CTO', 'Chief Strategy Officer', 'CSO', 'Founding Partner', 'Chief Marketing Officer', 'CMO', 'General Partner', 'Managing Partner', 'Business Owner', 'Principal Founder', 'Chief Visionary', 'Innovator', 'startup'];
        
        return User::select('id', 'firstname', 'lastname', 'slug_username', 'photo', 'totalexperience', 'views', 'featured_home')->with(['skills', 'experiences'])
        ->has('stories')
        ->has('sociallinks')
        ->has('skills')
        ->has('tools')
        ->has('attributes')
        ->has('experiences')
        ->has('educations')
        ->where('featured_home', 'Yes')
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('industries', function ($query) use ($keyword) {
                          $query->where('industry', 'like', '%' . $keyword . '%');
                      });
            }
        })
        ->orderBy('views', 'desc')
        ->limit($limit)
        ->get();
    }
    
// ######################################################
// Getting Club Members - Influencers & Artist
// ######################################################
    
    public function getClubMembersInfluencersBloggers($limit)
    {   
        
        $keywords = ['Influencer', 'Community', 'Vlogger', 'Blogger', 'Podcaster', 'collab', 'follower', 'influential', 'Sponser', 'Brand Ambassador', 'Online Personality', 'Blog Writer', 'Podcast Host', 'Live Streamer', 'Unboxing Expert', 'Female Empowerment Advocate', 'Lifestyle Enthusiast', 'Sponsored Posts', 'Affiliate', 'enthusiast', 'influence', 'storyteller', 'Collaboration', 'Photographer', 'Videographer', 'Photojournalist', 'Creative Consultant', 'TikTok Creator', 'X Expert', 'Dancer', 'Model', 'Musician', 'Magician', 'Singer', 'Composer', 'Painter', 'Artist', 'Makeup', 'Hair', 'Stylist', 'Performer', 'Actor', 'Actress', 'pageant', 'Beauty Queen', 'Beauty pageant', 'Mrs. Universe', 'Mr. Universe', 'Film', 'Media', 'Comedian', 'Producer', 'Internet Personality', 'acting', 'Comedy'];
        
        return User::select('id', 'firstname', 'lastname', 'slug_username', 'photo', 'totalexperience', 'views', 'featured_home')->with(['skills', 'experiences'])
        ->has('stories')
        ->has('sociallinks')
        ->has('skills')
        ->has('tools')
        ->has('attributes')
        ->has('experiences')
        ->has('educations')
        ->where('featured_home', 'Yes')
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('industries', function ($query) use ($keyword) {
                          $query->where('industry', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('stories', function ($query) use ($keyword) {
                          $query->where('title', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('educations', function ($query) use ($keyword) {
                          $query->where('degree', 'like', '%' . $keyword . '%');
                      });
            }
        })
        ->orderBy('views', 'desc')
        ->limit($limit)
        ->get();
    }
    
// ######################################################
// Getting Club Members - Wellness
// ######################################################
    
    public function getClubMembersWellness($limit)
    {
        
        $keywords = ['Wellness', 'Meditation', 'Yoga', 'Mindfulness', 'Hatha', 'Vinyasa', 'Shtanga', 'Nutritional', 'Nutrition', 'Sleep Coaching', 'Fitness',  'Training', 'Stress', 'Ayurvedic', 'Holistic', 'Health', 'Healing', 'Well-being Group', 'Life Balance', 'Self-Care', 'Active Lifestyle', 'Pilates Classes', 'Running Group', 'Exercise', 'Weight Loss', 'Workout', 'Anxiety Support', 'Depression Support', 'Mindset Coaching', 'Positive Psychology', 'Self-Love', 'Cognitive Behavioral Therapy', 'Mental Clarity', 'Personal Growth ', 'Herbal Medicine', 'Chakra Balancing', 'Acupuncture Support', 'Detox & Cleansing', 'Clean Eating', 'Plant-Based Diet', 'Keto Lifestyle', 'Gluten-Free Living', 'Healthy', 'Dietary Support', 'Food as Medicine', 'Superfoods', 'Self-Improvement', 'Personal Development', 'Empowerment Support', 'Lifestyle Transformation', 'Life Coaching', 'Accountability Partner', 'Progress Tracking', 'Personal Transformation', 'Inner Peace', 'Positive Mindset', 'Empowerment Network', 'Confidence Building', 'Mindful Living'];
        
        return User::select('id', 'firstname', 'lastname', 'slug_username', 'photo', 'totalexperience', 'views', 'featured_home')->with(['skills', 'experiences'])
        ->has('stories')
        ->has('sociallinks')
        ->has('skills')
        ->has('tools')
        ->has('attributes')
        ->has('experiences')
        ->has('educations')
        ->where('featured_home', 'Yes')
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('industries', function ($query) use ($keyword) {
                          $query->where('industry', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('stories', function ($query) use ($keyword) {
                          $query->where('title', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('educations', function ($query) use ($keyword) {
                          $query->where('degree', 'like', '%' . $keyword . '%');
                      });
            }
        })
        ->orderBy('views', 'desc')
        ->limit($limit)
        ->get();
    }
    
    
// ######################################################
// Getting Club Members - Coaches
// ######################################################
    
    public function getClubMembersCoaches($limit)
    {
        
        $keywords = ['Coaching', 'Coach', 'Tutoring', 'Public Speaking', 'Speaking', 'Speaker', 'advisor', 'therapist', 'mentor', 'trainer', 'consultant', 'Goal-setting'];
        
        return User::select('id', 'firstname', 'lastname', 'slug_username', 'photo', 'totalexperience', 'views', 'featured_home')->with(['skills', 'experiences'])
        ->has('stories')
        ->has('sociallinks')
        ->has('skills')
        ->has('tools')
        ->has('attributes')
        ->has('experiences')
        ->has('educations')
        ->where('featured_home', 'Yes')
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('industries', function ($query) use ($keyword) {
                          $query->where('industry', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('attributes', function ($query) use ($keyword) {
                          $query->where('attribute', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('stories', function ($query) use ($keyword) {
                          $query->where('title', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('educations', function ($query) use ($keyword) {
                          $query->where('degree', 'like', '%' . $keyword . '%');
                      });
            }
        })
        ->orderBy('views', 'desc')
        ->limit($limit)
        ->get();
    }
    
// ######################################################
// Getting Club Members - Marketing
// ######################################################
    
    public function getClubMembersMarketing($limit)
    {
        
        $keywords = ['SEM', 'SEO', 'Marketing', 'Digital Marketing', 'Advertising', 'Advertisement', 'Search Engine', 'Social media', 'PPC', 'Pay Per Click', 'Online branding', 'Google Ads', 'Facebook Ads', 'Web analytics', 'Conversion rate optimization', 'Growth hacking', 'Content strategy', 'Brand awareness', 'Online reputation management', 'Retargeting campaigns', 'Lead generation', 'Creator', 'Podcaster', 'Advertising', 'Content Creation', 'Brand Ambassador', 'Online Personality', 'Blog Writer', 'Podcast Host', 'Blogger & Writer', 'Product Reviews', 'Collaboration Specialist', 'Content Collaboration', 'Campaign Manager', 'PR & Brand Relations', 'Videographer', 'Graphic Designer', 'Storyteller', 'Photojournalist', 'Brand Strategist', 'Content Strategist', 'Creative Consultant ', 'Colorful Content', 'Editor', 'Web Designer', 'Web Developer', 'Full Stack', 'Html', 'Website', 'Application', 'Frontend', 'Backend', 'PHP Developer', 'Tech Lead', 'Team Leader', 'Tech Team', 'Freelance', 'Project Manager'];
        
        return User::select('id', 'firstname', 'lastname', 'slug_username', 'photo', 'totalexperience', 'views', 'featured_home')->with(['skills', 'experiences'])
        ->has('stories')
        ->has('sociallinks')
        ->has('skills')
        ->has('tools')
        ->has('attributes')
        ->has('experiences')
        ->has('educations')
        ->where('featured_home', 'Yes')
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('industries', function ($query) use ($keyword) {
                          $query->where('industry', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('attributes', function ($query) use ($keyword) {
                          $query->where('attribute', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('stories', function ($query) use ($keyword) {
                          $query->where('title', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('educations', function ($query) use ($keyword) {
                          $query->where('degree', 'like', '%' . $keyword . '%');
                      });
            }
        })
        ->orderBy('views', 'desc')
        ->limit($limit)
        ->get();
    }
    
    
// ######################################################
// Getting Club Members - Hospitality
// ######################################################
    
    public function getClubMembersHospitality($limit)
    {
        
        $keywords = ['Hospitality', 'Luxury', 'Hotel', 'Restaurant', 'Resort', 'Spa', 'Event planning', 'venue', 'Guest services', 'Front desk operations', 'Concierge services', 'Travel and tourism', 'Food and beverage', 'Boutique', 'Conference venues', 'Destination management', 'Corporate events', 'Wedding planning', 'Chef', 'leisure', 'Banquet'];
        
        return User::select('id', 'firstname', 'lastname', 'slug_username', 'photo', 'totalexperience', 'views', 'featured_home')->with(['skills', 'experiences'])
        ->has('stories')
        ->has('sociallinks')
        ->has('skills')
        ->has('tools')
        ->has('attributes')
        ->has('experiences')
        ->has('educations')
        ->where('featured_home', 'Yes')
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('industries', function ($query) use ($keyword) {
                          $query->where('industry', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('attributes', function ($query) use ($keyword) {
                          $query->where('attribute', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('stories', function ($query) use ($keyword) {
                          $query->where('title', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('educations', function ($query) use ($keyword) {
                          $query->where('degree', 'like', '%' . $keyword . '%');
                      });
            }
        })
        ->orderBy('views', 'desc')
        ->limit($limit)
        ->get();
    }
    
    
// ######################################################
// Getting Club Members - Architect
// ######################################################
    
    public function getClubMembersArchitect($limit)
    {
        
        $keywords = ['Designer', 'Autocad', 'Interior', 'Architect', 'Residential design', 'Commercial architecture', 'Urban planning', 'Sustainable design', 'Space planning', 'Building design', 'Architectural rendering', 'CAD', 'Computer-Aided Design', '3D modeling', 'Architectural visualization', 'Lighting design', 'Landscape architecture', 'Historic preservation', 'Project management', 'Construction management', 'Renovation', 'Modern architecture', 'Contemporary interiors', 'Design consultancy', 'Structural engineering', 'Green building', 'Eco-friendly design', 'Furniture design', 'Project coordination', 'Color theory', 'Material selection', 'Residential interiors'];
        
        return User::select('id', 'firstname', 'lastname', 'slug_username', 'photo', 'totalexperience', 'views', 'featured_home')->with(['skills', 'experiences'])
        ->has('stories')
        ->has('sociallinks')
        ->has('skills')
        ->has('tools')
        ->has('attributes')
        ->has('experiences')
        ->has('educations')
        ->where('featured_home', 'Yes')
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('industries', function ($query) use ($keyword) {
                          $query->where('industry', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('attributes', function ($query) use ($keyword) {
                          $query->where('attribute', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('stories', function ($query) use ($keyword) {
                          $query->where('title', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('educations', function ($query) use ($keyword) {
                          $query->where('degree', 'like', '%' . $keyword . '%');
                      });
            }
        })
        ->orderBy('views', 'desc')
        ->limit($limit)
        ->get();
    }
    
    
    
// ######################################################
// Getting Club Members - Education Counsellors
// ######################################################
    
    public function getClubMembersCounsellors($limit)
    {
        
        $keywords = ['Counseling', 'Education', 'College', 'Admission', 'Academic', 'Study Abroad', 'Student Development', 'Educational Planning', 'Test Preparation', 'Study Skills', 'Higher Education', 'Career Pathways', 'Scholarship Guidance', 'Entrance Exam Coaching', 'Personal Growth', 'Emotional Well-being', 'Time Management', 'Learning Strategies', 'Student Advocacy', 'Interpersonal Skills', 'Communication Coaching', 'Parent Communication'];
        
        return User::select('id', 'firstname', 'lastname', 'slug_username', 'photo', 'totalexperience', 'views', 'featured_home')->with(['skills', 'experiences'])
        ->has('stories')
        ->has('sociallinks')
        ->has('skills')
        ->has('tools')
        ->has('attributes')
        ->has('experiences')
        ->has('educations')
        ->where('featured_home', 'Yes')
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('industries', function ($query) use ($keyword) {
                          $query->where('industry', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('attributes', function ($query) use ($keyword) {
                          $query->where('attribute', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('stories', function ($query) use ($keyword) {
                          $query->where('title', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('educations', function ($query) use ($keyword) {
                          $query->where('degree', 'like', '%' . $keyword . '%');
                      });
            }
        })
        ->orderBy('views', 'desc')
        ->limit($limit)
        ->get();
    }
    
    
// ######################################################
// Getting Club Members - Sports
// ######################################################
    
    public function getClubMembersSports($limit)
    {
        
        $keywords = ['Sport', 'Athlete', 'Fitness', 'Cricket', 'Hockey', 'Football', 'Archery', 'Strength', 'Artistic Swimming', 'Badminton', 'Baseball', 'Basketball', 'Bowls', 'Boxing', 'Canoeing', 'Skating', 'Sports Performance', 'Training', 'Physical Endurance', 'Team Captain', 'Weight Loss Programs', 'Bodybuilding', 'Group Fitness Instructor', 'Cardiovascular', 'HIIT', 'Event Planning', 'Tournament Organization', 'Sponsorship Coordination', 'Paralympic'];
        
        return User::select('id', 'firstname', 'lastname', 'slug_username', 'photo', 'totalexperience', 'views', 'featured_home')->with(['skills', 'experiences'])
        ->has('stories')
        ->has('sociallinks')
        ->has('skills')
        ->has('tools')
        ->has('attributes')
        ->has('experiences')
        ->has('educations')
        ->where('featured_home', 'Yes')
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('industries', function ($query) use ($keyword) {
                          $query->where('industry', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('attributes', function ($query) use ($keyword) {
                          $query->where('attribute', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('stories', function ($query) use ($keyword) {
                          $query->where('title', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('educations', function ($query) use ($keyword) {
                          $query->where('degree', 'like', '%' . $keyword . '%');
                      });
            }
        })
        ->orderBy('views', 'desc')
        ->limit($limit)
        ->get();
    }
    
// ######################################################
// Getting Club Members - LegalFinancial
// ######################################################
    
    public function getClubMembersLegalFinancial($limit)
    {
        
        $keywords = ['Law', 'Legal', 'Real Estate', 'Advisory', 'Invest', 'Investment', 'Financial', 'Stock Market', 'Tax', 'Litigation', 'Compliance', 'Property', 'Dispute Resolution', 'Arbitration', 'Mediation', 'Criminal Defense', 'Regulatory Affair', 'Wealth Management', 'Retirement Planning', 'Investment Strategies', 'Financial Planning', 'Risk Management', 'Asset Allocation', 'Tax Planning', 'Portfolio Management', 'Tax Optimization', 'Budgeting', 'Debt Management', 'Financial Analysis', 'Mutual Funds', 'Insurance Advisory', 'Financial Modeling', 'Financial Reporting', 'Corporate Finance', 'Credit Management', 'Property Valuation ', 'Market Analysis', 'Property Management ', 'Lease Negotiation ', 'Property Sales', 'Property Taxation', 'Property Appraisal', 'Tenant Relations', 'Commercial Leasing ', 'Urban Planning', 'Rent', 'Broker', 'Property', 'Dealer'];
        
        return User::select('id', 'firstname', 'lastname', 'slug_username', 'photo', 'totalexperience', 'views', 'featured_home')->with(['skills', 'experiences'])
        ->has('stories')
        ->has('sociallinks')
        ->has('skills')
        ->has('tools')
        ->has('attributes')
        ->has('experiences')
        ->has('educations')
        ->where('featured_home', 'Yes')
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('industries', function ($query) use ($keyword) {
                          $query->where('industry', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('attributes', function ($query) use ($keyword) {
                          $query->where('attribute', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('stories', function ($query) use ($keyword) {
                          $query->where('title', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('educations', function ($query) use ($keyword) {
                          $query->where('degree', 'like', '%' . $keyword . '%');
                      });
            }
        })
        ->orderBy('views', 'desc')
        ->limit($limit)
        ->get();
    }
    
    
// ######################################################
// Getting Club Members - Practitioner
// ######################################################
    
    public function getClubMembersPractitioners ($limit)
    {
        
        $keywords = ['Private Tutor', 'Doctor', 'Teacher', 'Reporter', 'Anchor', 'Consultant', 'Practitioner', 'Journalist', 'Dentist', 'Online English Tutor', 'General Practitioner', 'Education Expert ', 'Clinical Psychologist', 'Journalism Services ', 'TV Presenter', 'Medical Expert', 'Health Specialist', 'Nurse', 'Scientist', 'Researcher', 'Counselor', 'Psychiatrist', 'Psychotherapist', 'dietitian', 'Nutritionist', 'educator', 'Acupuncturist'];
        
        return User::select('id', 'firstname', 'lastname', 'slug_username', 'photo', 'totalexperience', 'views', 'featured_home')->with(['skills', 'experiences'])
        ->has('stories')
        ->has('sociallinks')
        ->has('skills')
        ->has('tools')
        ->has('attributes')
        ->has('experiences')
        ->has('educations')
        ->where('featured_home', 'Yes')
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('industries', function ($query) use ($keyword) {
                          $query->where('industry', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('attributes', function ($query) use ($keyword) {
                          $query->where('attribute', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('stories', function ($query) use ($keyword) {
                          $query->where('title', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('educations', function ($query) use ($keyword) {
                          $query->where('degree', 'like', '%' . $keyword . '%');
                      });
            }
        })
        ->orderBy('views', 'desc')
        ->limit($limit)
        ->get();
    }
    
    
       
// ######################################################
// Getting Club Members - Advisors
// ######################################################
    
    public function getClubMembersAdvisors($keywords)
    {
        return User::with([
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
        ->where('featured_home', 'Yes')
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('industries', function ($query) use ($keyword) {
                          $query->where('industry', 'like', '%' . $keyword . '%');
                      });
            }
        })
        ->orderBy('views', 'desc')
        ->get();
    }
    
    
    
    
    public function MainPageData()
    {
        try {
            
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
                
                if (!empty($_SESSION['email'])) {
                    if (!isset($_SESSION['club_userid'])) {
                        return redirect('https://www.wahstory.com/users/');
                    }
                }
            }
            
    
            // Fetch data
            // $users = $this->getUsers(10);
            
            $users = $this->getClubMembersProfessionals(10);
    
            if ($users->isEmpty()) {
                return view('mainpage')->with('message', 'No Users Found');
            }
    
            $loggedinUser = null;
            if (!empty($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $loggedinUser = User::where('email', $email)->first();
            }
    
            $FoundersCatUsers = $this->getClubMembersFounders(10);
            
            $InfluencersCatUsers = $this->getClubMembersInfluencersBloggers(15);
            
            $WellnessCatUsers = $this->getClubMembersWellness(10);
            
            $CoachCatUsers = $this->getClubMembersCoaches(10);
            
            $MarketingCatUsers = $this->getClubMembersMarketing(10);
            
            $HospitalityCatUsers = $this->getClubMembersHospitality(10);
            
            $ArchitectCatUsers = $this->getClubMembersArchitect(10);
            
            $eduCounsellorCatUsers = $this->getClubMembersCounsellors(10);
            
            $SportsCatUsers = $this->getClubMembersSports(10);
            
            $LegalFinancialCatUsers = $this->getClubMembersLegalFinancial(10);
            
            $PractitionersCatUsers = $this->getClubMembersPractitioners(10);
            
            
            //Connections 
            $connections = $this->getConnections($loggedinUser, $users);
            $FounderConnections = $this->getConnections($loggedinUser, $FoundersCatUsers);
            $InfluencerConnections = $this->getConnections($loggedinUser, $InfluencersCatUsers);
            $WellnessConnections = $this->getConnections($loggedinUser, $WellnessCatUsers);
            $CoachConnections = $this->getConnections($loggedinUser, $CoachCatUsers);
            $MarketingConnections = $this->getConnections($loggedinUser, $MarketingCatUsers);
            $HospitalityConnections = $this->getConnections($loggedinUser, $HospitalityCatUsers);
            $ArchitectConnections = $this->getConnections($loggedinUser, $ArchitectCatUsers);
            $eduCounsellorConnections = $this->getConnections($loggedinUser, $eduCounsellorCatUsers);
            $SportsConnections = $this->getConnections($loggedinUser, $SportsCatUsers);
            $LegalFinancialConnections = $this->getConnections($loggedinUser, $LegalFinancialCatUsers);
            $PractitionerConnections = $this->getConnections($loggedinUser, $PractitionersCatUsers);
            
            
            
             $TopSkills = Skill::withCount('users')
                        ->orderBy('users_count', 'desc')     
                        ->take(6)                           
                        ->get();
            
             $TopTools = Tool::withCount('users')
                        ->orderBy('users_count', 'desc')     
                        ->take(6)                           
                        ->get();
            
    
            return view('mainpage', compact('users', 'loggedinUser', 'connections', 'FoundersCatUsers', 'InfluencersCatUsers', 'WellnessCatUsers', 'CoachCatUsers', 'MarketingCatUsers', 'HospitalityCatUsers', 'ArchitectCatUsers', 'eduCounsellorCatUsers', 'SportsCatUsers', 'LegalFinancialCatUsers', 'PractitionersCatUsers', 'FounderConnections', 'InfluencerConnections', 'WellnessConnections', 'CoachConnections', 'MarketingConnections', 'HospitalityConnections', 'ArchitectConnections', 'eduCounsellorConnections', 'SportsConnections', 'LegalFinancialConnections', 'PractitionerConnections', 'TopSkills', 'TopTools')); 
            
        } catch (\Exception $e) {
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
            return view('mainpage')->with('error', 'An error occurred while getting Connection.');
        }
        
    }
    
    
    public function getAllUsers(Request $request)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        $chunkSize = 8;  // Define the number of users per page
    
        // Fetch users with paginate
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
        ->paginate($chunkSize);
    
        $loggedinUser = null;
        $connections = [];
    
        if (!empty($_SESSION['email'])) {
            $email = $_SESSION['email'];
            $loggedinUser = User::where('email', $email)->first();
        }
    
        if ($loggedinUser) {
            foreach ($users as $member) {
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
            // Return partial view with the users and pagination data
            return response()->json([
                'view' => view('partials.user-list', compact('users', 'loggedinUser', 'connections'))->render(),
                'next_page' => $users->nextPageUrl(),
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
            ]);
        }
    
        return view('showallusers', [
            'users' => $users,
            'loggedinUser' => $loggedinUser,
            'connections' => $connections,
        ]);
    }
     
    
  public function getUserswithSearch(Request $request)
{
        if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
    $search = $request->input('search');  // Get search term, e.g., "Sparsh Sharma"

    
    
        $users = User::search($search)->get();

        $users->load([
            'stories',
            'experiences',
            'skills',
            'tools',
            'sociallinks',
            'attributes',
            'educations'
        ]);
        
        // Then optionally filter in PHP:
        $filtered = $users->filter(function ($user) {
            return $user->stories !== null
                && $user->experiences->isNotEmpty()
                && $user->skills->isNotEmpty()
                && $user->tools->isNotEmpty()
                && $user->sociallinks->isNotEmpty()
                && $user->attributes->isNotEmpty()
                && $user->educations->isNotEmpty();
        });
    
    
    $loggedinUser = null;
    $connections = [];

    if (!empty($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $loggedinUser = User::where('email', $email)->first();
    }

    if ($loggedinUser) {
        foreach ($filtered as $member) {
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
    
    

    return view('search-results', 
        [   
            'users' => $filtered,
            'loggedinUser' => $loggedinUser,
            'connections' => $connections,
        ]);
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

    public function getalltimezones(){
        
        $timezones = Timezone::all();  
        
        $availabilities = Availability::all();
        
        return view('test', compact('timezones', 'availabilities'));
        
    }
    public function updateTimezone(Request $request)
    {
        $timezone = $request->input('Usertimezone');
        
        session()->forget('User_Selected_Timezone');
        
        session(['User_Selected_Timezone' => $timezone]);
        return redirect()->route('test')->with('timezone', $timezone);
    }
    
    
    
}
