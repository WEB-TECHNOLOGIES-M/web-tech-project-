<?php
include "includes/db_connect.php";
session_start();

$degree = $year = $institution = $err = $emailInDB = "d";

//$_SESSION["email"] = "zrsaimun@gmail.com";
if (!isset($_SESSION["email"])) {
  header("Location: ../logout.php");
}
else{
  $email = $_SESSION["email"];
}

$name = $cgpa = $title = $aboutMe = $facebook = $linkedn = $twitter = $google  = $gender = $address = $city = $phone = $website = $age = $salary = $experience = "";
/* mysqli_real_escape_string() helps prevent sql injection */
$sqlUserCheck = "SELECT email,cgpa,name,title,aboutMe,gender,facebook,linkedin,twitter,google,address,city,phone,website,age,salary,experience,picture FROM seekerinfo WHERE email  = '$email'";
$result = mysqli_query($conn, $sqlUserCheck);

while ($row = mysqli_fetch_assoc($result)) {
  $name = $row['name'];
  $cgpa = $row['cgpa'];
  $title = $row['title'];
  $aboutMe = $row['aboutMe'];
  $facebook = $row['facebook'];
  $linkedn = $row['linkedin'];
  $twitter = $row['twitter'];
  $google = $row['google'];
  $email = $row['email'];
  $gender = $row['gender'];
  $address = $row['address'];
  $city = $row['city'];
  $phone = $row['phone'];
  $website = $row['website'];
  $age = $row['age'];
  $salary = $row['salary'];
  $experience = $row['experience'];
  $picture = $row['picture'];
}




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

      $('#name,#p_title,#city').bind('keyup blur', function() {
          var node = $(this);
          node.val(node.val().replace(/[^A-Za-z_\s]/, ''));
        } // (/[^a-z]/g,''
      );

      

      var i = 2;
      var j = 0;
      var nextClick = 0;
      //alert("ajax loading..");

      $('#addEdu').click(function() {

        var name = $('#name').val();
        var email = $('#email').val();
        var p_title = $('#p_title').val();
        var gender = $('#gender').val();
        var age = $('#age').val();
        var cgpa = $('#cgpa').val();
        var salary = $('#salary').val();
        var exp = $('#exp').val();
        var website = $('#website').val();
        var aboutMe = $('#aboutMe').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
        var city = $('#city').val();
        var twitter = $('#twitter').val();
        var facebook = $('#facebook').val();
        var google = $('#google').val();
        var linkedin = $('#linkedin').val();

        if (cgpa>4) {
          alert("your cgpa is higher than 4. get a doctor man!!");
        }else{
          var postData = 'name=' + name + '&email=' + email + '&p_title=' + p_title + '&gender=' + gender + '&age=' + age + '&cgpa=' + cgpa + '&salary=' + salary + '&exp=' + exp + '&website=' + website + '&aboutMe=' + aboutMe + '&phone=' + phone + '&city=' + city + '&address=' + address + '&twitter=' + twitter + '&facebook=' + facebook + '&google=' + google + '&linkedin=' + linkedin;

$.ajax({
  url: "updateMyProfile.php",
  type: "POST",
  data: postData,
  success: function(data, status, xhr) {
    //if success then just output the text to the status div then clear the form inputs to prepare for new data
    $("#status_text").html(data);
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


  <div class="container" style="background: #f0f3fa none repeat scroll 0 0">
    <div class="dashboard-right">
      <div class="candidate-profile">
        <div class="candidate-single-profile-info">
          <div class="single-resume-feild resume-avatar">


            <div class="resume-image">
              <img src="uploads/<?php echo $picture ?>" alt="Profile Picture" width="150px" height="150px">
              
            </div>



          </div>
        </div>
        <div class="candidate-single-profile-info">
          <form onsubmit="return false">
            <!-- Personal Info -->
            <div class="resume-box">
              <h3>My Profile</h3>
              <div class="single-resume-feild feild-flex-2">
                <div class="single-input">
                  <label for="name">Name:</label>
                  <input type="text" value="<?php echo $name ?>" id="name" style="background-image: url(); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
                </div>
                <div class="single-input">
                  <label for="p_title">Professional title:</label>
                  <input type="text" value="<?php echo $title ?>" id="p_title">
                </div>
              </div>
              <div class="single-resume-feild feild-flex-2">
                <div class="single-input">
                  <label for="Region">Gender:</label>
                  <select id="gender">
                    <option selected=""><?php echo $gender ?></option>
                    <option>Male</option>
                    <option>Female</option>
                  </select>
                </div>
                <div class="single-input">
                  <label for="Age">Age:</label>
                  <input type="number" value="<?php echo $age ?>" id="age" pattern="[0-9]" onkeydown="javascript: return event.keyCode === 8 ||
event.keyCode === 46 ? true : !isNaN(Number(event.key))" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="2">
                </div>
              </div>
              <div class="single-resume-feild feild-flex-2">
                <div class="single-input">
                  <label for="Salary">cgpa :</label>
                  <input type="number" value="<?php echo $cgpa ?>" id="cgpa" step="0.01" name="cgpa" onkeydown="javascript: return event.keyCode === 8 ||
event.keyCode != 46 ? true : !isNaN(Number(event.key))" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="4">
                </div>
                <div class="single-input">
                  <label for="Expected"> Expected Salary:</label>
                  <input type="number" value="<?php echo $salary ?>" id="salary" name="salary" pattern="[0-9]" onkeydown="javascript: return event.keyCode === 8 ||
event.keyCode === 46 ? true : !isNaN(Number(event.key))" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10">
                </div>
              </div>
              <div class="single-resume-feild feild-flex-2">
                <div class="single-input">
                  <label for="Salary">Experience :</label>
                  <input type="number" step="0.01" placeholder="(in year)" value="<?php echo $experience ?>" id="exp" name="exp" onkeydown="javascript: return event.keyCode === 8 ||
event.keyCode != 46 ? true : !isNaN(Number(event.key))" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="4">
                </div>
                <div class="single-input">
                  <label for="Expected"> Website:</label>
                  <input type="text" value="<?php echo $website ?>" id="website" name="website">
                </div>
              </div>
              <div class="single-resume-feild ">
                <div class="single-input">
                  <label for="Bio">About Yourself:</label>
                  <textarea id="aboutMe"><?php echo $aboutMe ?></textarea>
                </div>
              </div>
            </div>
            <!-- Contact Info -->
            <div class="resume-box">
              <h3>Contact Information</h3>
              <div class="single-resume-feild feild-flex-2">
                <div class="single-input">
                  <label for="Phone">Phone:</label>
                  <input type="number" pattern="[0-9]" onkeydown="javascript: return event.keyCode === 8 ||
event.keyCode === 46 ? true : !isNaN(Number(event.key))" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="11" value="<?php echo $phone ?>" id="phone">
                </div>
                <div class="single-input">
                  <label for="Email">Email:</label>
                  <input type="text" id="email" value="<?php echo $email ?>" disabled>
                </div>
              </div>
              <!--<div class="single-resume-feild feild-flex-2">
            <div class="single-input">
                <label for="contry">contry:</label>
                <select id="contry">
                  <option>Arab Amirats</option>
                  <option>America</option>
                  <option>Netherlands</option>
                  <option>Russia</option>
                  <option selected="">Bangladesh</option>
                  <option>India</option>
                  <option>Pakistan</option>
                  <option>Brazil</option>
                  <option>Africa</option>
                </select>
            </div>
            <div class="single-input">
                <label for="City">City:</label>
                <input type="text" value="Dhaka" id="City">
            </div>
          </div> -->
              <div class="single-resume-feild feild-flex-2">
                <div class="single-input">
                  <label for="Zip">Address:</label>
                  <input type="text" value="<?php echo $address ?>" id="address">
                </div>
                <div class="single-input">
                  <label for="Address22">City:</label>
                  <input type="text" value="<?php echo $city ?>" id="city">
                </div>
              </div>
            </div>

            <!-- Social Info -->
            <div class="resume-box">
              <h3>social link</h3>
              <div class="single-resume-feild feild-flex-2">
                <div class="single-input">
                  <label for="twitter">
                    <i class="fa fa-twitter twitter"></i>
                    twitter
                  </label>
                  <input type="text" value="<?php echo $twitter ?>" id="twitter" name="twitter"  placeholder="https://www.twitter.com/username">
                </div>
                <div class="single-input">
                  <label for="twitter">
                    <i class="fab fa-facebook-f" aria-hidden="false"> </i>
                    facebook
                  </label>
                  <input type="text" value="<?php echo $facebook ?>" id="facebook" name="facebook" placeholder="https://www.facebook.com/username">
                </div>
              </div>
              <div class="single-resume-feild feild-flex-2">
                <div class="single-input">
                  <label for="google">
                    <i class="fa fa-google-plus google"></i>
                    Google
                  </label>
                  <input type="text" value="<?php echo $google ?>" id="google" name="google" placeholder="https://www.google.com/username">
                </div>
                <div class="single-input">
                  <label for="linkedin">
                    <i class="fas fa-dragon"></i>
                    linkedin
                  </label>
                  <input type="text" value="<?php echo $linkedn ?>" id="linkedin" name="twitter" placeholder="https://www.linkedin.com/username">
                </div>
              </div>
            </div>
            <div class="submit-resume">
              <input class="btn btn-primary btn-lg active" id="addEdu" value="Update" type="submit"></input>
              <span id="status_text" style="color:red"></span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



</body>

</html>