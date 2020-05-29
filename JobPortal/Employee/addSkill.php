<?php 


include "includes/db_connect.php";

if(isset($_POST['name']) || isset($_POST['percentage']) || isset($_POST['email']) )
{
	 $n= $_POST['name'];
	 $p= $_POST['percentage'];
	 $e= $_POST['email'];
	 
    $skillHistory = $n.";".$p."," ; 
	$sql = "UPDATE seekerskill SET  skill=concat(skill,'$skillHistory') WHERE email='$e';";

	mysqli_query($conn, $sql);
	echo "skill added";
	
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











				