<?php
include "includes/db_connect.php";
session_start();

$degree = $year = $institution = $err = $emailInDB = "d";

//$_SESSION["email"] = "zrsaimun@gmail.com";
if (!isset($_SESSION["email"])) {
  header("Location: ../logout.php");
}else{
  $email = $_SESSION['email'];
  //$email= "abc@gmail.com";
}

/* mysqli_real_escape_string() helps prevent sql injection */



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/Employee/myDashboard.css">
  <link rel="stylesheet" href="../css/Employee/bootstrap.css">
  <link rel="stylesheet" href="../css/Employee/fonts.css">
  <script src="https://kit.fontawesome.com/8a7775d0b9.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <sc.. src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></sc../css/Employee
    $(document).ready(function() {
      var i = 2;
      var j = 0;
      var nextClick = 0;


      $('#addEdu').click(function() {

        var name = $('#name').val();
        var percentage = $('#percentage').val();

        var email = '<?php echo $email ?>';

        var postData = 'percentage=' + percentage + '&name=' + name + '&email=' + email;

        $.ajax({
          url: "addSkill.php",
          type: "POST",
          data: postData,
          success: function(data, status, xhr) {
            //if success then just output the text to the status div then clear the form inputs to prepare for new data
            $("#status_text").html(data);
            $('#degree').val('');
            $('#year').val('');
          },
          error: function(jqXHR, status, errorThrown) {
            //if fail show error and server status
            $("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);
          }
        })


      });

    });
  </script>

</head>

<body>


  <div class="container" style="background: #f0f3fa none repeat scroll 0 0; height:1000px">
    <div class="dashboard-right" style="border-radius: 5%">
      <div class="candidate-profile">

      <h3 style="text-align: center"> Applied Jobs</h3>
      
      <hr>

        <form onsubmit="return false">

          <div class="table100 ver1 m-b-110">
            <div class="table100-head">
              <table>
                <thead>
                  <tr class="row100 head">
                    <th class="cell100 column1">JobId</th>
                    <th class="cell100 column2">Designation</th>
                    <th class="cell100 column3">Company Name</th>
                    <th class="cell100 column4">Date</th>

                  </tr>
                </thead>
              </table>
            </div>

            <div class="table100-body js-pscroll">
              <table>
                <tbody>


                  <?php


                  $sqlUserCheck = "SELECT appliedJobs FROM seekerappliedjobs WHERE email = '$email' ";
                  $result = mysqli_query($conn, $sqlUserCheck);

                  while ($row = mysqli_fetch_array($result)) {
                    $res = $row['appliedJobs'];
                    $subR = explode(',', $res);
                    $count = count($subR);
                    for ($x = 0; $x < ($count - 1); $x++) {
                      $r = explode(';', $subR[$x]);
                      echo '<tr class="row100 body">';
                      echo '<td class="cell100 column1">' . $r[0] . '</td>';


                  $sqlUserCheck = "SELECT employer,title FROM job WHERE job_id = '$r[0]' ";
                  $result = mysqli_query($conn, $sqlUserCheck);
                  while ($row = mysqli_fetch_array($result)){
                    $company = $row['employer'];
                    $designation = $row['title'];
                    echo '<td class="cell100 column2">' . $designation . '</td>';
                    echo '<td class="cell100 column3">' . $company . '</td>';
                  }
                      echo '<td class="cell100 column4">' . $r[1] . '</td>';
                      echo "</tr>";
                    }
                  }

                  ?>


                </tbody>
              </table>
            </div>
          </div>










        </form>
      </div>
    </div>

  </div>



</body>

</html>