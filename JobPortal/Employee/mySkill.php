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

      $('#name').bind('keyup blur', function() {
          var node = $(this);
          node.val(node.val().replace(/[^A-Za-z_\s]/, ''));
        } // (/[^a-z]/g,''
      );
      /*$('#percentage').bind('keyup blur', function() {
          var node = $(this);
          node.val(node.val().replace(/[^A-Za-z_\s]/, ''));
        } // (/[^a-z]/g,''
      );*/


      $('#addEdu').click(function() {

        var name = $('#name').val();
        var p = $('#percentage').val();
        var percentage = p.slice(0, 2);

        var email = '<?php echo $email ?>';

        if (name != "" && percentage != "") {
          var postData = 'percentage=' + percentage + '&name=' + name + '&email=' + email;

          $.ajax({
            url: "addSkill.php",
            type: "POST",
            data: postData,
            success: function(data, status, xhr) {
              //if success then just output the text to the status div then clear the form inputs to prepare for new data
              $("#status_text").html(data);
              $('#name').val('');
              $('#percentage').val('');
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
    <div class="dashboard-right" style="border-radius: 5%">
      <div class="candidate-profile">

        <form onsubmit="return false">

          <div class="single-resume-feild feild-flex-2">
            <div class="single-input">
              <label for="Phone">Skill Name:</label>
              <input type="text" value="" id="name" name="institution" required placeholder="Javascript">
            </div>
          </div>

          <div class="single-resume-feild feild-flex-2">
            <div class="single-input">
              <label for="Phone">Skill Percentage :</label>
              <input value="" id="percentage" pattern="[0-9]" name="institution" onkeydown="javascript: return event.keyCode === 8 ||
event.keyCode === 46 ? true : !isNaN(Number(event.key))" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="2" placeholder="85%" required>
            </div>
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