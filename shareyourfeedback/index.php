<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Share Your Feedback</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"/>
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    
    <style>
       form{
        background: white;
    border: 0 none;
    border-radius: 3px;
    box-shadow: 0 17px 41px -21px rgb(0 0 0);
    padding: 20px 30px;
    border-top: 9px solid #f51e7c;
    box-sizing: border-box;   
       } 
       
    .btn-primary-theme{
        background: #f51e7c;
        color: #fff;
    }
    .btn-primary-theme:hover{
        color: #fff;
    }
    
    .form-control:focus{
        border-color: #462b34;
    box-shadow: inset 0 0 0 1px #462b34;
    }
    .form-outline .form-control:focus~.form-label {
    color: #462b34;
}
    
    
       .star-rating {
   margin: 0px 0 0px;
  font-size: 0;
  white-space: nowrap;
  display: inline-block;
  width: 175px;
  height: 35px;
  overflow: hidden;
  position: relative;
  background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjREREREREIiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
  background-size: contain;
}
.star-rating i {
  opacity: 0;
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  width: 20%;
  z-index: 1;
  background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjRkZERjg4IiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
  background-size: contain;
}
.star-rating input {
  -moz-appearance: none;
  -webkit-appearance: none;
  opacity: 0;
  display: inline-block;
  width: 20%;
  height: 100%;
  margin: 0;
  padding: 0;
  z-index: 2;
  position: relative;
}
.star-rating input:hover + i,
.star-rating input:checked + i {
  opacity: 1;
}
.star-rating i ~ i {
  width: 40%;
}
.star-rating i ~ i ~ i {
  width: 60%;
}
.star-rating i ~ i ~ i ~ i {
  width: 80%;
}
.star-rating i ~ i ~ i ~ i ~ i {
  width: 100%;
}

span.scale-rating{
margin: 5px 0 15px;
    display: inline-block;
   
    width: 100%;
   
}
span.scale-rating>label {
  position:relative;
    -webkit-appearance: none;
  outline:0 !important;
    border: 1px solid grey;
    height:33px;
    margin: 0 5px 0 0;
  width: calc(10% - 7px);
    float: left;
  cursor:pointer;
}
span.scale-rating label {
  position:relative;
    -webkit-appearance: none;
  outline:0 !important;
    height:33px;
      
    margin: 0 5px 0 0;
  width: calc(10% - 7px);
    float: left;
  cursor:pointer;
}
span.scale-rating input[type=radio] {
  position:absolute;
    -webkit-appearance: none;
  opacity:0;
  outline:0 !important;
    /*border-right: 1px solid grey;*/
    height:33px;
 
    margin: 0 5px 0 0;
  
  width: 100%;
    float: left;
  cursor:pointer;
  z-index:3;
}
span.scale-rating label:hover{
background:#fddf8d;
}
span.scale-rating input[type=radio]:last-child{
border-right:0;
}
span.scale-rating label input[type=radio]:checked ~ label{
    -webkit-appearance: none;

    margin: 0;
  background:#fddf8d;
}
span.scale-rating label:before
{
  content:attr(value);
    top: 4px;
    width: 100%;
    position: absolute;
    left: 0;
    right: 0;
    text-align: center;
    vertical-align: middle;
  z-index:2;
}

    </style>
  </head>
  <body>
    <!-- Start your project here-->
    
