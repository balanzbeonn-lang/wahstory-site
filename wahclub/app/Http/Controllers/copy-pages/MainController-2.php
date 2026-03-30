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
// Getting Club Members - Founders
// ######################################################
    
    public function getClubMembersFounders($limit)
    {
        
        $keywords = ['Entrepreneur', 'Founder', 'Co-Founder', 'CEO', 'Chief Operating Officer', 'COO', 'Director', 'Managing Director', 'Owner', 'President', 'Principal', 'Corporate Founder', 'Chief Executive Officer', 'Chief Visionary Officer', 'CVO', 'Chief Technology Officer', 'CTO', 'Chief Strategy Officer', 'CSO', 'Founding Partner', 'Chief Marketing Officer', 'CMO', 'General Partner', 'Managing Partner', 'Business Owner', 'Principal Founder', 'Head of Operations', 'Chief Visionary'];
        
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
        ->limit($limit)
        ->get();
    }
    
// ######################################################
// Getting Club Members - Influencers & Bloggers
// ######################################################
    
    public function getClubMembersInfluencersBloggers($limit)
    {   
        
        $keywords = ['Influencer', 'Community', 'Vlogger', 'Blogger', 'Creator', 'Podcaster', 'Advertising', 'Social Media', 'Content Strategy', 'Content Creation', 'Social Media Marketing', 'Content Creator', 'Brand Ambassador', 'Social Media Strategist', 'Online Personality', 'Content Marketing Specialist', 'Video Content Creator', 'Blog Writer', 'Podcast Host', 'Blogger & Writer', 'Live Streamer', 'Unboxing Expert', 'Female Empowerment Advocate', 'Lifestyle Enthusiast', 'Sponsored Posts', 'Affiliate Marketing Expert', 'Brand Partnerships', 'Product Reviews', 'Collaboration Specialist', 'Content Collaboration', 'Campaign Manager', 'Social Media Advertising', 'PR & Brand Relations', 'Photographer & Content Creator', 'Videographer & Editor', 'Graphic Designer', 'Visual Storyteller', 'Social Media Designer', 'Photojournalist', 'Brand Strategist', 'Digital Marketing Expert', 'Social Media Consultant', 'Content Strategist', 'Creative Consultant ', 'Bold & Colorful Content', 'TikTok Creator', 'X Expert'];
        
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
        ->limit($limit)
        ->get();
    }
    
// ######################################################
// Getting Club Members - Wellness
// ######################################################
    
    public function getClubMembersWellness($limit)
    {
        
        $keywords = ['Wellness', 'Meditation', 'Yoga', 'Mindfulness', 'Hatha', 'Vinyasa', 'Shtanga', 'Nutritional', 'Sleep Coaching', 'Fitness Training', 'Personal Training', 'Stress Management', 'Holistic Health Coaching', 'Holistic Health Community ', 'Well-being Group', 'Health Optimization', 'Life Balance Program', 'Mindfulness Community', 'Self-Care Network', 'Healthy Living Group', 'Fitness Group', 'Fitness Support Network', 'Active Lifestyle Community', 'Strength Training Group', 'Yoga Classes', 'Pilates Classes', 'Running Group', 'Fitness Bootcamp', 'Group Exercise Classes', 'Weight Loss Group', 'Healthy Lifestyle Coaching', 'Fitness Enthusiast Network', 'Personal Training Community', 'Workout Support Group ', 'Mental Health Support Group', 'Stress Relief Network', 'Mindfulness Meditation Circle ', 'Anxiety Support Group', 'Depression Support Group', 'Mindset Coaching Community', 'Positive Psychology Group', 'Self-Love Support Group', 'Emotional Well-being Network', 'Cognitive Behavioral Therapy (CBT) Group', 'Mental Clarity Network', 'Personal Growth Network ', 'Holistic Health Group ', 'Alternative Healing Community', 'Ayurvedic Health Group', 'Herbal Medicine Network', 'Energy Healing Group', 'Chakra Balancing Community', 'Reiki Healing Network', 'Acupuncture Support Group', 'Crystal Healing Community', 'Detox & Cleansing Group', 'Holistic Lifestyle Support ', 'Healthy Eating Group', 'Clean Eating Community', 'Weight Loss Support', 'Plant-Based Diet Group', 'Vegan Nutrition Network', 'Keto Lifestyle Group', 'Gluten-Free Living Community', 'Nutrition Coaching Program', 'Healthy Meal Planning Network', 'Dietary Support Group', 'Food as Medicine Community', 'Superfoods Group ', 'Self-Care Group', 'Life Balance Community', 'Self-Improvement Circle ', 'Self-Care Practices Network', 'Personal Development Group', 'Empowerment Support Network', 'Lifestyle Transformation Group', 'Stress-Free Living Network', 'Life Coaching Program', 'Meditation Practice Community', 'Sleep Health Support   ', 'Fitness for Moms ', 'Accountability Partner Network', 'Health Coaching Support ', 'Progress Tracking Network', 'Healthy Lifestyle Support ', 'Personal Transformation Group', 'Inner Peace Support', 'Personal Growth Circle', 'Positive Mindset Community', 'Empowerment Network', 'Confidence Building Group', 'Mindful Living Support'];
        
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
        ->limit($limit)
        ->get();
    }
    
    
