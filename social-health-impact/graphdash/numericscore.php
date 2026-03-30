<?php
// session_start();
// $_SESSION['email'] = 'officialpavan@gmail.com';
$NewsandCurrentEventsCount = $EntertainmentCount = $PersonalUpdatesCount = $InspirationalCount = $EducationalCount = $ProductCount = $OthersCount = 0;

//Ques 1 -  Engagement 
	        switch($DataRow['professionalpurposes']){
	            case '1-2':
	            $professionalpurposes = 1;
	            break;
	            case '3-4':
	            $professionalpurposes = 3;
	            break;
	            case '5 or more':
	            $professionalpurposes = 5;
	            break;
	       }
	    
	    // Ques 2-  Engagement
        $social_platforms_array = explode(",", $DataRow['social_platforms']);
        $social_platforms_score = $social_platforms_others = 0;
        foreach ($social_platforms_array as $social_platforms) {
            if (in_array($social_platforms, ['Instagram', 'Facebook', 'LinkedIn', 'YouTube', 'Twitter'])) {
                $social_platforms_score += 1;
            } else {
                $social_platforms_others = 1;
            }
        }
        $social_platforms_score = $social_platforms_score + $social_platforms_others;
        
        // Ques 3-  Engagement
        switch($DataRow['interactwithplatform']){
	            case 'Multiple times a day':
	            $interactwithplatform = 5;
	            break;
	            case 'Once a day':
	            $interactwithplatform = 4;
	            break;
	            case 'A few times a week':
	            $interactwithplatform = 3;
	            break;
	            case 'Rarely':
	            $interactwithplatform = 2;
	            break;
	       }
	       
	    // Ques 4  
        $content_types_array = explode(",", $DataRow['content_type']);
        $content_types_score = $content_types_others = 0;
        foreach ($content_types_array as $content_types) {
            if (in_array($content_types, ['Images', 'Articles', 'Videos', 'Opinions'])) {
                $content_types_score += 1;
            } else {
                $content_types_others = 1;
            }
        }
        $content_types_score = $content_types_score + $content_types_others;
        
        
        //Ques 6 - Impact
        $perception_options = [
            'Minimal' => 1,
            'Moderate' => 2,
            'Strong' => 3,
            'Very strong' => 4
        ];
        $impactsocial_engagement = $perception_options[$DataRow['impactsocial_social_engagement']];
        
        // Ques 7 - Impact
        $digital_presence = $perception_options[$DataRow['digital_presence']];
        
        
        // Ques 8 - Time Management
        $time_options = [
            'Less than 30 minutes' => 2,
            '30 minutes - 1 hour' => 3,
            '1-2 hours' => 4,
            'More than 2 hours' => 5
        ];
        $average_spend_time = $time_options[$DataRow['average_spend_time']];
        
        // Ques 9 - Time Management
        $bhoolean_options = [
            'Yes' => 4,
            'No' => 2
            ];
        $is_time_well_spent = $bhoolean_options[$DataRow['is_time_well_spent']];
        
        // Ques 10 - Content Strategy
        $balance_options = [
            'Mostly personal' => 2,
            'Balanced mix' => 3,
            'Mostly professional' => 4
            ];
        $personal_professional_balance = $balance_options[$DataRow['personal_professional_balance']];
    
    // Ques 11
      $monitor_engagement_metrics_array = explode(",", $DataRow['monitor_engagement_metrics']);
        $monitor_engagement_metrics_score = 0;
        foreach ($monitor_engagement_metrics_array as $monitor_engagement_metrics) {
            if (in_array($monitor_engagement_metrics, ['Likes', 'Comments', 'Shares', 'Clicks', 'Impressions', 'Conversion'])) {
                $monitor_engagement_metrics_score += 4;
            }
        }
        $monitor_engagement_metrics_score = $monitor_engagement_metrics_score;
    
        // Ques 12 
        $feedback_options = [
            'Regularly adjust content' => 4,
            'Occasionally adjust content' => 3,
            'Rarely adjust content' => 2
            ];
        $incorporate_engagement_metrics_score = $feedback_options[$DataRow['incorporate_engagement_metrics']];
        
        //12
        $sl_obj_options = [
                'Building a personal brand' => 4,
                'Connecting with friends and colleagues' => 3,
                'Promoting products or services' => 4,
                'Sharing insights' => 3,
                'Providing entertainment' => 3
            ];
        $important_social_objective_score = $sl_obj_options[$DataRow['important_social_objective']];
        
        //13
        $pr_obj_options = [
                'General public' => 3,
                'Professionals in your industry' => 4,
                'Potential customers' => 4,
                'Friends and family' => 2,
            ];
        $primary_target_audience_values = $DataRow['primary_target_audience'];
        if (isset($pr_obj_options[$primary_target_audience_values])) {
            $primary_target_audience_score = $pr_obj_options[$primary_target_audience_values];
        } 
        
    //As Defined, Your questions Max Score is 54 then    
        $MaxScore = 78;
        $UserTotalMarks = $professionalpurposes + $social_platforms_score + $interactwithplatform + $content_types_score + $impactsocial_engagement + $digital_presence + $average_spend_time + $is_time_well_spent + $personal_professional_balance + $monitor_engagement_metrics_score + $incorporate_engagement_metrics_score + $important_social_objective_score + $primary_target_audience_score;
        
        

?>