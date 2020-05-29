<?php 


include "includes/db_connect.php";

if(isset($_POST['jobID']) || isset($_POST['email'])|| isset($_POST['date']) )
{
	 $n= $_POST['jobID'];
	 $e= $_POST['email'];
	 $d= $_POST['date'];
	 
	$appliedJobs = $n.";".$d.","; 
	$sqltemp = "SELECT * from sekerappliedjobs where email='$e';";
	$resulttemp = mysqli_query($conn, $sqltemp);
	if(mysqli_num_rows($resulttemp)<=0){
		$sql = "INSERT INTO seekerappliedjobs(email, appliedJobs) VALUES('$e','$appliedJobs');";
	}
	else{
		$sql = "UPDATE seekerappliedjobs SET  appliedJobs=concat(appliedJobs,'$appliedJobs') WHERE email='$e';";
	}
	mysqli_query($conn, $sql);

	//Record candidates in job
	$user=$_SESSION['username'];
	$candidates = $user . ";" . $d . ",";

	$sqltemp = "SELECT * from job where ID='$n';";
	$resulttemp = mysqli_query($conn, $sqltemp);
	if(mysqli_num_rows($resulttemp)<=0){
		$sql = "INSERT INTO job(candidates) VALUES('$candidates');";
	}
	else{
		$sql = "UPDATE job SET candidates=concat(candidates,'$appliedJobs') WHERE ID='$n';";
	}
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











				