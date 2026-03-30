<?php
    // Reason of Stress ################################
    $stressParams = [
        'stress_work',
        'stress_finance',
        'stress_health',
        'stress_relationship',
        'stress_bereavement'
    ];
    
    $stressAvgs = [];
    $stressedColors = [];
  
    foreach ($stressParams as $param) {
        $count = $obj->GetAverageOfReasonStress($param);
        $avg = round(($count * 100) / $total_participants);
        $stressAvgs[$param . '_avg'] = $avg;
        
        $stressedColors[] = ($userScore[$param] > 2) ? 'DB93EF' : 'F8F3F3';
    }
    
    list($stressed1, $stressed2, $stressed3, $stressed4, $stressed5) = $stressedColors;
    
    // Reason of Stress ################################ Ends
    
    
    // Manage of Stress ################################
    $ManagestressParams = [
        'Taking a holiday',
        'Reducing working hours',
        'Taking sick leave',
        'Meditation',
        'Overeating',
        'Drinking alcohol',
        'Smoking'
    ];
    
    $managestressAvgs = [];
    $managestressColors = [];
    $num = 1;
    foreach ($ManagestressParams as $mngparam) {
        $count = $obj->getCountByMultiColumnParam($mngparam, 'tried_manage_stress');
        $avg = round(($count * 100) / $total_participants);
        $MNGstressAvgs['manage'.$num . '_avg'] = $avg;
        
        $triedManageStress = is_array($userScore['tried_manage_stress']) 
    ? $userScore['tried_manage_stress'] 
    : explode(',', $userScore['tried_manage_stress']);

    $MNGstressedColors[] = in_array($mngparam, $triedManageStress) ? 'mainPink' : 'medGray';
        
        $num++;
    }
    
    list($mngstressed1, $mngstressed2, $mngstressed3, $mngstressed4, $mngstressed5, $mngstressed6, $mngstressed7) = $MNGstressedColors;
    
    // Reason of Stress ################################ Ends
    
    
    
    // Wellbeing Goals ################################
    $WellbeingGoalsParams = [
        'Mediate',
        'Fitness & Sports',
        'Travel',
        'Spirituality',
        'Healthy Diet',
        'Enough Sleep',
        'Devote Time for your interest'
    ];
    
    $WellbeingGoalsAvgs = [];
    $WellbeingGoalsColors = [];
    $num2 = 1;
    foreach ($WellbeingGoalsParams as $wlgparam) {
        $count = $obj->getCountByMultiColumnParam($wlgparam, 'goals_well_being');
        $avg = round(($count * 100) / $total_participants);
        $WellbeingGoalsAvgs['wellg'.$num2 . '_avg'] = $avg;
        
        $goals_well_being = is_array($userScore['goals_well_being']) 
    ? $userScore['goals_well_being'] 
    : explode(',', $userScore['goals_well_being']);

    $WellbeingGoalsColors[] = in_array($wlgparam, $goals_well_being) ? 'mainPink' : 'medGray';
        
        $num2++;
    }
    
    list($Wellbeing1, $Wellbeing2, $Wellbeing3, $Wellbeing4, $Wellbeing5, $Wellbeing6, $Wellbeing7) = $WellbeingGoalsColors;
    
    //  Wellbeing Goals ################################ Ends
    
    
    // $JobImproveParams ################################
    $JobImproveParams = [
        'In-house training',
        'External training and certification',
        'On-the-job coaching',
        'Help from a consultant',
        'Mentoring by senior staff',
        'Exposure to another role',
        'Other'
    ];
    
    $JobImproveAvgs = [];
    $JobImproveColors = [];
    $num3 = 1;
    foreach ($JobImproveParams as $Jobparam) {
        $count = $obj->getCountByMultiColumnParam($Jobparam, 'activities_improving_job');
        $avg = round(($count * 100) / $total_participants);
        $JobImproveAvgs['jobimp'.$num3 . '_avg'] = $avg;
        
        $JobImprovements = is_array($userScore['activities_improving_job']) 
    ? $userScore['activities_improving_job'] 
    : explode(',', $userScore['activities_improving_job']);

    $JobImproveColors[] = in_array($Jobparam, $JobImprovements) ? 'mainPink' : 'medGray';
        
        $num3++;
    }
    
    list($jobImprove1, $jobImprove2, $jobImprove3, $jobImprove4, $jobImprove5, $jobImprove6, $jobImprove7) = $JobImproveColors;
    
    //  $JobImproveParams   ################################ Ends
    
    
    //  Organization Support  ################################
    $OrgParams = [
        'Improved Work/Life Balance',
        'Personal Development Training',
        'Encourage healthy lifestyle',
        'Promote mental health awareness and counseling',
        'Organize fitness/sports events',
        'Financial Advisory',
        'Yoga / Meditation session'
    ];
    
    $OrgAvgs = [];
    $OrgColors = [];
    $num3 = 1;
    foreach ($OrgParams as $Orgparam) {
        $count = $obj->getCountByMultiColumnParam($Orgparam, 'support_increase_well_being');
        $avg = round(($count * 100) / $total_participants);
        $OrgAvgs['orgsup'.$num3 . '_avg'] = $avg;
        
        
        $OrgSuports = is_array($userScore['support_increase_well_being']) 
    ? $userScore['support_increase_well_being'] 
    : explode(',', $userScore['support_increase_well_being']);

    $OrgColors[] = in_array($Orgparam, $OrgSuports) ? 'mainPink' : 'medGray';
        
        $num3++;
    }
    
    list($OrgSup1, $OrgSup2, $OrgSup3, $OrgSup4, $OrgSup5, $OrgSup6, $OrgSup7) = $OrgColors;
    
    //   Organization Support ################################ Ends
    
    
    
    
    //   Health & Fitness Score ################################ Starts
        $HealthMarks = $userScore['sports_activity'] +  $userScore['diet_attempt'] +  $userScore['tried_reduce_alcohol'] +  $userScore['taken_active_lifestyle'] +  $userScore['alcohol_part_lifestyle'] +  $userScore['avoiding_foods'] +  $userScore['diet_balanced'];
        $HEALTHnFITNESS_SCORE = round(( $HealthMarks * 100) / 28);
    //   Health & Fitness Score ################################ Ends
    
    if($userScore['often_stressed'] == 'All the time'){
        $ques19value = 0;
    }else if($userScore['often_stressed'] == 'Most of the time'){
        $ques19value = 1;
    }else if($userScore['often_stressed'] == 'Sometimes'){
        $ques19value = 2;
    }else if($userScore['often_stressed'] == 'Rarely'){
        $ques19value = 3;
    }else if($userScore['often_stressed'] == 'Never'){
        $ques19value = 4;
    }
    
    $ques21value = explode(',', $userScore['goals_well_being']);
    $ques21value_count = count($ques21value);
    
    $ques20value = explode(',', $userScore['tried_manage_stress']);
    $ques20value_count = count($ques20value);
    
    $ques22value = explode(',', $userScore['activities_improving_job']);
    $ques22value_count = count($ques22value);
    
    $ques23value = explode(',', $userScore['support_increase_well_being']);
    $ques23value_count = count($ques23value);
   
    //   LIFE Score ################################ Starts
        $LifeMarks = $userScore['stress_work'] +  $ques19value + $ques20value_count + $ques21value_count + $ques22value_count + $ques23value_count;
        
        $LIFE_SCORE = round(( $LifeMarks * 100) / 41);
    //   LIFE Score ################################ Ends
   
    //   FINANCIAL Score ################################ Starts
        $FinancialMarks = $userScore['financial_future'] + $userScore['ahead_finance'] + $userScore['money_left'] + $userScore['money_relaxed'] - $userScore['stress_finance'];
        
        if($FinancialMarks > 1) {
            $FINANCIAL_SCORE = round(( $FinancialMarks * 100) / 16);
        }else {
            $FINANCIAL_SCORE = 10;
        }
        
    //   FINANCIAL Score ################################ Ends
    
    
    //   INTELLECTUAL Score ################################ Starts
        $intellectualMarks = $userScore['read_books'] + $userScore['time_new_skills'] + $userScore['prevent_problems'] + $userScore['how_creative'] + $userScore['synthesize_knowledge'] + $ques22value_count;
        
        if($intellectualMarks > 1) {
            $INTELLECTUAL_SCORE = round(( $intellectualMarks * 100) / 27);
        }else {
            $INTELLECTUAL_SCORE = 0;
        }
        
    //   INTELLECTUAL Score ################################ Ends
    
    
    //   Small Baar Score ################################ Ends
        // Below 40 at Risk
    	// 40 - 60 at Fair
    	// 60 - 80 at Good
    	// 80 - 100 at Excellent
	
	    $Health_Grade = $obj->getScoreGrade($HEALTHnFITNESS_SCORE);
	    $Life_Grade = $obj->getScoreGrade($LIFE_SCORE);
	    $Financial_Grade = $obj->getScoreGrade($FINANCIAL_SCORE);
	    $Intellectual_Grade = $obj->getScoreGrade($INTELLECTUAL_SCORE);
	    
    //   Small Baar Score ################################ Ends
    
    
    
    //   HEALTH STANDARD Score ################################ 
    $sports_activity = $obj->getSumOfColumn('sports_activity');
    $diet_attempt = $obj->getSumOfColumn('diet_attempt');
    $tried_reduce_alcohol = $obj->getSumOfColumn('tried_reduce_alcohol');
    $taken_active_lifestyle = $obj->getSumOfColumn('taken_active_lifestyle');
    $alcohol_part_lifestyle = $obj->getSumOfColumn('alcohol_part_lifestyle');
    $avoiding_foods = $obj->getSumOfColumn('avoiding_foods');
    $diet_balanced = $obj->getSumOfColumn('diet_balanced');
    
    $HealthMarks_Standard = $sports_activity['total'] + $diet_attempt['total'] + $tried_reduce_alcohol['total'] + $taken_active_lifestyle['total'] + $alcohol_part_lifestyle['total'] + $avoiding_foods['total'] + $diet_balanced['total']; 
    
    $Health_max_marks = 28 * $total_participants;
    
    $HEALTHnFITNESS_SCORE_Standard = round(( $HealthMarks_Standard * 100) / $Health_max_marks);
    
    //   HEALTH STANDARD Score ################################ Ends
    
    //   LIFE STANDARD Score ################################ 
    $stress_work = $obj->getSumOfColumn('stress_work');
    $standard_ques19vlaue = $obj->getSumOfQues19Value();
    $standard_ques20vlaue = $obj->getQuesValueCountColumn('goals_well_being');
    $standard_ques21vlaue = $obj->getQuesValueCountColumn('tried_manage_stress');
    $standard_ques22vlaue = $obj->getQuesValueCountColumn('activities_improving_job');
    $standard_ques23vlaue = $obj->getQuesValueCountColumn('support_increase_well_being');
    
    $LifeMarks_Standard = $stress_work['total'] + $standard_ques19vlaue + $standard_ques20vlaue + $standard_ques21vlaue + $standard_ques22vlaue + $standard_ques23vlaue;
    $Life_max_marks = 41 * $total_participants;
     
    
    $LIFE_SCORE_Standard = round(( $LifeMarks_Standard * 100) / $Life_max_marks);
    
    //   LIFE STANDARD Score ################################ Ends
    
    //   FINANCIAL STANDARD Score ################################ 
    $financial_future = $obj->getSumOfColumn('financial_future');
    $ahead_finance = $obj->getSumOfColumn('ahead_finance');
    $money_left = $obj->getSumOfColumn('money_left');
    $money_relaxed = $obj->getSumOfColumn('money_relaxed');
    $stress_finance = $obj->getSumOfColumn('stress_finance'); 
    
    $FinanceMarks_Standard = $financial_future['total'] + $ahead_finance['total'] + $money_left['total'] + $money_relaxed['total'] - $stress_finance['total']; 
    
    $Finance_max_marks = 16 * $total_participants;
    
    $FINANCIAL_SCORE_Standard = round(( $FinanceMarks_Standard * 100) / $Finance_max_marks);
    
    //   FINANCIAL STANDARD Score ################################ Ends
    
    //   INTELLECTUAL STANDARD Score ################################ 
    $read_books = $obj->getSumOfColumn('read_books');
    $time_new_skills = $obj->getSumOfColumn('time_new_skills');
    $prevent_problems = $obj->getSumOfColumn('prevent_problems');
    $how_creative = $obj->getSumOfColumn('how_creative');
    $synthesize_knowledge = $obj->getSumOfColumn('synthesize_knowledge'); 
    
    $IntellMarks_Standard = $read_books['total'] + $time_new_skills['total'] + $prevent_problems['total'] + $how_creative['total'] + $synthesize_knowledge['total']; 
    
    $Intell_max_marks = 27 * $total_participants;
    
    $INTELLECTUAL_SCORE_Standard = round(( $IntellMarks_Standard * 100) / $Intell_max_marks);
    
    //   INTELLECTUAL STANDARD Score ################################ Ends
    
    $INDIVIDUAL_WELLBEING_SCORE = round(($HEALTHnFITNESS_SCORE +  $LIFE_SCORE + $FINANCIAL_SCORE + $INTELLECTUAL_SCORE) / 4);
    
    if($INDIVIDUAL_WELLBEING_SCORE < 40){
        $YOURSCORE_GRADE = 'Fair';    
    } else if($INDIVIDUAL_WELLBEING_SCORE > 40 && $INDIVIDUAL_WELLBEING_SCORE < 60){
        $YOURSCORE_GRADE = 'Good'; 
    } else if($INDIVIDUAL_WELLBEING_SCORE > 60){
        $YOURSCORE_GRADE = 'Excellent'; 
    }
    
    
    $STANDARD_WELLBEING_SCORE = round(($HEALTHnFITNESS_SCORE_Standard +  $LIFE_SCORE_Standard + $FINANCIAL_SCORE_Standard + $INTELLECTUAL_SCORE_Standard) / 4);
    
?>