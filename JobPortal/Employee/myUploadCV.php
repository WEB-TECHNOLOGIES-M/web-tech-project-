<?php
include "includes/db_connect.php";
session_start();

$degree = $year = $institution = $err = $emailInDB = "";

//$_SESSION["email"] = "zrsaimun@gmail.com";
if (!isset($_SESSION["email"])) {
  header("Location: ../logout.php");
}
else{
  $email = $_SESSION["email"];
}
/* mysqli_real_escape_string() helps prevent sql injection */



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/Employee/myProfile.css">
  <link rel="stylesheet" href="../css/Employee/bootstrap.css">
  <link rel="stylesheet" href="../css/Employee/fonts.css">
  <script src="https://kit.fontawesome.com/8a7775d0b9.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script>
    $(document).ready(function() {

      $("#fupForm").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'uploadCV.php',
          data: new FormData(this),

          contentType: false,
          cache: false,
          processData: false,
          /*beforeSend: function() {
            $('.submitBtn').attr("disabled", "disabled");
            $('#fupForm').css("opacity", ".5");
          },*/
          success: function(myJSON) {
            console.log(myJSON);
            var x = JSON.parse(myJSON);
            //$('.status_text').html('');
            if (x.status == 1) {
              //$('#fupForm')[0].reset();
              $('.status_text').html('<p class="alert alert-success" style="width: 46%">' + x.message + '</p>');
            } else {
              $('.status_text').html('<p class="alert alert-danger" style="width: 46%">' + x.message + '</p>');
            }
            $('#fupForm').css("opacity", "");
            $(".submitBtn").removeAttr("disabled");

          }
        });
      });

      $("#fupForm2").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'uploadImage.php',
          data: new FormData(this),

          contentType: false,
          cache: false,
          processData: false,
         /* beforeSend: function() {
            $('.submitBtn').attr("disabled", "disabled");
            $('#fupForm2').css("opacity", ".5");
          },*/
          success: function(myJSON) {
            console.log(myJSON);
            var x = JSON.parse(myJSON);
            //$('.status_text').html('');
            if (x.status == 1) {
              //$('#fupForm')[0].reset();
              $('.status_text1').html('<p class="alert alert-success" style="width: 46%">' + x.message + '</p>');
            } else {
              $('.status_text1').html('<p class="alert alert-danger" style="width: 46%">' + x.message + '</p>');
            }
            $('#fupForm').css("opacity", "");
            $(".submitBtn").removeAttr("disabled");

          }
        });
      });

    });
  </script>

</head>

<body>


  <div class="container" style="background: #f0f3fa none repeat scroll 0 0; height:1000px">
    <div class="dashboard-right" style="border-radius: 5%">
      <div class="candidate-profile">

        <form id="fupForm" enctype="multipart/form-data">

          <input type="hidden" id="email" name="email" value="<?php echo $email ?>">

          <div class="resume-box">

            <div class="single-resume-feild feild-flex-2">
              <div class="single-input" style="margin-left: 0px">
                <label for="twitter" style="width: 12%">
                  <i><img src="https://img.icons8.com/plasticine/100/000000/resume.png" style="width: 30%"></i>
                  CV
                </label>
                <input type="file" id="file" name="file" name="twitter" style="width: 34%">
              </div>

            </div>
            <input type="submit" name="submit" class="btn btn-success submitBtn" id="submitBtn" value="SUBMIT" />
            <span id="status_text" class="status_text"></span>
          </div>
          <!--<div class="statusMsg" id="statusMsg"><p class="alert alert-success statusMsg" id="statusMsg"></p></div> -->




        </form>
<hr>
        <form id="fupForm2" enctype="multipart/form-data">

          <input type="hidden" id="email" name="email" value="<?php echo $email ?>">

          <div class="resume-box">

            <div class="single-resume-feild feild-flex-2">
              <div class="single-input" style="margin-left: 0px">
                <label for="twitter" style="width: 12%">
                  <i><img src="https://img.icons8.com/carbon-copy/100/000000/image.png" style="width: 30%"></i>
                  Picture
                </label>
                <input type="file" id="file" name="file" name="twitter" style="width: 34%">
              </div>

            </div>
            <input type="submit" name="submit" class="btn btn-success submitBtn" id="submitBtn" value="SUBMIT" />
            <span id="status_text1" class="status_text1"></span>
          </div>
          <!--<div class="statusMsg" id="statusMsg"><p class="alert alert-success statusMsg" id="statusMsg"></p></div> -->




        </form>



        
      </div>
    </div>

  </div>



</body>

</html>