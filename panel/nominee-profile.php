<?php
require_once("../db/postClass.php");
$postObj = new Post();

if (!$postObj->adminCheck()) {
    $_SESSION["session_expire"] = "<script>
    Swal.fire(
        'Session Time-Out!',
        'Please login again!',
        'warning'
      ) </script>";
    header('Location: logout');
}

 
$script = "";
if(!isset($_GET['nId']) || $_GET['nId'] == ''){
    header("location: nominees-list");
}

$post = $postObj->getNomineeById($_GET['nId']);
 
if($post == false){
    header("location: nominees-list");
}
 
  $STORYDATA = $postObj->GetNomineeStoryDetails($_GET['nId']);  
 
 $DATACT = $postObj->GetNomineeRequestedCats($_GET['nId']); 
  
?>
<?php include_once("navBar.php") ?>
<div class="main-content">
 <a href="nominees-list"><i class="fa fa-arrow-left"></i> Back </a>
 <br>
 <br>
    <section class="section">
        <div class="section-body">
            <div class="row">
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="bootstrap snippet">
                                <section id="portfolio" class="gray-bg padding-top-bottom">
                                    <!--==== Portfolio Filters ====-->
                                    
                                    <!-- ======= Portfolio items ===-->
                                    <div class="projects-container scrollimation in">
                                        <div class="row">
                                              
                                        <div class="col-md-12">
                                            <h5> Nomination Profile Details
                    <?php if($STORYDATA != false){
                            if($STORYDATA['postid'] != 0) { ?>
                                           <span class="badge badge-primary">Auto Nominee</span>
                    <?php } }?>
                                            </h5> 
                                        </div>
                                        <div class="col-md-12">
                     
                    
                    <span class="btn btn-info mb-2">Self Nomination <i class="fa fa-check"></i></span>
                    
                <?php if($post['isVerified'] == 1 ){ ?>
                    <span class="btn btn-info mb-2">Account Verification <i class="fa fa-check"></i></span>
                <?php }else{?>  
                    <span class="btn btn-secondary mb-2">Account Verification</span>
                <?php }?>  
                <?php if($DATACT != false ){ ?>
                    <span class="btn btn-info mb-2">Category Selection <i class="fa fa-check"></i></span>
                <?php }else{?>  
                    <span class="btn btn-secondary mb-2">Category Selection</span>
                <?php }?> 
                <?php if($post['isPaid'] == 'Paid'){ ?>
                    <span class="btn btn-info mb-2">Payment <i class="fa fa-check"></i></span>
                <?php }else{?>  
                    <span class="btn btn-secondary mb-2">Payment</span>
                <?php }?> 
                <?php if($STORYDATA != false){ ?> 
                    <span class="btn btn-info mb-2">Story Submit <i class="fa fa-check"></i></span>
                <?php }else{?>  
                    <span class="btn btn-secondary mb-2">Story Submit</span>
                <?php }?>
                
                <?php if($STORYDATA != false){ ?>
                <a href="nominee.publish.story.php?nId=<?=$post['id']?>" class="btn btn-primary mb-2 text-right">
                        <span><i class="fa fa-edit"></i> Edit to Publish Story</span>
                    
                    </a>
                    
                    <?php } ?>
                
                
                                        </div>
                                            
                                        <div class="col-md-12">
                                            
                                            <hr>
                                            
        <table class="table table-hover">
            <tr>
                <th> Name: </th>
                <td> <?=$post['name']?> </td>
            </tr>
            <tr>
                <th> Email: </th>
                <td> <?=$post['email']?> </td>
            </tr>
            <tr>
                <th> Phone: </th>
                <td> <?=$post['phone']?> </td>
            </tr>
            <tr>
                <th> Age: </th>
                <td> <?=$post['age']?> </td>
            </tr>
            <tr>
                <th> Occupation: </th>
                <td> <?=$post['occupation']?>  </td>
            </tr>
            <tr>
                <th> Company: </th>
                <td> <?=$post['company']?>  </td>
            </tr>
            <tr>
                <th> Designation: </th>
                <td> <?=$post['designation']?>  </td>
            </tr>
            <tr>
                <th> City, Country: </th>
                <td> <?=$post['city']?>, <?=$post['country']?>  </td>
            </tr>
            
            <tr>
                <th> Account Status: </th>
                <td> <?php if($post['isVerified'] == 1){ echo "Verified";}else{ echo "Not Verified";}?>  </td>
            </tr>
            
            <tr>
                <th> Social Id: </th>
                <td> <?=$post['sociallink']?> </td>
            </tr> 
            <tr>
                <th> Date: </th>
                <td> <?=date("d-m-Y", strtotime($post['datetime']));?> </td>
            </tr> 
        </table>  
                                        </div>
                                        
                                        </div>
                                        
                                        <br> 
                                        <div class="row">
                                              
                                        <div class="col-md-12">
                                            <h5> Payment Details</h5> 
                                            <hr>
                                        </div>  
           
                                        <div class="col-md-12">
                
                                <table class="table table-hover">
                <?php if($post['isPaid'] == 'Paid'){ ?>
                                    <thead>
                                        <tr> 
                                            <th> 
                                                Date
                                            </th>
                                            <th> 
                                                Categories
                                            </th>
                                            <th>
                                                Amount
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr> 
                                            <td><?=date("d M Y", strtotime($DATACT['datetime']))?></td> 
                                            <td><?=$DATACT['cats']?></td> 
                                            <td>INR <?=number_format($DATACT['amount'], 2)?></td> 
                                        </tr>
                                    </tbody>
                 <?php   }else{ echo "<tr> <th colspan='3'> No Record Available </th> </tr>";  }?>
                                </table> 
               
                                        </div>
                                        
                                        </div>
                                        
                                        
                                        <br> 
                                        <div class="row">
                                              
                                        <div class="col-md-12">
                                            <h5> Story Details</h5> 
                                            <hr>
                                        </div>  
            
                                        <div class="col-md-12">
                
                                <table class="table table-hover">
                <?php if($STORYDATA != false){ ?>
                
                                    <tbody>
                            <?php if($STORYDATA['postid'] != 0) { ?>
                                        <tr> 
                                            <th> <a href="/story/<?=$STORYDATA['slug']?>" target="_blank"> Read Full Story </a> </th>
                                        </tr>
                                         
                            <?php   }else{  ?>
                            
                            <tr> <th> Question 1</th> </tr>
                            <tr> <td> <?=$STORYDATA['q1']?> </td> </tr>
                            <tr> <th> Question 2</th> </tr>
                            <tr> <td> <?=$STORYDATA['q2']?> </td> </tr>
                            <tr> <th> Question 3</th> </tr>
                            <tr>  <td> <?=$STORYDATA['q3']?> </td> </tr>
                            <tr> <th> Question 4</th> </tr>
                            <tr>  <td> <?=$STORYDATA['q4']?> </td> </tr>
                            <tr> <th> Question 5</th> </tr>
                            <tr>  <td> <?=$STORYDATA['q5']?> </td> </tr> 
                            <tr>  <th> Images </th> </tr>  
                            <tr> 
                                    <td> 
                <?php 
                $selectedimgs = $STORYDATA['imgs'];
                $selectedimgsArray = explode(', ', $selectedimgs);
                    foreach($selectedimgsArray as $img){ 
                ?>
                                  <a href="/wahspotlight/upload/storyimages/<?=$img?>" target="_blank"> <img src="/wahspotlight/upload/storyimages/<?=$img?>" width="100" height="100">
                                  </a>
 
                <?php } ?>
                                    
                                    </td>
                            </tr> 
                            
                            
                            <?php   } ?>
                            
                            
                                         
                                    </tbody>
                 <?php   }else{ echo "<tr> <th colspan='3'> No Record Available </th> </tr>";  }?>
                                </table> 
               
                                        </div>
                                        
                                        </div>
                                       
                            <br> 
                        <div class="row">
                            <div class="col-md-12">
                                <h5> Voting Details</h5> 
                                <hr>
                            </div>  
            
                            <div class="col-md-12">
                     <?php $voteSql = $postObj->GetNomineestoryvotes($_GET['nId']); 
                if($voteSql != false){ ?>
                                <table class="table table-hover">
                                    <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Country</th>
                                    <th>Company</th>
                                    <th>Job Title</th>
                                    <th>Date</th>
                                        
                                    </tr>
                <?php  
                foreach($voteSql as $voteRow){?>
                                    <tr>
                                        <td><?=$voteRow['voterFname']?></td> 
                                        <td><?=$voteRow['voterEmail']?></td> 
                                        <td><?=$voteRow['VoterPhone']?></td> 
                                        <td><?=$voteRow['voterCountry']?></td> 
                                        <td><?=$voteRow['voterCompany']?></td> 
                                        <td><?=$voteRow['voterJobtitle']?></td> 
                                        <td><?=date("d-m-Y", strtotime($voteRow['datetime']));?></td> 
                                    </tr>
                <?php } ?>
                        
                                </table> 
                <?php }else{ ?>
                <strong>No Record Available</strong>
                <?php } ?>
                            </div>
                        </div>
                                        
                                        
                                        
                                        
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
</div>
<!-- General JS Scripts -->
<script src="assets/js/app.min.js"></script>
<!-- JS Libraies -->
<script src="assets/bundles/apexcharts/apexcharts.min.js"></script>
<!-- Page Specific JS File -->
<script src="assets/js/page/index.js"></script>
<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="assets/js/custom.js"></script>
</body>

</html>
<?php echo $script; ?>
 