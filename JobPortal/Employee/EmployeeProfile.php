<?php
session_start();

include "includes/db_connect.php";

//$_SESSION["email"] = "zrsaimun@gmail.com";

if (!isset($_SESSION["email"])) {
   header("location: ../logout.php");
   //header('Refresh: 0, url = /Root_Dir/logout.php');
} else {
   $email = $_SESSION["email"];
}


$sqlUserCheck = "SELECT email,duration FROM expire";
$result = mysqli_query($conn, $sqlUserCheck);

while ($row = mysqli_fetch_array($result)) {

   $em = $row['email'];
   $du = $row['duration'];
   $sql = "DELETE FROM expire
   WHERE email='$em' AND ts_created < DATE_ADD(NOW(),INTERVAL -($du) MINUTE)";
   $resultComments = mysqli_query($conn, $sql);
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Employee Profile</title>



   <link rel="stylesheet" href="../css/Employee/style1 - Copy.css">
   <link rel="stylesheet" href="../css/Employee/bootstrap.css">
   <link rel="stylesheet" href="../css/Employee/fonts.css">

   <script src="https://kit.fontawesome.com/8a7775d0b9.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



   <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

   <script>
      $(document).ready(function() {
         $('#dashboard-Right').load('myDashboard.php');
         document.getElementById("dashbooard1").className = "active";


         $('#profile').click(function() {


            // alert("ajax loading..");
            //document.getElementById("profile1").classList.remove("inactive");
            document.getElementById("profile1").className = "active";

            document.getElementById("education1").className = "inactive";
            document.getElementById("resume1").className = "inactive";
            document.getElementById("skill1").className = "inactive";
            document.getElementById("changePassword1").className = "inactive";
            document.getElementById("jobSearch1").className = "inactive";
            document.getElementById("dashbooard1").className = "inactive";
            document.getElementById("cv1").className = "inactive";
            document.getElementById("work1").className = "inactive";


            $('#dashboard-Right').load('myProfile.php');
            return false;
         });
         $('#education').click(function() {
            document.getElementById("cv1").className = "inactive";

            //document.getElementById("education1").classList.remove("inactive");
            document.getElementById("education1").className = "active";

            document.getElementById("profile1").className = "inactive";
            document.getElementById("resume1").className = "inactive";
            document.getElementById("skill1").className = "inactive";
            document.getElementById("changePassword1").className = "inactive";
            document.getElementById("jobSearch1").className = "inactive";
            document.getElementById("dashbooard1").className = "inactive";
            //alert("ajax loading..");
            document.getElementById("work1").className = "inactive";

            $('#dashboard-Right').load('myEducation.php');
            return false;
         });
         $('#resume').click(function() {
            document.getElementById("cv1").className = "inactive";

            document.getElementById("profile1").className = "inactive";

            document.getElementById("education1").className = "inactive";
            document.getElementById("resume1").className = "active";
            document.getElementById("skill1").className = "inactive";
            document.getElementById("changePassword1").className = "inactive";
            document.getElementById("jobSearch1").className = "inactive";
            document.getElementById("dashbooard1").className = "inactive";
            //alert("ajax loading..");
            document.getElementById("work1").className = "inactive";

            $('#dashboard-Right').load('EmployeeResume.php');
            return false;
         });
         $('#skill').click(function() {
            document.getElementById("profile1").className = "inactive";
            document.getElementById("cv1").className = "inactive";

            document.getElementById("education1").className = "inactive";
            document.getElementById("resume1").className = "inactive";
            document.getElementById("skill1").className = "active";
            document.getElementById("changePassword1").className = "inactive";
            document.getElementById("jobSearch1").className = "inactive";
            document.getElementById("dashbooard1").className = "inactive";
            document.getElementById("work1").className = "inactive";


            $('#dashboard-Right').load('mySkill.php');
            return false;
         });
         $('#cv').click(function() {
            document.getElementById("profile1").className = "inactive";

            document.getElementById("education1").className = "inactive";
            document.getElementById("resume1").className = "inactive";
            document.getElementById("skill1").className = "inactive";
            document.getElementById("cv1").className = "active";
            document.getElementById("changePassword1").className = "inactive";
            document.getElementById("jobSearch1").className = "inactive";
            document.getElementById("dashbooard1").className = "inactive";
            document.getElementById("work1").className = "inactive";


            $('#dashboard-Right').load('myUploadCV.php');
            return false;
         });
         $('#changePassword').click(function() {

            document.getElementById("profile1").className = "inactive";
            document.getElementById("cv1").className = "inactive";

            document.getElementById("education1").className = "inactive";
            document.getElementById("resume1").className = "inactive";
            document.getElementById("skill1").className = "inactive";
            document.getElementById("changePassword1").className = "active";
            document.getElementById("jobSearch1").className = "inactive";
            document.getElementById("dashbooard1").className = "inactive";
            document.getElementById("work1").className = "inactive";

            //alert("ajax loading..");

            $('#dashboard-Right').load('myChangePassword.php');
            return false;
         });
         $('#jobSearch').click(function() {


            document.getElementById("profile1").className = "inactive";
            document.getElementById("cv1").className = "inactive";

            document.getElementById("education1").className = "inactive";
            document.getElementById("resume1").className = "inactive";
            document.getElementById("skill1").className = "inactive";
            document.getElementById("changePassword1").className = "inactive";
            document.getElementById("jobSearch1").className = "active";
            document.getElementById("dashbooard1").className = "inactive";
            document.getElementById("work1").className = "inactive";


            //alert("ajax loading..");

            $('#dashboard-Right').load('jobSearch.php');
            return false;
         });
         $('#dashbooard').click(function() {

            document.getElementById("profile1").className = "inactive";
            document.getElementById("cv1").className = "inactive";

            document.getElementById("education1").className = "inactive";
            document.getElementById("resume1").className = "inactive";
            document.getElementById("skill1").className = "inactive";
            document.getElementById("changePassword1").className = "inactive";
            document.getElementById("jobSearch1").className = "inactive";
            document.getElementById("dashbooard1").className = "active";
            document.getElementById("work1").className = "inactive";


            //alert("ajax loading..");

            $('#dashboard-Right').load('myDashboard.php');
            return false;
         });
         $('#work').click(function() {

            document.getElementById("profile1").className = "inactive";
            document.getElementById("cv1").className = "inactive";
            document.getElementById("dashbooard1").className = "inactive";
            document.getElementById("education1").className = "inactive";
            document.getElementById("resume1").className = "inactive";
            document.getElementById("skill1").className = "inactive";
            document.getElementById("changePassword1").className = "inactive";
            document.getElementById("jobSearch1").className = "inactive";
            document.getElementById("work1").className = "active";

            //alert("ajax loading..");

            $('#dashboard-Right').load('myWork.php');
            return false;
         });
         /*$('#logout').click(function() {
            header("Location: ../login.php");
         });*/

      });
   </script>



</head>

<body style="background: #f0f3fa none repeat scroll 0 0">


   <div class="container">



      <div class="profile">
         <div class="dashboard-Leftt">

            <div class="col-lg-3 col-md-12 dashboard-left-border">
               <div class="dashboard-left">
                  <ul class="dashboard-menu">
                     <li class="inactive" id="dashbooard1"><a href="#" id="dashbooard"><i class="fa fa-tachometer"></i>Dashboard</a></li>
                     <li class="inactive" id="profile1"><a href="#" id="profile"><i class="fa fa-users"></i>Personal Info</a></li>
                     <li class="inactive" id="education1"><a id="education" href="#"><i class="fa fa-envelope-open"></i>Education</a></li>
                     <li class="inactive" id="skill1"><a id="skill" href="#"><i class="fa fa-rocket"></i>skill</a></li>
                     <li class="inactive" id="work1"><a id="work" href="#"><i class="fa fa-rocket"></i>Work Experience</a></li>
                     <li class="inactive" id="cv1"><a id="cv" href="#"><i class="fa fa-rocket"></i>Upload CV/Picture</a></li>
                     <li class="inactive" id="changePassword1"><a id="changePassword" href="#"><i class="fa fa-lock"></i>change password</a></li>
                     <li class="inactive" id="resume1"><a id="resume" href="#"><i class="fa fa-briefcase"></i>My Resume</a></li>
                     <li class="inactive" id="jobSearch1"><a id="jobSearch" href="#"><i class="fa fa-rocket"></i>Job Search</a></li>
                     <li class="inactive" id="logout1"><a id="logout" href="../logout.php"><i class="fa fa-power-off"></i>LogOut</a></li>
                  </ul>
               </div>
            </div>







         </div>
         <div class="dashboard-Right" id="dashboard-Right">

         </div>
      </div>


   </div>








</body>

</html>


<!--
   <li>
               <button id="dashboard">
               <i class="fa fa-tachometer"></i>
               Dashboard
               </button>
            </li>
            <li class="active">
               <button >
               <i class="fa fa-users"></i>
               MyProfile
               </a>
            </li>
            <li><button id="nessage"><i class="fa fa-envelope-open"></i>messages</a></li>
            <li><button id="manageJob"><i class="fa fa-briefcase"></i>manage jobs</a></li>
            <li><button id="earning"><i class="fa fa-rocket"></i>earnings</a></li>
            <li><button id="changePassword"><i class="fa fa-lock"></i>change password</a></li>
            <li><button id="logout"><i class="fa fa-power-off"></i>LogOut</></li>
-->