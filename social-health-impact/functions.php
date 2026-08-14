<?php
require_once(__DIR__ . '/../config/config.inc.php');
require_once(__DIR__ . '/../config/functions.inc.php');

class SocialHealth
{
    
    function PostSocialFootprintForm()
    {
        extract($_POST);
        
        global $conn;
        
        $social_platforms_1 = $_POST['social_platforms'];
        foreach($social_platforms_1 as $social_platform){
            $social_platforms22 .= $social_platform.",";  
        }
        $content_type_1 = $_POST['content_type'];
        foreach($content_type_1 as $content_type2){
            $content_type22 .= $content_type2.",";  
        }
        $primary_objectives_1 = $_POST['primary_objectives'];
        foreach($primary_objectives_1 as $primary_objective){
            $primary_objectives22 .= $primary_objective.",";  
        }
        $content_type_engage_1 = $_POST['content_type_engage'];
        foreach($content_type_engage_1 as $content_type_engage_2){
            $content_type_engage22 .= $content_type_engage_2.",";  
        }
        $monitor_engagement_metrics_1 = $_POST['monitor_engagement_metrics'];
        foreach($monitor_engagement_metrics_1 as $monitor_engagement_metric){
            $monitor_engagement_metrics22 .= $monitor_engagement_metric.",";  
        }
        $social_impact_challenges_1 = $_POST['social_impact_challenges'];
        foreach($social_impact_challenges_1 as $social_impact_challenge){
            $social_impact_challenges22 .= $social_impact_challenge.",";  
        }
        $areas_of_improvement_1 = $_POST['areas_of_improvement'];
        foreach($areas_of_improvement_1 as $areas_of_improvement2){
            $areas_of_improvement22 .= $areas_of_improvement2.",";  
        }
        
        $company1 = mysqli_real_escape_string($conn, $_POST['company']);
        
        $additional_comments1 = mysqli_real_escape_string($conn, $_POST['additional_comments']);
        
        $date = date('Y-m-d');
        
         $sql = executeQuery("INSERT INTO `socialfootprint`(name, email, phone, gender, age, occupation, company, professionalpurposes, social_platforms, interactwithplatform, content_type, primary_objectives, impactsocial_social_engagement, digital_presence, average_spend_time, is_time_well_spent, personal_professional_balance, content_type_engage, monitor_engagement_metrics, incorporate_engagement_metrics, important_social_objective, primary_target_audience, social_impact_challenges, areas_of_improvement, overall_digital_presence, additional_comments, social_media_influencers, service_recommendation, prefered_social, self_esteem, compared_social_activity, terms, date)VALUES('$name', '$email', '$phone', '$gender', '$age', '$occupation', '$company1', '$professionalpurposes', '$social_platforms22', '$interactwithplatform', '$content_type22', '$primary_objectives22', '$impactsocial_social_engagement', '$digital_presence', '$average_spend_time', '$is_time_well_spent', '$personal_professional_balance', '$content_type_engage22', '$monitor_engagement_metrics22', '$incorporate_engagement_metrics', '$important_social_objective', '$primary_target_audience', '$social_impact_challenges22', '$areas_of_improvement22', '$overall_digital_presence', '$additional_comments1', '$social_media_influencers', '$service_recommendation', '$prefered_social', '$self_esteem', '$compared_social_activity', '$terms', '$date')");
        
        if($sql){
            
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            
	        return "SUCCESS";
        }else{
            return "ERROR";
        }
        
    }
    
    function getSocialFootprints(){
        
        $sql =  executeQuery("SELECT * FROM `socialfootprint` ORDER BY id DESC");
         if($sql){
	        return $sql;
        }else{
            return "ERROR";
        }
    }
    
    function getUserDataBYID($Userid){
        
        $sql =  executeQuery("SELECT * FROM users WHERE id = '$Userid'");
        
         if($sql){
	        return mysqli_fetch_array($sql);
        }else{
            return "ERROR";
        }
    }
    function getDataEmail($email){
        
        // $sql =  executeQuery("SELECT * FROM socialfootprint WHERE email = '$email'");
        $sql =  executeQuery("SELECT sf.*, u.email AS useremail, u.name AS username, u.profile_image AS image FROM socialfootprint sf LEFT JOIN users u ON sf.email = u.email WHERE sf.email = '$email'");
        
         if($sql){
	        return mysqli_fetch_array($sql);
        }else{
            return "ERROR";
        }
    }
    
    function getGenderCount($gender){
        
        $sql =  executeQuery("SELECT gender FROM socialfootprint WHERE gender = '$gender'");
        
         if($sql){
	        return mysqli_num_rows($sql);
        }else{
            return "ERROR";
        }
    }
    
