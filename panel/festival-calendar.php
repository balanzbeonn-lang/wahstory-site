<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

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


if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // $_SESSION["response"]  = $postObj->addCalendarFestivals();
}


$script = "";

if (isset($_SESSION["response"])) {
    switch ($_SESSION["response"]) {
        case "Success": {
                $script = "<script>Swal.fire(
                'Festival Added Successfully!','',
                'success'
                )</script>";
                break;
            }
        case "Error": { 
                $script = "<script>Swal.fire(
                'Error While Adding Festival!','',
                'error'
              )</script>";
                break;
            }
    }

    unset($_SESSION["response"]);
}


include_once("navBar.php");
?>

<style> 
    
    label {
        font-size: 15px;
    }
    
    .scrollable-cards {
    height: 715px; 
    overflow-y: auto;
    /*background: #6777ef;*/
    padding: 10px;
    border-radius:10px;
}

.fest-card {
    background: white; 
    margin-bottom: 20px;  
    padding: 5px; 
    border-radius: 8px;
    border-left:7px solid #6777ef;
    /*width:50%;*/
}

.fest-card a {
    max-width: 27%; 
    object-fit: contain;
}
.fest-card img {
    max-width: 118px; 
    max-height: 100; 
    margin-top: 10px;
    border-radius: 5px;
}

.fest-card-body {
    position: relative;
    padding-left: 10px;
    padding-top:10px;
}

.card-date { 
    position: absolute;
    top: 0px;
    right: 0px;
    background: #fff;
    padding: 3px 7px;
    border-radius: 5px;
    font-size: 0.9em;
    text-align: center;
    box-shadow: 0 5px 8px rgba(0,0,0,0.1);
    display:flex;
    align-items:center;
    justify-content:space-between;
    
}
.card-date div{
    color:#6777ef;
    font-size:14px;
    font-weight:700;
    padding: 2px 3px;
}
 

.month{
    color:#6777ef;
    font-size:14px;
    font-weight:700;
}

.card-inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-text {
    max-width: 43rem; 
    margin-right: 20px; 
}

#months-list table {
    width: 100%;
    border-collapse: collapse;
}

.top-row th{
    background:#6777ef ;
    color:white;
    border-top-left-radius:10px;
    border-top-right-radius:10px;
}

#months-list th, #months-list td {
    border: 1px solid #ddd;
    padding: 2px 8px;
    text-align: center;
    font-weight:bold;
    font-size: 15px;
}

    .mon{
        background:#9195F6;
        color:white;
        font-weight:bold;
        font-size:18px;
        
    }
    
    
        td ul {
            list-style-type: none; 
            padding: 0; 
            margin: 0; 
            display: flex; 
            flex-wrap: wrap; 
            /*color:#0D9276;*/
        }
       /* td li a{
            border: 3px solid #6777ef;
            border-radius: 50%;
            margin: 5px;
            height: 40px;
            width: 40px;
            display: block;
            line-height: 37px;
            text-align: center;
            font-weight:bold;
            
        }
       
        td li a {
            text-decoration: none;
            color: #6777ef;
     
          }
          
        td li a:hover{
            text-decoration: none;
            color: white !important;
            background:#6777ef;
     
          }*/
          
        
    
  ul.f-dates{
    display: flex;
    justify-content: space-between;
  }
  .f-dates li{ 
        max-width: 20%;
        padding: 5px; 
  }
  .f-dates li a{
        text-decoration: none;
        color: #333;
        font-weight: 700;
  }
  .f-dates li .fest-cover{
        background: #ffffffbd;
        padding: 0px 5px;
        border: 1px solid #6777ef7a;
        border-radius: 5px;
        font-size: 12px;
        line-height: 12px;
  }
  .f-dates li .fest-cover p.dateinner{
      margin-bottom: 0px;
  }
  .f-dates li .fest-cover .fname{
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        margin-bottom: 5px;
  }
  
  #festivalCards::-webkit-scrollbar {
        width: 5px; /* Set the width of the scrollbar */
    }
  #festivalCards::-webkit-scrollbar-thumb {
        background-color: #c1c1c1;
        border-radius: 5px;
    }
    
    #selectedFestival{
        display: none;
    }

.f-dates li .fest-cover:hover{
    background: #6777ef;
    color: #fff;
    transition-duration: .4s;
}
#show-all-btn {
    background-color: #6777ef; 
    color: #ffffff; 
    border: none;
    padding: 6px 14px;
    cursor: pointer;
    margin-bottom: 10px;
    border-radius: 5px;
    font-size: 14px; 
    display: inline-block; 
    text-align: center;
    transition: background-color 0.3s, color 0.3s; 
}

#show-all-btn:hover {
    background-color: #5568d9; 
    color: #fff;
}

#show-all-btn a {
    text-decoration: none;
    color: inherit;
}

    
</style>