// ######################################################
// Getting Club Members - Coaches
// ######################################################
    
    public function getClubMembersCoaches($limit)
    {
        
        $keywords = ['Coaching', 'Coach', 'Tutoring', 'Public Speaking', 'Speaking'];
        
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
        ->limit($limit)
        ->get();
    }
    
// ######################################################
// Getting Club Members - Marketing
// ######################################################
    
    public function getClubMembersMarketing($limit)
    {
        
        $keywords = ['SEM', 'SEO', 'Marketing', 'Digital Marketing', 'Advertising', 'Advertisement', 'Search Engine', 'Social media marketer', 'PPC', 'Pay Per Click', 'Online branding', 'Google Ads', 'Facebook Ads', 'Web analytics', 'Conversion rate optimization', 'Growth hacking', 'Content strategy', 'Brand awareness', 'Online reputation management', 'Retargeting campaigns', 'Lead generation'];
        
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
        ->limit($limit)
        ->get();
    }
    
    
// ######################################################
// Getting Club Members - Hospitality
// ######################################################
    
    public function getClubMembersHospitality($limit)
    {
        
        $keywords = ['Hospitality', 'Hotel', 'Restaurant design', 'Resort planning', 'Event planning', 'Guest services', 'Front desk operations', 'Concierge services', 'Luxury hotels ', 'Travel and tourism', 'Property management', 'Food and beverage management', 'Hotel marketing ', 'Hotel operations', 'Resort architecture', 'Spa design', 'Hotel renovation', 'Boutique hotels', 'Conference venues', 'Interior design for hotels', 'Destination management', 'Corporate events', 'Hotel interior styling', 'Event venue design', 'Wedding planning'];
        
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
        ->limit($limit)
        ->get();
    }
    
    
// ######################################################
// Getting Club Members - Architect
// ######################################################
    
    public function getClubMembersArchitect($limit)
    {
        
        $keywords = ['Designer', 'Interior', 'Architect', 'Residential design', 'Commercial architecture', 'Urban planning', 'Sustainable design', 'Space planning', 'Building design', 'Architectural rendering', 'CAD design', 'Computer-Aided Design', '3D modeling', 'Architectural visualization', 'Lighting design', 'Landscape architecture', 'Historic preservation', 'Project management', 'Construction management', 'Renovation', 'Modern architecture', 'Contemporary interiors', 'Design consultancy', 'Structural engineering', 'Green building', 'Eco-friendly design', 'Furniture design', 'Project coordination', 'Color theory', 'Material selection', 'Residential interiors'];
        
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
        ->limit($limit)
        ->get();
    }
    
    
    
// ######################################################
// Getting Club Members - Education Counsellors
// ######################################################
    
    public function getClubMembersCounsellors($limit)
    {
        
        $keywords = ['Counseling', 'College', 'Admission', 'Academic', 'Study Abroad', 'Student Development', 'College Admissions', 'Educational Planning ', 'Test Preparation ', 'Study Skills', 'Higher Education Advising', 'Academic Support ', 'Career Pathways', 'Scholarship Guidance', 'Entrance Exam Coaching', 'Personal Growth Support', 'Emotional Well-being Support', 'Time Management', 'Learning Strategies', 'Student Advocacy ', 'Mentoring', 'Interpersonal Skills', 'Communication Coaching', 'Parent Communication ', 'Study Abroad Guidance'];
        
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
        ->limit($limit)
        ->get();
    }
    
    
