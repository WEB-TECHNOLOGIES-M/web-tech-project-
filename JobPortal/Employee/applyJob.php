<?php 


include "includes/db_connect.php";

if(isset($_POST['jobID']) || isset($_POST['email'])|| isset($_POST['date']) )
{
	 $n= $_POST['jobID'];
	 $e= $_POST['email'];
	 $d= $_POST['date'];
	 
    $appliedJobs = $n.";".$d.","; 
	$sql = "UPDATE seekerappliedjobs SET  appliedJobs=concat(appliedJobs,'$appliedJobs') WHERE email='$e';";

	mysqli_query($conn, $sql);
	//echo "job Applied";



	/*concat(appliedJobs,'$appliedJobs')*/ 
	
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











				