<body>
    <div class="main-content" style="padding-top: 95px;">
        <section class="section">
            <div class="row">
                <div class="col-12">
    <div class="row">
        <div class="col-md-6"> 
            <div id="months-list">
                
               <table>
                    <tr class="top-row">
                        <th style="border: none;padding-top: 8px;padding-bottom: 8px;border-top-right-radius: 0px; font-size: 18px;">Months</th>
                        <th style="border: none;padding-top: 8px;padding-bottom: 8px;border-top-left-radius: 0px; font-size: 18px;">Festival Dates</th> 
                    </tr>
         <?php 
         function getMonthName($monthNumber) {
            return date('F', mktime(0, 0, 0, $monthNumber, 1));
        }
           $SQL = $postObj->GetListOfFestivals(2024);
           $mn2 = '';
           foreach($SQL as $rows){
                $datetime = $rows['date'];
                $month_number = date('n', strtotime($datetime));
                
                if($mn2 == $month_number){
                    continue;
                }
                 ?> 
                    <tr>
                        <td class="mon"><?php echo getMonthName($month_number); ?></td>
                           
                        <td>
                            <ul class="f-dates">
                                <?php 
                $Sqlfestivals = $postObj->GetListOfFestivalsByMonths($month_number);
                                foreach ($Sqlfestivals as $frow) { ?>
                                <li>
                                    <a href="javascript:void(0);" class="f-dates-a" data-id="<?=$frow['id']?>">
                                    <div class="fest-cover">
                                        <p class="dateinner"><?=date("d", strtotime($frow['date']));?></p>
                                        <div class="fname"><?=$frow['title']?></div>
                                    </div> 
                                    </a>
                                </li>
                <?php } ?>
                                 
                            </ul>
                        </td>
                    </tr>
                    
                <?php 
                $mn2 = $month_number;
                } ?>
                    
                    <!-- Add rows for each month -->
                </table>
            </div>
        </div>
        <div class="col-md-6 full-right">
            <div id="festivalCards" class="scrollable-cards">
                
                <div id="selectedFestival">
                  <button id="show-all-btn">
                      <a href="javascript:void(0);" id="ShowAllFs" class="mb-2">Show All Festivals</a>
                  </button> 
                   <br>
                  <div class="fest-card">
                        <div class="fest-card-body"> 
                            <div class="card-date">
                                <div id="fday"></div>
                                <div id="fdate"></div>
                                <div id="fmonth"></div>
                            </div>
                            <h5 class="card-title" id="ftitle"></h5>
                            
                            <p class="card-text" id="fdescription"></p>
                            
                            <div class="card-inner" style="justify-content: center;">
                                 
                                <a href="" id="ftarget" target="_blank" style="max-width: 100% !important;"> <img src="" id="fimg" alt="" style="max-width: 220px !important;"></a>
                            </div>
                        </div>
                    </div>
                
                </div>
              
              <div id="unselectedFestival">
                  
            <?php $SQL2 = $postObj->GetListOfFestivals(2024); 
                foreach($SQL2 as $frows2){
                     
            ?>  
                <div class="fest-card">
                    <div class="fest-card-body"> 
                        <div class="card-date">
                            <div class="day"><?=date("l", strtotime($frows2['date']));?></div>
                            <div class="date"><?=date("d", strtotime($frows2['date']));?></div>
                            <div class="month"><?=date("M", strtotime($frows2['date']));?></div>
                        </div>
                        <h5 class="card-title"><?=$frows2['title'];?></h5>
                        <div class="card-inner">
                            <p class="card-text"><?=$frows2['description'];?></p>
                            <a href="<?=$frows2['imagelink'];?>" target="_blank"> <img src="<?=$frows2['imagelink'];?>" alt=""> </a>
                        </div>
                    </div>
                </div>
            
            <?php } ?>
            
            </div>
            
            
            </div>
        </div>
    </div>
</div>
   
            </div>

             
    </div>
    </div>
    
    <script src="assets/js/app.min.js"></script>
    <script src="assets/bundles/summernote/summernote-bs4.js"></script>
    <script src="assets/bundles/codemirror/lib/codemirror.js"></script>
    <script src="assets/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
    <script src="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="assets/bundles/codemirror/mode/javascript/javascript.js"></script>
    <script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
    <script src="assets/bundles/ckeditor/ckeditor.js"></script>
    <script src="assets/js/page/ckeditor.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/page/create-post.js"></script>
   
   
    <?php echo $script; ?>

<script>
    // f-dates-li
    $(document).ready(function() {
        $("#ShowAllFs").click(function() {
            document.getElementById("selectedFestival").style.display = "none";
            document.getElementById("unselectedFestival").style.display = "block";
        });
    });
    $(document).ready(function() {
        $(".f-dates-a").click(function() {
            var RowId = $(this).attr("data-id");
        $.ajax({
                type: 'POST',
                url: 'festival.ajax.php',
                data: { RowId: RowId },
                success: function (response) {
                    
                // Handle the response from the server here
            document.getElementById("selectedFestival").style.display = "block";
            document.getElementById("unselectedFestival").style.display = "none";
            
            document.getElementById("fday").innerHTML = response.day;
            document.getElementById("fdate").innerHTML = response.date;
            document.getElementById("fmonth").innerHTML = response.month;
            document.getElementById("ftitle").innerHTML = response.title;
            document.getElementById("fdescription").innerHTML = response.descp;
            document.getElementById("ftarget").href = response.imagelink;
            document.getElementById("fimg").src = response.imagelink;
            
                },
            error: function (jqXHR, textStatus, errorThrown) {
                // Handle errors here
                console.error(textStatus, errorThrown);
            }
        });
         
        });
    });
</script>

    
</body>

</html>