// ######################################################
// Getting Club Members - Sports
// ######################################################
    
    public function getClubMembersSports($limit)
    {
        
        $keywords = ['Sports', 'Athlete', 'Fitness', 'Cricket', 'Hockey', 'Football', 'Archery', 'Artistic Swimming', 'Badminton', 'Baseball', 'Basketball', 'Bowls', 'Boxing', 'Canoeing', 'Skating', 'Sports Performance', 'Elite Training', 'Physical Endurance', 'Team Captain', 'Personal Training', 'Strength Training', 'Fitness Coaching', 'Weight Loss Programs', 'Bodybuilding', 'Group Fitness Instructor', 'Cardiovascular Training', 'Flexibility Training', 'High-Intensity Interval Training', 'HIIT', 'Fitness Assessment', 'Event Planning', 'Tournament Organization', 'Sponsorship Coordination', 'Paralympic Training'];
        
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
        ->limit($limit)
        ->get();
    }
    
// ######################################################
// Getting Club Members - LegalFinancial
// ######################################################
    
    public function getClubMembersLegalFinancial($limit)
    {
        
        $keywords = ['Law', 'Legal', 'Real Estate', 'Advisory', 'Contract Law', 'Corporate Law ', 'Litigation', 'Compliance', 'Intellectual Property  ', 'Dispute Resolution', 'Arbitration', 'Mediation ', 'Criminal Defense ', 'Regulatory Affairs', 'Wealth Management', 'Retirement Planning', 'Investment Strategies', 'Financial Planning', 'Risk Management', 'Asset Allocation ', 'Tax Planning', 'Portfolio Management', 'Tax Optimization', 'Budgeting', 'Debt Management', 'Financial Analysis', 'Stock Market Investment', 'Mutual Funds', 'Insurance Advisory', 'Financial Modeling', 'Financial Reporting', 'Corporate Finance', 'Credit Management', 'Property Valuation ', 'Market Analysis', 'Property Management ', 'Lease Negotiation ', 'Property Sales', 'Mortgage Advisory ', 'Investment Property Consulting', 'Property Taxation ', 'Property Appraisal', 'Tenant Relations', 'Commercial Leasing ', 'Urban Planning'];
        
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
                      });
            }
        })
        ->get();
    }
    
    
    
    
    public function MainPageData()
    {
        try {
            
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
    
            // Fetch data
            $users = $this->getUsers(10);
    
            if ($users->isEmpty()) {
                return view('mainpage')->with('message', 'No Users Found');
            }
    
            $loggedinUser = null;
            if (!empty($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $loggedinUser = User::where('email', $email)->first();
            }
    
            $FoundersCatUsers = $this->getClubMembersFounders(10);
            
            $InfluencersCatUsers = $this->getClubMembersInfluencersBloggers(10);
            
            $WellnessCatUsers = $this->getClubMembersWellness(10);
            
            $CoachCatUsers = $this->getClubMembersCoaches(10);
            
            $MarketingCatUsers = $this->getClubMembersMarketing(10);
            
            $HospitalityCatUsers = $this->getClubMembersHospitality(10);
            
            $ArchitectCatUsers = $this->getClubMembersArchitect(10);
            
            $eduCounsellorCatUsers = $this->getClubMembersCounsellors(10);
            
            $SportsCatUsers = $this->getClubMembersSports(10);
            
            $LegalFinancialCatUsers = $this->getClubMembersLegalFinancial(10);
            
            
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
            
            
            
             $TopSkills = Skill::withCount('users')
                        ->orderBy('users_count', 'desc')     
                        ->take(6)                           
                        ->get();
            
             $TopTools = Tool::withCount('users')
                        ->orderBy('users_count', 'desc')     
                        ->take(6)                           
                        ->get();
            
    
            return view('mainpage', compact('users', 'loggedinUser', 'connections', 'FoundersCatUsers', 'InfluencersCatUsers', 'WellnessCatUsers', 'CoachCatUsers', 'MarketingCatUsers', 'HospitalityCatUsers', 'ArchitectCatUsers', 'eduCounsellorCatUsers', 'SportsCatUsers', 'LegalFinancialCatUsers', 'FounderConnections', 'InfluencerConnections', 'WellnessConnections', 'CoachConnections', 'MarketingConnections', 'HospitalityConnections', 'ArchitectConnections', 'eduCounsellorConnections', 'SportsConnections', 'LegalFinancialConnections', 'TopSkills', 'TopTools')); 
            
        } catch (\Exception $e) {
            return view('mainpage')->with('error', 'An error occurred while fetching users.');
        }
    }


    public function getUsersbySingleCategory($category)
    {   
      
        try {
            
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            $loggedinUser = null;
            if (!empty($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $loggedinUser = User::where('email', $email)->first();
            }
            
            
            if ($category == "founders" || $category == "founders-entrepreneurs") {
                
                $users = $this->getClubMembersFounders(20);    
            
            } else if ($category == "influencers" || $category == "bloggers" || $category == "influencers-bloggers" || $category == "influencers-artists") {
                
                $users = $this->getClubMembersInfluencersBloggers(20);
            
            } else if ($category == "wellness") {
                $users = $this->getClubMembersWellness(20);
                
            } else if ($category == "coaches") {
                
                $users = $this->getClubMembersCoaches(50);
                
            } else if ($category == "marketing") { 
                
                $users = $this->getClubMembersMarketing(50);
            } else {
                $users = $this->getUsers(10);
            }
            
            $connections = $this->getConnections($loggedinUser, $users);
             
            $allskills = Skill::all();  
             
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
    
    
    public function getUsersbySkillId($skillId)
    {   
      
        try { 
            
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            $users = User::with(['stories', 'sociallinks', 'skills', 'tools', 'attributes', 'projects', 'experiences', 'educations', 'awards', 'testimonials', 'blogs'])
                ->whereHas('skills', function ($query) use ($skillId) {
                    $query->where('skills.id', $skillId);
                })
                ->has('stories')
                ->has('sociallinks')
                ->has('skills')
                ->has('tools')
                ->has('attributes') 
                ->has('experiences')
                ->has('educations') 
                ->limit(20)
                ->get(); 
                
            $allskills = Skill::all(); 
            
            
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
            
            return view('singleskill', compact('users', 'allskills', 'loggedinUser', 'connections', 'skillId'));
            
        } catch (\Exception $e) {
            // Log the error for debugging
            // \Log::error('Error fetching users by skill: ' . $e->getMessage());
            
            return view('singleskill')->with('error', 'An error occurred while fetching users.')->with('users', collect()); 
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
        
        try { 
            
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            $loggedinUser = null;
            if (!empty($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $loggedinUser = User::where('email', $email)->first();
            }
            
            
            
            $searchTerm = $request->input('search');
    
            if ($searchTerm) {
                // If a search term is provided, filter users by their name
                 $users = User::where(function ($query) use ($searchTerm) {
                     
                            $terms = explode(' ', $searchTerm);
                            
                        $query->where(function ($query) use ($terms) {
                            foreach ($terms as $term) {
                                $query->orWhere('firstname', 'like', '%' . $term . '%')
                                ->orWhere('lastname', 'like', '%' . $term . '%');
                            }
                        })
                        ->orWhereHas('experiences', function ($query) use ($searchTerm) {
                                      $query->where('company_name', 'like', '%' . $searchTerm . '%')
                                      ->orWhere('role', 'like', '%' . $searchTerm . '%');
                                  });
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
                          })
                        ->has('stories')
                        ->has('sociallinks')
                        ->has('skills')
                        ->has('tools')
                        ->has('attributes')
                        ->has('experiences')
                        ->has('educations')
                        ->get();
            } else {
                // If no search term is provided, retrieve all users
                $users = User::take(10)
                                    ->has('stories')
                                    ->has('sociallinks')
                                    ->has('skills')
                                    ->has('tools')
                                    ->has('attributes')
                                    ->has('experiences')
                                    ->has('educations')
                                    ->get();
            }
            
            
            $connections = $this->getConnections($loggedinUser, $users);
            
            return view('search-results', compact('users', 'loggedinUser', 'connections'));
            
        } catch (\Exception $e) {
            return view('search-results')->with('users', collect());
        }
        
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
