<?php
require_once("prodClass.php");
$prodObj = new product();

if (empty($_SESSION["user"]) || empty($_SESSION["pass"])) {
  header('Location: login.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_SESSION["user"]) && isset($_SESSION["pass"])) {

    $return = $prodObj->addProd();

    if ($return == "not_admin") {
      
    } elseif ($return == "Error") {
      
    } elseif ($return == "Success") {
      header('Location: pannel/index.php#!/addProd');
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <title>Add a product</title>
  <style>
    input {
      margin-top: 30px;
    }

    .thumb-image {
      width: 100px;
      position: relative;
      padding: 5px;
    }
  </style>
</head>

<body>
  <center>
    <form method="POST" enctype="multipart/form-data">
      <fieldset>
        <legend>Enter product details</legend>
        <center>
          Post Title: <input name="title" placeholder="Enter title" required><br>
          Post Author: <input name="author" type="text" placeholder="Enter author name" required><br>
          
          Post Date: <input name="date" type="date" placeholder="Date" required><br>
        
          Description: <input name="description" type="textarea" placeholder="Enter Description" required><br><br>

          Category: <select id="cat" name="cat">
          </select><br><br>

          Post Image: <input id="fileUpload" type="file" accept="image/*" name="upload" required>

          <div id="image-holder">
          </div>
          <input type="submit">
        </center>
      </fieldset>
    </form>
  </center>

  <script>
    $(document).ready(function() {
      $("#fileUpload").on('change', function() {
        //Get count of selected files
        var countFiles = $(this)[0].files.length;
        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $("#image-holder");
        image_holder.empty();
        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
          if (typeof(FileReader) != "undefined") {
            //loop for each file selected for uploaded.
            for (var i = 0; i < countFiles; i++) {
              var reader = new FileReader();
              reader.onload = function(e) {
                $("<img />", {
                  "src": e.target.result,
                  "class": "thumb-image"
                }).appendTo(image_holder);
              }
              image_holder.show();
              reader.readAsDataURL($(this)[0].files[i]);
            }
          } else {
            alert("This browser does not support FileReader.");
          }
        } else {
          alert("Pls select only images");
        }
      });
      var x = 2;
      $("#btn1").click(function() {
        $("#btn1").before(" Spec " + x + " : <input name='spec[]' placeholder='Enter product spec' required>");
        x++;
      });

      $("#parentCat").change(function() {
            var val = $("#parentCat").val();
            $.post("api.php", {
                cat: val,
                action: "Cat"
            }, data => {
                data = JSON.parse(data);
                $("#subCat").empty();
            $("#subCat").append("<option value=''>Select Category</option>");
            for (x in data) {
                $("#subCat").append("<option value='" + data[x].cat + "'>" + data[x].cat + "</option>");
            }
            });
        });

        $("#subCat").change(function() {
            var subCat = $("#subCat").val();
            var parentCat = $("#parentCat").val();
            $.post("api.php", {
                cat: subCat,
                pCat:parentCat,
                action: "Brand"
            }, data => {
                data = JSON.parse(data);
                console.log(data);
                $("#brand").empty();
            $("#brand").append("<option value=''>Select Brand</option>");
            for (x in data) {
                $("#brand").append("<option value='" + data[x].name + "'>" + data[x].name + "</option>");
            }
            });
        });

    });
  </script>


</body>

</html>