<div class="container pt-1" >
    <?php if(isset($_GET['sucmsg'])){?>
        <div class="alert alert-dismissible fade show alert-success" role="alert" data-mdb-color="warning" id="customxD">
          <strong>Success!</strong> <?=$_GET['sucmsg']?>
          <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php if(isset($_GET['errmsg'])){?>
        <div class="alert alert-dismissible fade show alert-danger" role="alert" data-mdb-color="warning" id="customxD">
          <strong>Error!</strong> <?=$_GET['errmsg']?>
          <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <div class="row mb-1">
        <div class="col-md-12 text-center">
            <div style="margin-left: 5%; margin-right: 5%; background: #fff;">
            <a href="/" ><img src="../images/logos/logo-light.png" height="80px" alt=""></a>
                
            </div>
        </div>
    </div>
</div>
<div class="container">
<form action="post.php" method="POST" style="margin-left: 5%;margin-right: 5%;" enctype="multipart/form-data">
  <!-- 2 column grid layout with text inputs for the first and last names -->
    <div class="row mb-2">
      <div class="col text-center">
          <h4>We would love to hear from you!</h4>
      </div>
    </div>
  <div class="row mb-4 mt-3">
    <div class="col-md-6 col-sm-6 col-xs-12 mb-2">
      <div class="form-outline">
        <input type="text" id="inputfield1" name="firstname" class="form-control" required/>
        <label class="form-label" for="inputfield1">First Name*</label>
      </div>
    </div>
    <div class="col-md-6 col-sm-6  col-xs-12 mb-2">
      <div class="form-outline">
        <input type="text" id="inputfield2" name="lastname" class="form-control" required/>
        <label class="form-label" for="inputfield2">Last Name*</label>
      </div>
    </div>
    
    <div class="col-md-6 col-sm-6 col-xs-12 mt-2 ">
      <div class="form-outline">
        <input type="email" id="inputfield91" name="email" class="form-control" required/>
        <label class="form-label" for="inputfield91">Email*</label>
      </div>
    </div>
    
    <div class="col-md-6 col-sm-6 col-xs-12 mt-2">
      <div class="form-outline">
        <input type="text" id="inputfield9" name="designation" class="form-control" required/>
        <label class="form-label" for="inputfield9">Designation*</label>
      </div>
    </div>
    
    
  </div>
  
  <div class="row">
        <div class="col-md-12 mb-4 mt-2">
          
         </div>
    </div>
  
  <div class="row">
      <div class="col-md-12 mb-4 mt-2">
          <label class="form-label">How would you rate your overall experience with us? *</label> <br>
        <span class="star-rating">
            <input type="radio" name="rating1" value="1"><i></i>
            <input type="radio" name="rating1" value="2"><i></i>
            <input type="radio" name="rating1" value="3"><i></i>
            <input type="radio" name="rating1" value="4"><i></i>
            <input type="radio" name="rating1" value="5"><i></i>
        </span>
      </div>
  </div>
  <div class="row">
      <div class="col-md-12 mb-4 mt-2">
          <label class="form-label">On a scale from 1-10, how likely are you to recommend WAHStory to others? *</label> <br>
          
        <span class="scale-rating">
          <label value="1">
          <input type="radio" name="ratingnum" value="1">
          <label style="width:100%;"></label>
          </label>
          <label value="2">
          <input type="radio" name="ratingnum" value="2">
          <label style="width:100%;"></label>
          </label>
          <label value="3">
          <input type="radio" name="ratingnum" value="3">
          <label style="width:100%;"></label>
          </label>
          <label value="4">
          <input type="radio" name="ratingnum" value="4">
          <label style="width:100%;"></label>
          </label>
          <label value="5">
          <input type="radio" name="ratingnum" value="5">
          <label style="width:100%;"></label>
          </label>
          <label value="6">
          <input type="radio" name="ratingnum" value="6">
          <label style="width:100%;"></label>
          </label>
          <label value="7">
          <input type="radio" name="ratingnum" value="7">
          <label style="width:100%;"></label>
          </label>
          <label value="8">
          <input type="radio" name="ratingnum" value="8">
          <label style="width:100%;"></label>
          </label>
          <label value="9">
          <input type="radio" name="ratingnum" value="9">
          <label style="width:100%;"></label>
          </label>
          <label value="10">
          <input type="radio" name="ratingnum" value="10">
          <label style="width:100%;"></label>
          </label>
        </span>
        
      </div>
  </div>
  
  <div class="row">
      <div class="col-md-12 mb-4">
          <div class="form-outline">
          <textarea class="form-control" id="inputfield5" rows="8" maxlength="300" name="description" required></textarea>
          <label class="form-label" for="inputfield5">Please describe how your experience has been with WAHStory and how we were able to add value to your journey?* (Limit 300 Characters)</label>
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col-md-12 mb-4">
          <div class="form-outline">
          <textarea class="form-control" id="inputfield10" rows="8" maxlength="300" name="whatmade" required></textarea>
          <label class="form-label" for="inputfield10">What made you share your story with us?* (Limit 300 Characters)</label>
          </div>
      </div>
  </div>
    <div class="row">
      <div class="col-md-12 mb-4">
          <!-- Email input -->
          <div class="form-outline">
            <label class="form-label" for="form3Example3">Kindly attach a photo (Max : 1 MB) (Accept Image PNG, JPG)</label><br>
            <input type="file" name="file" accept="image/*"/>
          </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12 mb-2">
          <div class="g-recaptcha" data-sitekey="6LfD06weAAAAAOjL1EFxao0cMF8c-caJNaKAY9PD"></div>
      </div>
      <div class="col-md-12 mb-2">
          <!-- Submit button -->
          <button type="submit" name="SUBMIT" class="btn btn-primary-theme btn-block mb-2">Submit</button>
      </div>
    </div>

  <!-- Register buttons -->
  <div class="text-center">
    <p>Follow us on:</p>
    <button type="button" class="btn btn-primary-theme btn-floating mx-1">
      <i class="fab fa-facebook-f"></i>
    </button>
    
    <button type="button" class="btn btn-primary-theme btn-floating mx-1">
      <i class="fab fa-instagram"></i>
    </button>
    
    <button type="button" class="btn btn-primary-theme btn-floating mx-1">
      <i class="fab fa-linkedin"></i>
    </button>

    <button type="button" class="btn btn-primary-theme btn-floating mx-1">
      <i class="fab fa-twitter"></i>
    </button>
  </div>
</form>

    </div>
    <!-- End your project here-->
    
    <script src="https://www.google.com/recaptcha/api.js" async="" defer=""></script>
    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>