    function getNoOfMembersCount(){
        $sql = executeQuery("SELECT COUNT(*) AS count FROM socialfootprint");
         if($sql){
	        return mysqli_fetch_array($sql);
        }else{
            return "ERROR";
        }
    }
      
    
    function getByAgeRange($min, $max){
        
        $sql = executeQuery("SELECT COUNT(*) AS count FROM socialfootprint WHERE age >= '$min' AND age <= '$max'");
        
         if($sql){
	        return mysqli_fetch_array($sql);
        }else{
            return "ERROR";
        }
    }
      
    function getCountByOccupation($Occupation){
        
        $sql = executeQuery("SELECT COUNT(*) AS count FROM socialfootprint WHERE occupation = '$Occupation'");
         if($sql){
	        return mysqli_fetch_array($sql);
        }else{
            return "ERROR";
        }
    }
    
    function getCountBypreferedsocial($social){
        
        $sql = executeQuery("SELECT COUNT(*) AS count FROM socialfootprint WHERE prefered_social = '$social'");
         if($sql){
	        return mysqli_fetch_array($sql);
        }else{
            return "ERROR";
        }
    }
    
    function getCountByTimeWellSpent($option){
        
        $sql = executeQuery("SELECT COUNT(*) AS count FROM socialfootprint WHERE is_time_well_spent = '$option'");
         if($sql){
	        return mysqli_fetch_array($sql);
        }else{
            return "ERROR";
        }
    }
    
    function getCountByFollowsfluencers($option){
        $sql = executeQuery("SELECT COUNT(*) AS count FROM socialfootprint WHERE social_media_influencers = '$option'");
         if($sql){
	        return mysqli_fetch_array($sql);
        }else{
            return "ERROR";
        }
    }
    function getCountByfluencersPurchase($option){
        $sql = executeQuery("SELECT COUNT(*) AS count FROM socialfootprint WHERE service_recommendation = '$option'");
         if($sql){
	        return mysqli_fetch_array($sql);
        }else{
            return "ERROR";
        }
    }
    function getCountUsingSocialPlatformByOne($option){
        $sql = executeQuery("SELECT COUNT(*) AS count FROM socialfootprint WHERE professionalpurposes = '$option'");
         if($sql){
	        return mysqli_fetch_array($sql);
        }else{
            return "ERROR";
        }
    }
    function getCountChallangesfaced($option){
        $sql = executeQuery("SELECT COUNT(*) AS count FROM socialfootprint WHERE social_impact_challenges LIKE '%$option%'");
         if($sql){
	        return mysqli_fetch_array($sql);
        }else{
            return "ERROR";
        }
    }
    function getCountTargetAudience($option){
        $sql = executeQuery("SELECT COUNT(*) AS count FROM socialfootprint WHERE primary_target_audience = '$option'");
         if($sql){
	        return mysqli_fetch_array($sql);
        }else{
            return "ERROR";
        }
    }
    
    function getCountSharingContentType($option){
        $sql = executeQuery("SELECT COUNT(*) AS count FROM socialfootprint WHERE content_type LIKE '%$option%'");
         if($sql){
	        return mysqli_fetch_array($sql);
        }else{
            return "ERROR";
        }
    }
    
    function getCountContentInterest($option){
        $sql = executeQuery("SELECT COUNT(*) AS count FROM socialfootprint WHERE content_type_engage LIKE '%$option%'");
         if($sql){
	        return mysqli_fetch_array($sql);
        }else{
            return "ERROR";
        }
    }
    
    function getCountEngagementObjective($option){
        $sql = executeQuery("SELECT COUNT(*) AS count FROM socialfootprint WHERE primary_objectives LIKE '%$option%'");
         if($sql){
	        return mysqli_fetch_array($sql);
        }else{
            return "ERROR";
        }
    }
    
    function getCountSocialPrimaryObjective($option){
        $sql = executeQuery("SELECT COUNT(*) AS count FROM socialfootprint WHERE important_social_objective = '$option'");
         if($sql){
	        return mysqli_fetch_array($sql);
        }else{
            return "ERROR";
        }
    }
    
    
    function getCountEngagementMatrics($option){
        $sql = executeQuery("SELECT COUNT(*) AS count FROM socialfootprint WHERE monitor_engagement_metrics LIKE '%$option%'");
         if($sql){
	        return mysqli_fetch_array($sql);
        }else{
            return "ERROR";
        }
    }
    
    
    
} 
?>