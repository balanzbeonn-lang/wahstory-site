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

class CategoryController extends Controller
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
    
    
    // ######################################################
    // Getting Club Members - Founders
    // ######################################################
    
    public function getClubMembersFounders($limit)
    {
        $chunkSize = 8;
        
        $keywords = ['Entrepreneur', 'Founder', 'Co-Founder', 'CEO', 'Chief Operating Officer', 'COO', 'Director', 'Managing Director', 'Owner', 'President', 'Principal', 'Corporate Founder', 'Chief Executive Officer', 'Chief Visionary Officer', 'CVO', 'Chief Technology Officer', 'CTO', 'Chief Strategy Officer', 'CSO', 'Founding Partner', 'Chief Marketing Officer', 'CMO', 'General Partner', 'Managing Partner', 'Business Owner', 'Principal Founder', 'Chief Visionary', 'Angel investor', 'Innovator', 'startup', 'investor'];
        
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
        ->paginate($chunkSize);
        
        
    }
    
    // ######################################################
// Getting Club Members - Influencers & Artist
// ######################################################
    
    public function getClubMembersInfluencersBloggers($limit)
    {   
        $chunkSize = 8;
        
        $keywords = ['Influencer', 'Community', 'Vlogger', 'Blogger', 'Podcaster', 'Brand', 'collab', 'follower', 'influential', 'Sponser', 'Brand Ambassador', 'Online Personality', 'Blog Writer', 'Podcast Host', 'Live Streamer', 'Unboxing Expert', 'Female Empowerment Advocate', 'Lifestyle Enthusiast', 'Sponsored Posts', 'Affiliate', 'enthusiast', 'influence', 'storyteller', 'Product Review', 'Collaboration', 'Photographer', 'Videographer', 'Photojournalist', 'Creative Consultant', 'TikTok Creator', 'X Expert', 'Dancer', 'Model', 'Musician', 'Magician', 'Singer', 'Composer', 'Painter', 'Artist', 'Makeup', 'Hair', 'Stylist', 'performer', 'actor', 'actress', 'pageant', 'Beauty Queen', 'Beauty pageant', 'Mrs. Universe', 'Mr. Universe', 'Film', 'Media', 'Comedian', 'Producer', 'Internet Personality', 'acting', 'Comedy'];
        
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
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('skills', function ($query) use ($keyword) {
                          $query->where('skill', 'like', '%' . $keyword . '%');
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
        ->paginate($chunkSize);
    }
    
    // ######################################################
// Getting Club Members - Wellness
// ######################################################
    
    public function getClubMembersWellness($limit)
    {
        $chunkSize = 8;
        
        $keywords = ['Wellness', 'Meditation', 'Yoga', 'Mindfulness', 'Hatha', 'Vinyasa', 'Shtanga', 'Nutritional', 'Nutrition', 'Sleep Coaching', 'Fitness',  'Training', 'Stress', 'Ayurvedic', 'Holistic', 'Health', 'Healing', 'Well-being Group', 'Life Balance', 'Self-Care', 'Active Lifestyle', 'Pilates Classes', 'Running Group', 'Exercise', 'Weight Loss', 'Workout', 'Anxiety Support', 'Depression Support', 'Mindset Coaching', 'Positive Psychology', 'Self-Love', 'Cognitive Behavioral Therapy', 'Mental Clarity', 'Personal Growth ', 'Herbal Medicine', 'Chakra Balancing', 'Acupuncture Support', 'Detox & Cleansing', 'Clean Eating', 'Plant-Based Diet', 'Keto Lifestyle', 'Gluten-Free Living', 'Healthy', 'Dietary Support', 'Food as Medicine', 'Superfoods', 'Self-Improvement', 'Personal Development', 'Empowerment Support', 'Lifestyle Transformation', 'Life Coaching', 'Accountability Partner', 'Progress Tracking', 'Personal Transformation', 'Inner Peace', 'Positive Mindset', 'Empowerment Network', 'Confidence Building', 'Mindful Living'];
        
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
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('skills', function ($query) use ($keyword) {
                          $query->where('skill', 'like', '%' . $keyword . '%');
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
        ->paginate($chunkSize);
    }
    
    
    // ######################################################
// Getting Club Members - Coaches
// ######################################################
    
    public function getClubMembersCoaches($limit)
    {
        $chunkSize = 8;
        
        $keywords = ['Coaching', 'Coach', 'Tutoring', 'Public Speaking', 'Speaking', 'Speaker', 'advisor', 'therapist', 'mentor', 'trainer', 'consultant', 'Goal-setting'];
        
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
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('skills', function ($query) use ($keyword) {
                          $query->where('skill', 'like', '%' . $keyword . '%');
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
        ->paginate($chunkSize);
    }
    
    // ######################################################
// Getting Club Members - Marketing
// ######################################################
    
    public function getClubMembersMarketing($limit)
    {
        $chunkSize = 8;
        
        $keywords = ['SEM', 'SEO', 'Marketing', 'Digital Marketing', 'Advertising', 'Advertisement', 'Search Engine', 'Social media', 'PPC', 'Pay Per Click', 'Online branding', 'Google Ads', 'Facebook Ads', 'Web analytics', 'Conversion rate optimization', 'Growth hacking', 'Content strategy', 'Brand awareness', 'Online reputation management', 'Retargeting campaigns', 'Lead generation', 'Creator', 'Podcaster', 'Advertising', 'Content Creation', 'Brand Ambassador', 'Online Personality', 'Blog Writer', 'Podcast Host', 'Blogger & Writer', 'Product Reviews', 'Collaboration Specialist', 'Content Collaboration', 'Campaign Manager', 'PR & Brand Relations', 'Videographer', 'Graphic Designer', 'Storyteller', 'Photojournalist', 'Brand Strategist', 'Content Strategist', 'Creative Consultant ', 'Colorful Content', 'Editor', 'Web Designer', 'Web Developer', 'Full Stack', 'Html', 'Website', 'Application', 'Frontend', 'Backend', 'PHP Developer', 'Tech Lead', 'Team Leader', 'Tech Team', 'Freelance', 'Project Manager'];
        
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
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('skills', function ($query) use ($keyword) {
                          $query->where('skill', 'like', '%' . $keyword . '%');
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
        ->paginate($chunkSize);
    }
    
    
// ######################################################
// Getting Club Members - Hospitality
// ######################################################
    
    public function getClubMembersHospitality($limit)
    {
        $chunkSize = 8;
        
        $keywords = ['Hospitality', 'Luxury', 'Hotel', 'Restaurant', 'Resort', 'Spa', 'Event planning', 'venue', 'Guest services', 'Front desk operations', 'Concierge services', 'Travel and tourism', 'Food and beverage', 'Boutique', 'Conference venues', 'Destination management', 'Corporate events', 'Wedding planning', 'Chef', 'leisure', 'Banquet'];
        
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
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('skills', function ($query) use ($keyword) {
                          $query->where('skill', 'like', '%' . $keyword . '%');
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
        ->paginate($chunkSize);
    }
    
    
// ######################################################
// Getting Club Members - Architect
// ######################################################
    
    public function getClubMembersArchitect($limit)
    {
        $chunkSize = 8;
        
        $keywords = ['Designer', 'Autocad', 'Interior', 'Architect', 'Residential design', 'Commercial architecture', 'Urban planning', 'Sustainable design', 'Space planning', 'Building design', 'Architectural rendering', 'CAD', 'Computer-Aided Design', '3D modeling', 'Architectural visualization', 'Lighting design', 'Landscape architecture', 'Historic preservation', 'Project management', 'Construction management', 'Renovation', 'Modern architecture', 'Contemporary interiors', 'Design consultancy', 'Structural engineering', 'Green building', 'Eco-friendly design', 'Furniture design', 'Project coordination', 'Color theory', 'Material selection', 'Residential interiors'];
        
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
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('skills', function ($query) use ($keyword) {
                          $query->where('skill', 'like', '%' . $keyword . '%');
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
        ->paginate($chunkSize);
    }
    
    
    
// ######################################################
// Getting Club Members - Education Counsellors
// ######################################################
    
    public function getClubMembersCounsellors($limit)
    {
        $chunkSize = 8;
        
        $keywords = ['Counseling', 'Education', 'College', 'Admission', 'Academic', 'Study Abroad', 'Student Development', 'Educational Planning', 'Test Preparation', 'Study Skills', 'Higher Education', 'Career Pathways', 'Scholarship Guidance', 'Entrance Exam Coaching', 'Personal Growth', 'Emotional Well-being', 'Time Management', 'Learning Strategies', 'Student Advocacy', 'Interpersonal Skills', 'Communication Coaching', 'Parent Communication'];
        
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
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('skills', function ($query) use ($keyword) {
                          $query->where('skill', 'like', '%' . $keyword . '%');
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
        ->paginate($chunkSize);
    }
    
    
// ######################################################
// Getting Club Members - Sports
// ######################################################
    
    public function getClubMembersSports($limit)
    {
        $chunkSize = 8;
        
        $keywords = ['Sports', 'Athlete', 'Fitness', 'Cricket', 'Hockey', 'Football', 'Archery', 'Strength', 'Artistic Swimming', 'Badminton', 'Baseball', 'Basketball', 'Bowls', 'Boxing', 'Canoeing', 'Skating', 'Sports Performance', 'Training', 'Physical Endurance', 'Team Captain', 'Weight Loss Programs', 'Bodybuilding', 'Group Fitness Instructor', 'Cardiovascular', 'HIIT', 'Event Planning', 'Tournament Organization', 'Sponsorship Coordination', 'Paralympic'];
        
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
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('skills', function ($query) use ($keyword) {
                          $query->where('skill', 'like', '%' . $keyword . '%');
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
        ->paginate($chunkSize);
    }
    
// ######################################################
// Getting Club Members - LegalFinancial
// ######################################################
    
    public function getClubMembersLegalFinancial($limit)
    {
        $chunkSize = 8;
        
        $keywords = ['Law', 'Legal', 'Real Estate', 'Advisory', 'Invest', 'Investment', 'Financial', 'Stock Market', 'Tax', 'Litigation', 'Compliance', 'Property', 'Dispute Resolution', 'Arbitration', 'Mediation', 'Criminal Defense', 'Regulatory Affair', 'Wealth Management', 'Retirement Planning', 'Investment Strategies', 'Financial Planning', 'Risk Management', 'Asset Allocation', 'Tax Planning', 'Portfolio Management', 'Tax Optimization', 'Budgeting', 'Debt Management', 'Financial Analysis', 'Mutual Funds', 'Insurance Advisory', 'Financial Modeling', 'Financial Reporting', 'Corporate Finance', 'Credit Management', 'Property Valuation ', 'Market Analysis', 'Property Management ', 'Lease Negotiation ', 'Property Sales', 'Property Taxation', 'Property Appraisal', 'Tenant Relations', 'Commercial Leasing ', 'Urban Planning', 'Rent', 'Broker', 'Property', 'Dealer'];
        
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
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('skills', function ($query) use ($keyword) {
                          $query->where('skill', 'like', '%' . $keyword . '%');
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
        ->paginate($chunkSize);
    }
    
    
// ######################################################
// Getting Club Members - Practitioner
// ######################################################
    
    public function getClubMembersPractitioners($limit)
    {
        $chunkSize = 8;
        
        $keywords = ['Private Tutor', 'Doctor', 'Teacher', 'Reporter', 'Anchor', 'Consultant', 'Practitioner', 'Journalist', 'Dentist', 'Online English Tutor', 'General Practitioner', 'Education Expert ', 'Clinical Psychologist', 'Journalism Services ', 'TV Presenter', 'Medical Expert', 'Health Specialist', 'Nurse', 'Scientist', 'Researcher', 'Counselor', 'Psychiatrist', 'Psychotherapist', 'dietitian', 'Nutritionist', 'educator', 'Acupuncturist'];
        
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
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('firstname', 'like', '%' . $keyword . '%')
                      ->orWhere('lastname', 'like', '%' . $keyword . '%')
                      ->orWhereHas('experiences', function ($query) use ($keyword) {
                          $query->where('company_name', 'like', '%' . $keyword . '%')
                          ->orWhere('role', 'like', '%' . $keyword . '%');
                      })
                      ->orWhereHas('skills', function ($query) use ($keyword) {
                          $query->where('skill', 'like', '%' . $keyword . '%');
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
        ->paginate($chunkSize);
    }
    
    
    
    public function getUsersbySingleCategory($category, Request $request)
    {   
      
        try {
            
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
             
            
            if ($category == "founders" || $category == "founders-entrepreneurs") {
                
                $users = $this->getClubMembersFounders(8);    
            
            } else if ($category == "influencers" || $category == "bloggers" || $category == "influencers-bloggers" || $category == "influencers-artists") {
                
                $users = $this->getClubMembersInfluencersBloggers(8);    
            
            } else if ($category == "wellness") {
                $users = $this->getClubMembersWellness(8);
                
            } else if ($category == "coaches") {
                
                $users = $this->getClubMembersCoaches(8);
                
            } else if ($category == "marketing") { 
                
                $users = $this->getClubMembersMarketing(8);
                
            } else if ($category == "hospitality") { 
                
                $users = $this->getClubMembersHospitality(8);
                
            } else if ($category == "architects-designers") { 
                
                $users = $this->getClubMembersArchitect(8);
                
            } else if ($category == "education-counsellors") { 
                
                $users = $this->getClubMembersCounsellors(8);
                
            } else if ($category == "sports") { 
                
                $users = $this->getClubMembersSports(8);
                
            } else if ($category == "legal-financial-experts") { 
                
                $users = $this->getClubMembersLegalFinancial(8);
                
            } else if ($category == "practitioners") { 
                
                $users = $this->getClubMembersPractitioners(8);
                
            } else {
                
                $users = $this->getAllUsers(8);
            }
            
            
            $loggedinUser = null;
            if (!empty($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $loggedinUser = User::where('email', $email)->first();
            }
            
            $connections = $this->MainController->getConnections($loggedinUser, $users);
             
            
            $categorytitle = $category;
            
            
            $allskills = Skill::all();  
              
            if ($request->ajax()) {
            // Return partial view with the users and pagination data
            return response()->json([
                'view' => view('partials.user-list', compact('users', 'loggedinUser', 'connections', 'allskills', 'categorytitle'))->render(),
                'next_page' => $users->nextPageUrl(),
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
            ]);
        }
    
        return view('singlecat', [
            'users' => $users,
            'loggedinUser' => $loggedinUser,
            'connections' => $connections,
            'allskills' => $allskills,
            'categorytitle' => $category,
            'message' => $users->isEmpty() ? 'No Users Found' : null,
        ]);
            
            
            
            
        } catch (\Exception $e) { 
            
            return view('singlecat')->with('error', 'An error occurred while fetching users.')->with('users', collect());  
        }
    }
    
    
}
