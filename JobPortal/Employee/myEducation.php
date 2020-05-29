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
  <script>
    $(document).ready(function() {
      var i = 2;
      var j = 0;
      var nextClick = 0;
      //alert("ajax loading..");

      $('#degree,#institution').bind('keyup blur', function() {
          var node = $(this);
          node.val(node.val().replace(/[^A-Za-z_\s]/, ''));
        } // (/[^a-z]/g,''
      );

      $('#addEdu').click(function() {

        var institution = $('#institution').val();
        var degree = $('#degree').val();
        var y1 = $('#year1').val();
        var y2 = $('#year2').val();
        var year = y1 + "-" + y2;
        
        var email = '<?php echo $email ?>';

        if (degree != "" && y1 != "" && y2 != "" && institution != "") {
          var postData = 'institution=' + institution + '&degree=' + degree + '&year=' + year + '&email=' + email;

          $.ajax({
            url: "addEducation.php",
            type: "POST",
            data: postData,
            success: function(data, status, xhr) {
              //if success then just output the text to the status div then clear the form inputs to prepare for new data
              $("#status_text").html(data);
              $('#degree').val('');
              $('#year1').val('');
              $('#year2').val('');
              $('#institution').val('');
            },
            error: function(jqXHR, status, errorThrown) {
              //if fail show error and server status
              $("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);
            }
          })
        }

      });

    });
  </script>

</head>

<body>


  <div class="container" style="background: #f0f3fa none repeat scroll 0 0; height:1000px">
    <div class="dashboard-right">
      <div class="candidate-profile">

        <form onsubmit="return false">

          <div class="single-resume-feild feild-flex-2">
            <div class="single-input">
              <label for="Phone">Degree Name:</label>
              <input type="text" value="" id="degree" name="institution" required placeholder="Bsc in CSE">
            </div>
          </div>

          <div class="single-resume-feild feild-flex-2">
            <div class="single-input">
              <label for="Phone">Year:</label>
              <input value="" id="year1" name="institution" style="width: 30%" placeholder="2015" pattern="[0-9]" name="institution" onkeydown="javascript: return event.keyCode === 8 ||
event.keyCode === 46 ? true : !isNaN(Number(event.key))" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="4" required>
              <label for="Phone" style="width: 10%; text-align: center">-</label>
              <input value="" id="year2" name="institution" style="width: 30%" placeholder="2017" pattern="[0-9]" name="institution" onkeydown="javascript: return event.keyCode === 8 ||
event.keyCode === 46 ? true : !isNaN(Number(event.key))" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="4" required>
            </div>
          </div>

          <div class="single-resume-feild feild-flex-2">
            <div class="single-input">
              <label for="Phone">Institution Name:</label>
              <input type="text" value="" id="institution" name="institution" required>
            </div>
            <!--<div class="single-input">
              <label for="Email">Email:</label>
              <input type="text" value="demo@mail.com" id="Email">
            </div> -->
          </div>
          <div class="submit-resume">
            <input class="btn btn-primary btn-lg active" id="addEdu" value="Add" type="submit"></input>
            <span id="status_text" style="color:green"><?php echo $err; ?></span>
          </div>
        </form>
      </div>
    </div>

  </div>



</body>

</html>