    <div class="p-3 mt-3 rounded-4 postReminder-card min-height">
        
        <div class="card-header d-flex justify-content-between align-items-center" style=" border-bottom: 1px solid #333; ">
            <h6 class="mb-2"> 
            <i class="fa-solid fa-calendar-days me-2"></i>
             Upcoming Meets </h6>
            <a href="/users/member.bookingrequests.php" class="mb-2">View All</a>
        </div>
        
        <div class="card-body pt-2">
    <?php
    $rows = $UtilityObj->GetAllConfirmedBookingRequests_Member($Userrow['ClubId']); 
    
    if($rows !== NULL) {
        foreach ($rows as $row) {
            if($row['user_id'] == $Userrow['ClubId']) {
                $userrow = $UtilityObj->GetWAHClubUserById($row['member_id']);
            } else {
                $userrow = $UtilityObj->GetWAHClubUserById($row['user_id']);
            }
            
    ?>
            <p style="border-bottom: 1px solid #333; padding-bottom: 8px;">
                <a href="">Meeting with <?=$userrow['firstname'].' '.$userrow['lastname']?>
                    <br> 
                    <small><?=date('d M Y', strtotime($row['slot_date'])).' '.date('h:i A', strtotime($row['slot_time']))?></small>
                </a>
                <a href="<?=$row['google_meet_link']?>" target="_blank" class="cs-btn cs-style1 py-1 px-3 cs-font_11 mt-2 ViewPostBtn text-right" style="background: #043b46;"><i class="fas fa-video me-1"></i>Join</a> 
                   
            </p>   
    <?php } } else { ?>
            <p style="color: #a6a3a3;">
                You do not have any upcoming meeting!
            </p>
    <?php } ?>
             
            
        </div>
    
    </div>