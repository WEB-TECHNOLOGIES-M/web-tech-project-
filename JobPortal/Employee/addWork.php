<?php 


include "includes/db_connect.php";

if(isset($_POST['year']) || isset($_POST['institution']) ||isset($_POST['degree']) || isset($_POST['email']) )
{
	 $y= $_POST['year'];
	 $i= $_POST['institution'];
	 $d= $_POST['degree'];
	 $e= $_POST['email'];

    $eduHistory = $y.";".$d.";".$i.","; ;
	$sql = "UPDATE seekerworkexperience SET  history=concat(history,'$eduHistory') WHERE email='$e';";

	mysqli_query($conn, $sql);
	echo "Work Experience added";
	
}




     /*   alert("ajax loading..");
        $.post("addEducation.php",
        {
          year: document.getElementById('institution').value,
					institution: document.getElementById('institution').value,
					degree: document.getElementById('degree').value,
          d: "40"
				});


				var institution = $('#institution').val();
                var name = $('#degree').val();
                var brand = $('#year').val();

*/

				?>











				