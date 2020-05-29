<?php
include "includes/db_connect.php";
session_start();

//$_SESSION["email"] = "zrsaimun@gmail.com";

if (!isset($_SESSION["email"])) {
  header("Location: ../logout.php");
}else{
  $email = $_SESSION['email'];
}



$name = $title = $facebook = $twitter = $linkedn = $aboutMe = "";
$skill_1 = $skill_2 = $skill_3 = $skill_4 = "";

$skill_1p = $skill_2p = $skill_3p = $skill_4p = "";

/*education-1=education-1y=education-1i=education-2=education-2y=education-2i=education-3=education-3y=education-3i=education-4=education-4y=education-4i="";*/

/*,facebook,linkedin,twitter,skill-1,skill-1p, skill-2,skill-2p, skill-3,skill-3p,skill-4,skill-4p*/


$sqlUserCheck = "SELECT email,cgpa,name,title,aboutMe,gender,facebook,linkedin,twitter,google,address,city,phone,website,age,salary,experience,picture,file_name FROM seekerinfo WHERE email = '$email'";
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
  $file_name = $row['file_name'];
}
if ($facebook==null) {
  $facebook='#';
  $fbtarget='';
}else{
  $fbtarget='_blank';
}
if ($twitter==null) {
  $twitter='#';
  $ttarget='';
}else{
  $ttarget='_blank';
}
if ($google==null) {
  $google='#';
  $gtarget='';
}else{
  $gtarget='_blank';
}
if ($linkedn==null) {
  $linkedn='#';
  $ltarget='';
}else{
  $ltarget='_blank';
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Profile</title>
  <link rel="stylesheet" href="../css/Employee/style1.css">
  <link rel="stylesheet" href="../css/Employee/bootstrap.css">
  <link rel="stylesheet" href="../css/Employee/fonts.css">
  <script src="https://kit.fontawesome.com/8a7775d0b9.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body ">

  <div class=" container" style="background:#f0f3fa none repeat scroll 0 0;border-radius: 8px;">

  <div class="dashboard">
  <div class="profile" style="padding-top: 3%">
    <div class="profilePicture">
      <img class="profile-light-image" src="uploads/<?php echo $picture ?>" alt="" width="169" height="169">
    </div>

    <div class="info">
      <h4> <?php echo $name ?> </h4>
      <h6><?php echo $title ?></h6>
    </div>

    <div class="social">
      <ul>
        <li><a class="social-icon" target="<?php echo $fbtarget ?>" href="<?php echo $facebook ?>"><i class="fab fa-facebook-f fa-lg"></i></a></li>
        <li><a class="social-icon" target="<?php echo $ltarget ?>" href="<?php echo $linkedn ?>"><i class="fab circle fa-linkedin-in fa-lg"></i></a></li>
        <li><a class="social-icon" target="<?php echo $ttarget ?>" href="<?php echo $twitter ?>"><i class="fa circle fa-twitter twitter fa-lg"></i></a></li>
        <li><a class="social-icon" target="<?php echo $gtarget ?>" href="<?php echo $google ?>"><i class="fa circle fa-google-plus google fa-lg"></i></a></li>

      </ul>
    </div>

    <div class="cv">
      <?php if ($file_name == "") {
        
      }else{?>
<a href="/uploads/<?php echo $file_name ?>" download class="btn btn-primary btn-lg active" role="button" aria-pressed="true" style="
    width: 100%;">Download CV</a>
      <?php } ?>
      
    </div>
  </div>
  <div class="profile-divider"></div>

  <br>



  <div class="personalInfo_div" style="display: flex">
    <div class="personalInfo">
      <div class="aboutMe">
        <p class="heading">About Me</p>
        <hr style="
    margin-bottom: 15px;
    margin-top: 5px;">
        <p class="text-style-1" style="font-size: 14px;margin-bottom: 20px;"> <?php echo $aboutMe ?> </p>
      </div>

      <!-- Professional Skill -->
      <div class="professionalSkill">
        <p class="heading">Professional skills</p>
        <hr style="
    margin-bottom: 15px;
    margin-top: 5px;">
        <div class="proskill" id="proskill" style="margin-bottom: 20px;">

          <?php
          $sqlUserCheck = "SELECT skill FROM seekerskill WHERE email = '$email' ";
          $result = mysqli_query($conn, $sqlUserCheck);

          while ($row = mysqli_fetch_array($result)) {
            $res = $row['skill'];
            $subR = explode(',', $res);
            $count = count($subR);

            for ($x = 0; $x < ($count - 1); $x++) {
              $r = explode(';', $subR[$x]); ?>
              <div class="pskill-1" style="margin-right: 25px;">
                <article class="progress-linear progress-bar-secondary animated" style="display: flex">
                  <div class="progress-linear-header" style="width:25%;">
                    <p class="progress-linear-title"><?php echo $r[0] ?></p>
                  </div>
                  <div class="progress" style="background-color: #9a9191; width:75%">
                    <div class="progress-bar progress-bar-warning " role="progressbar" style="width: <?php echo $r[1] ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $r[1] ?>%</div>
                  </div>
                </article>

              </div>


          <?php }
          }


          ?>

        </div>
      </div>

      <!-- Work Exp -->
      <div class="workExperience">
        <p class="heading">Work Experience</p>
        <hr style="
    margin-bottom: 15px;
    margin-top: 5px;">

        <div class="timeline">

          <?php
          $sqlUserCheck = "SELECT history FROM seekerworkexperience WHERE email = '$email' ";
          $result = mysqli_query($conn, $sqlUserCheck);

          while ($row = mysqli_fetch_array($result)) {
            $res = $row['history'];
            $subR = explode(',', $res);
            $count = count($subR);


            for ($x = 0; $x < ($count - 1); $x++) {
              $r = explode(';', $subR[$x]); ?>

              <div class="timeline-item">
                <div class="timeline-period">
                  <span><?php echo $r[0] ?></span></div>
                <div class="timeline-main">
                  <h5 class="timeline-title"><?php echo $r[1] ?></h5>
                  <p><?php echo $r[2] ?></p>
                </div>
              </div>


          <?php }
          }


          ?>



















        </div>
      </div>

      <!-- Education -->
      <div class="workExperience">
        <p class="heading">Education</p>
        <hr style="
    margin-bottom: 15px;
    margin-top: 5px;">

        <div class="timeline">

          <?php
          $sqlUserCheck = "SELECT history FROM seekereducation WHERE email = '$email' ";
          $result = mysqli_query($conn, $sqlUserCheck);

          while ($row = mysqli_fetch_array($result)) {
            $res = $row['history'];
            $subR = explode(',', $res);
            $count = count($subR);

            for ($x = 0; $x < ($count - 1); $x++) {
              $r = explode(';', $subR[$x]); ?>
              <div class="timeline-item">
                <div class="timeline-period">
                  <span><?php echo $r[0] ?></span></div>
                <div class="timeline-main">
                  <h5 class="timeline-title"><?php echo $r[1] ?></h5>
                  <p><?php echo $r[2] ?></p>
                </div>
              </div>

          <?php }
          }


          ?>

        </div>
      </div>




    </div>
    <div class="contactMe">
      <div class="infoo">
        <ul class="profile-info mt20 nopadding" style="margin-left: 10%;">
          <li>
            <i class="fa fa-map-marker"></i>
            <span><?php echo $address ?></span>
          </li>
          <li>
            <i class="fa fa-globe"></i>
            <a href="#"><?php echo $website ?></a>
          </li>
          <li>
            <i class="fa fa-money"></i>
            <span>$<?php echo $salary ?></span>
          </li>
          <li>
            <i class="fa fa-birthday-cake"></i>
            <span><?php echo $age ?> Years</span>
          </li>
          <li>
            <i class="fa fa-phone"></i>
            <span>+<?php echo $phone ?></span>
          </li>
          <li>
            <i class="fa fa-envelope"></i>
            <a href="#"><?php echo $email ?></a>
          </li>
        </ul>
      </div>

      <form class="form-corporate " data-form-output="form-output-global" data-form-type="contact" method="post" action="bat/rd-mailform.php" novalidate="novalidate">
        <h4>Contact <?php echo $name ?></h4>
        <div class="form-wrap">
          <input class="form-input form-control-has-validation form-control-last-child" id="contact-name" placeholder="Your Name" type="text" name="name" data-constraints="@Required"> <span class="form-validation"></span>
        </div>
        <div class="form-wrap">
          <input class="form-input form-control-has-validation form-control-last-child" id="contact-email" type="email" name="email" data-constraints="@Required @Email" placeholder="Email" Required><span class="form-validation"></span>
        </div>
        <div class="form-wrap">
          <input class="form-input form-control-has-validation form-control-last-child" id="contact-phone" type="text" name="phone" placeholder="Phone" data-constraints="@PhoneNumber"><span class="form-validation"></span>
        </div>
        <div class="form-wrap">
          <textarea class="form-input form-control-has-validation form-control-last-child" id="contact-message" placeholder="Message" name="message" data-constraints="@Required"></textarea><span class="form-validation"></span>
        </div>
        <div class="form-wrap">
          <button class="button button-block button-primary" type="submit">Send Message</button>
        </div>
      </form>
    </div>
  </div>
  </div>




  </div>
</body>

</html>










<!--

<div class="education">
          <p class="heading">Education</p>
          <hr>

          <div class="timeline">
            <div class="timeline-item">
              <div class="timeline-period"><span>University</span></div>
              <div class="timeline-main">
                <h5 class="timeline-title">Junior Marketer</h5>
                <p>Responsibilities: development and implementation of the Brand strategy,. </p>
              </div>
            </div>
            <div class="timeline-item">
              <div class="timeline-period"><span>HSC</span></div>
              <div class="timeline-main">
                <h5 class="timeline-title">Marketer</h5>
                <p>Responsibilities: development and implementation of the Brand strategy,..</p>
              </div>
            </div>
            <div class="timeline-item">
              <div class="timeline-period"><span>SSC</span></div>
              <div class="timeline-main">
                <h5 class="timeline-title">Marketing Director</h5>
                <p>Responsibilities: development and implementation of the Brand strategy,.</p>
              </div>
            </div>
          </div>

        </div>


-->