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
    var PasswordPattern = false;

    function myFunction() {
      var x = document.getElementById("new_pass");
      var y = document.getElementById("current_pas");
      var z = document.getElementById("confirm_pass");

      if (x.type === "password") {
        x.type = "text";
        y.type = "text";
        z.type = "text";
      } else {
        x.type = "password";
        y.type = "password";
        z.type = "password";
      }
    }

    function myFocus() {
      document.getElementById("message").style.display = "block";
    }

    function myBlur() {
      document.getElementById("message").style.display = "none";
    }

    function myKeyUp() {
      // Validate lowercase letters
      var myInput = $('#new_pass').val();
      var letter = document.getElementById("letter");
      var capital = document.getElementById("capital");
      var number = document.getElementById("number");
      var length = document.getElementById("length");

      var lowerCaseLetters = /[a-z]/g;
      if (myInput.match(lowerCaseLetters)) {
        letter.classList.remove("invalid");
        letter.classList.add("valid");

      } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");

      }

      // Validate capital letters
      var upperCaseLetters = /[A-Z]/g;
      if (myInput.match(upperCaseLetters)) {
        capital.classList.remove("invalid");
        capital.classList.add("valid");
      } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
      }

      // Validate numbers
      var numbers = /[0-9]/g;
      if (myInput.match(numbers)) {
        number.classList.remove("invalid");
        number.classList.add("valid");
      } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
      }

      // Validate length
      if (myInput.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
      } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
      }

      if (letter.className == "valid" && capital.className == "valid" && number.className == "valid" && length.className == "valid") {
        PasswordPattern = true;
      }

    }








    $(document).ready(function() {
      var i = 2;
      var j = 0;
      var nextClick = 0;
      //alert("ajax loading..");



      $('#addEdu').click(function() {

        var new_pass = $('#new_pass').val();
        var current_pas = $('#current_pas').val();
        var confirm_pass = $('#confirm_pass').val();
        var email = '<?php echo $email ?>';

        var postData = 'new_pass=' + new_pass + '&current_pas=' + current_pas + '&confirm_pass=' + confirm_pass + '&email=' + email;

        if (new_pass!="") {
          if (PasswordPattern) {
            if (new_pass != confirm_pass) {
          document.getElementById("status_text").innerHTML = "Password Didnt Match";
          document.getElementById("status_text").style.color = "#ff0000";

        } else {
          $.ajax({
            url: "changePassword.php",
            type: "POST",
            data: postData,
            success: function(data, status, xhr) {
              //if success then just output the text to the status div then clear the form inputs to prepare for new data
              var s = data;




              if (s.includes("Invalid Current Password")) {
                $("#status_text").html(data);
                document.getElementById("status_text").style.color = "#ff0000";
              } else {
                $("#status_text").html(data);
                document.getElementById("status_text").style.color = "#008000	";
                $('#new_pass').val('');
                $('#current_pas').val('');
                $('#confirm_pass').val('');
              }


            },
            error: function(jqXHR, status, errorThrown) {
              //if fail show error and server status
              $("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);
            }
          })
        }

          }else{
            document.getElementById("status_text").innerHTML = "Password pattern Doesnt MATCH";
                  document.getElementById("status_text").style.color = "#ff0000";
                }
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
              <label for="Phone">Current Password:</label>
              <input type="password" value="" id="current_pas" name="institution" required>
            </div>
          </div>

          <div class="single-resume-feild feild-flex-2">
            <div class="single-input">
              <label for="Phone">New Password :</label>
              <input type="password" value="" id="new_pass" name="institution" onfocus="myFocus()" onblur="myBlur()" onkeyup="myKeyUp()" required>
            </div>
          </div>

          <div class="single-resume-feild feild-flex-2">
            <div class="single-input">
              <label for="Phone">Confirm Password :</label>
              <input type="password" value="" id="confirm_pass" name="institution" required>
            </div>
          </div>
          <div class="showPass" style="margin-left: 26%">
            <input type="checkbox" onclick="myFunction()">Show Password
          </div>

          <div id="message" style="width: 69%;margin-left: 26%">
            <h5>Password must contain the following:</h5>
            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
            <p id="number" class="invalid">A <b>number</b></p>
            <p id="length" class="invalid">Minimum <b>8 characters</b></p>
          </div>



          <div class="submit-resume">
            <input class="btn btn-primary btn-lg active" id="addEdu" value="Add" type="submit"></input>
            <span id="status_text" style="color: red"><?php echo $err; ?></span>
          </div>
        </form>
      </div>
    </div>

  </div>



</body>

</html>