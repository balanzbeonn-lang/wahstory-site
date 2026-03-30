<div class="p-3 rounded-4 postReminder-card min-height">
                        <div class="card-header d-flex justify-content-between align-items-center" style=" border-bottom: 1px solid #333; ">
                            <h6 class="mb-2"> 
                            <i class="fa-solid fa-calendar-days me-2"></i>
                            Approve Booking </h6>
                            <a href="/users/member.bookingrequests.php" class="mb-2">View All</a>
                        </div>
                        <div class="card-body pt-2">
                        <?php
                    $rows = $UtilityObj->GetAllPendingNewBookingRequests_Member($Userrow['ClubId']); 
                
                    if($rows !== NULL) {
                        foreach ($rows as $row) {
                            if($row['member_id'] == $Userrow['ClubId']) {
                                $userrow = $UtilityObj->GetWAHClubUserById($row['user_id']);
                            
                    ?>
                            <p style="border-bottom: 1px solid #333; padding-bottom: 8px;">
                                <a href="/users/member.bookingrequests.php">
                                    <?=$userrow['firstname'].' '.$userrow['lastname']?> has requested a meeting
                                    <br> 
                                    <small><?=date('d M Y', strtotime($row['slot_date']))?></small>
                                </a>
                                
                                <a href="/users/member.bookingrequests.php" class="cs-btn cs-style1 py-1 px-3 cs-font_11 mt-2 ViewPostBtn text-right">View Details</a>
                                 
                            </p> 
                           
                    <?php 
                    $Pendingcount = 1;
                            } 
                            
                    }
                    
                    if($Pendingcount !== 1) {
                    ?>
                        <p style="color: #a6a3a3;">
                                You do not have any meeting to approve!
                            </p>
                    <?php }  
                    
                    } else { ?>
                            <p style="color: #a6a3a3;">
                                You do not have any meeting to approve!
                            </p>
                    <?php } ?>
                        
                               
                        </div>
                    </div> 