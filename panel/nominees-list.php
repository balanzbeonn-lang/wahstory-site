<?php
require_once("../db/postClass.php");
$postObj = new Post();
ini_set('display_errors', 1);
error_reporting(E_ALL);


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

$posts = $postObj->getAllNominees();

 
?>
<?php include_once("navBar.php") ?>

<style>
    .scrollimation .portfolio-thumb.in {
        min-height: 210px;
    }
</style>
<div class="main-content">

    <script>
        console.log('<?= $url; ?>');
    </script>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                    
                    
                    <h3> 
                        Nominees List
                    </h3>
                    
                    <h5>Story Status By Colors:  <span class="badge badge-danger">Auto Nominees</span> | <span class="badge badge-primary">New Stories Submitted</span> | <span class="badge badge-success">New Stories Published</span></h5>
                    
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="bootstrap snippet">
                                <section id="portfolio" class="gray-bg padding-top-bottom">
                                    <!--==== Portfolio Filters ====-->
                                    
                                    <!-- ======= Portfolio items ===-->
                                    <div class="projects-container scrollimation in">
                                        <div class="row">
                                            <?php if ($posts) {
                                                foreach ($posts as $post) {
                                                    
                                                $VoteCount = $postObj->CountNomineeVotes($post['id']);
                                                    
                                            ?>
                                                    <article class="col-md-3 col-sm-6 portfolio-item web-design apps psd">
                                                        <div class="portfolio-thumb in p-3">
                            <a href="nominee-profile.php?nId=<?=$post['id']?>" class="main-link"> 
                                       <div class="">
                                           <h6>
                                              <?=$post['name']?>
                                           </h6>
                                       </div>  
                                       <div class="">
                                           <p>
                                           <span>
                                               Total Votes : <strong><?=$VoteCount['count']?></strong>
                                           </span> <br>
                                           <span>
                                               Verified : 
                                <?php if($post['isVerified'] == 1 ){ ?><i class="fa fa-check text-success"></i>
                                <?php }else{ ?>
                                    <i class="fa fa-times text-danger"></i>
                                <?php } ?>
                                           </span>
                                           <br>
                <?php $catRow = $postObj->GetNomineeRequestedCats($post['id']);
                
                    if($catRow != false){
                ?>
                                           <span>
                                               Category : 
                               <strong> <?php echo $catRow['cats'];?></strong>
                                           </span>
                <?php } ?>
                                           
                                           </p>
                                         
                                           <p>
                    <?php 
                     $STORYDATA = $postObj->GetNomineeStoryDetails($post['id']);  
                    if($STORYDATA != false){
                            if($STORYDATA['postid'] != 0) { ?>
                                           <span class="badge badge-danger">Auto Nominee</span>
                    <?php 
                            }elseif($STORYDATA['isVerified'] != 0) {
                                
                                echo '<span class="badge badge-success">Story Published <i class="fa fa-check"></i></span>';
                                
                            }else{
                        
                        echo '<span class="badge badge-primary">New Story</span>';
                    }
                    
                    
                    }?>
                                           </p>
                                           
                                       </div>                         
                                    <!--<span class="overlay-mask"></span>-->
                            </a>
                                                        </div>
                                                    </article>
                                            <?php    }
                                            }
                                            ?>
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
<script>
    function updatePost(id) {
        window.location.href = "update.php?id=" + id;
    }
</script>