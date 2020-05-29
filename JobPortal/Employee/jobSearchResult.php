<?php

session_start();
$_SESSION['nOp']='';

$err = "d";
$matchJob = "false";
?>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script>
	$(document).ready(function() {
		var i = 2;
		var j = 0;
		var nextClick = 0;


		//$('ul').on('click','li'.find("#apply"),function(event)
		$("li").find(".btn").click(function() {
			//alert("fucc");
			//var jobID = $("li").find("#jobID").attr('value');
			//var jobID= $(this).parent('li').find('#jobID').val();
			//var jobID= $(this).attr('jobID');
			var jobID = $(this).attr("value");

			var id = $(this).attr('id');
			document.getElementById(id).setAttribute("disabled", "disabled");
			document.getElementById(id).innerHTML = "Applied";

			//var idli = $(this).closest("li").attr("id");
			//var idli= $(this).parents("li")[0].id;
			//alert(id);

			var email = '<?php echo $_SESSION['email'] ?>';
			var date = '<?php echo $date = date('d-m-y') ?>';
			//alert(jobID);
			//alert(date);


			var postData = 'jobID=' + jobID + '&email=' + email + '&date=' + date;

			$.ajax({
				url: "applyJob.php",
				type: "POST",
				data: postData,
				success: function(data, status, xhr) {
					//if success then just output the text to the status div then clear the form inputs to prepare for new data
					//$("#status_text").html(data);
					//document.getElementById('status_text').innerText="job Applied mf";
					//$("this.btn").attr("disabled",true);
					//var j = $(this).attr("value");
					//j.attr("disabled", true);
					//$(this).attr('value').attr("disabled",true);
					//var ID = $(this).attr('id');
					//ID.attr("disabled", true);

				},
				error: function(jqXHR, status, errorThrown) {
					//if fail show error and server status
					$("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);
				}
			})


		});

		//Next Previous

	});
</script>



<?php


include "includes/db_connect.php";
$catagory = $type = $salar = $exp = $location = $email = "";

if (isset($_POST['type']) || isset($_POST['catagory']) || isset($_POST['experience']) || isset($_POST['salary']) || isset($_POST['location']) || isset($_POST['email'])|| isset($_POST['resPerPage'])) {
	$_SESSION['catagory'] = $_POST['catagory'];
	$_SESSION['type'] = $_POST['type'];
	$_SESSION['salary'] = $_POST['salary'];
	$_SESSION['exp'] = $_POST['exp'];
	$_SESSION['location'] = $_POST['location'];
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['resPerPage'] = $_POST['resPerPage'];
	//echo "*************";
	$lv = $_SESSION['resPerPage'];
	//echo $lv;

	/*echo $catagory = $_POST['catagory'];
	echo $type = $_POST['type'];
	echo $salar =  $_POST['salary'];
	echo $exp = $_POST['exp'];
	echo $location = $_POST['location'];
	echo $email =  $_POST['email'];*/

	 $catagory = $_SESSION['catagory'];
	 $type = $_SESSION['type'];
	 $salar = $_SESSION['salary'];
	 $exp = $_SESSION['exp'];
	 $location = $_SESSION['location'];
	 $email =  $_SESSION['email'];

	//{*/	///MySQL Query of Job Search result

	if (strpos($salar, "<") && strpos($exp, "<")) {
		$salar2 = explode('<', $salar);
		$exp2 = explode('<', $exp);
		//echo "< detected";
		/*echo $salar2[1];
		echo $exp2[1];*/
		$commentsQuery = "SELECT job_id,employer,title,location,salary,type,pic FROM job WHERE location='$location' AND type='$type' AND salary <='$salar2[1]' AND catagory='$catagory' AND experience <='$exp2[1]' limit $lv";
		$result = mysqli_query($conn, $commentsQuery);

		$commentsPerPage = $lv;
		$totalCommentsQuery = "SELECT COUNT(*) as t_c FROM job WHERE location='$location' AND type='$type' AND salary <='$salar2[1]' AND catagory='$catagory' AND experience <='$exp2[1]' limit $lv ";
		$resultTotalComments = mysqli_query($conn, $totalCommentsQuery);
		$rowTotalComments = mysqli_fetch_assoc($resultTotalComments);
		$tC = $rowTotalComments['t_c'];
		$np = ceil($tC / $commentsPerPage);
		$_SESSION['nOp'] = $np;
		//echo "+++++";
		//echo $_SESSION['nOp'];
	} elseif (strpos($salar, "<") && strpos($exp, "-")) {
		$salar2 = explode('<', $salar);
		$exp2 = explode('-', $exp);
		//echo "< - detected";
		/*echo $salar2[1];
		echo $exp2[1];*/
		$commentsQuery = "SELECT job_id,employer,title,location,salary,type,pic FROM job WHERE location='$location' AND type='$type' AND salary <='$salar2[1]' AND catagory='$catagory' AND experience BETWEEN '$exp2[0]' AND '$exp2[1]' limit $lv";
		$result = mysqli_query($conn, $commentsQuery);
	} elseif (strpos($salar, "<") && strpos($exp, ">")) {
		$salar2 = explode('<', $salar);
		$exp2 = explode('>', $exp);
		//echo "< > detected";
		/*echo $salar2[1];
		echo $exp2[1];*/
		$commentsQuery = "SELECT job_id,employer,title,location,salary,type,pic FROM job WHERE location='$location' AND type='$type' AND salary <='$salar2[1]' AND catagory='$catagory' AND experience =>'$exp2[1]' limit $lv";
		$result = mysqli_query($conn, $commentsQuery);
	} elseif (strpos($salar, "-") && strpos($exp, "<")) {
		$salar2 = explode('-', $salar);
		$exp2 = explode('<', $exp);
		//echo "- detected";
		/*echo $salar2[0];
		echo $exp2[0];
		echo $salar2[1];
		echo $exp2[1];*/
		$commentsQuery = "SELECT job_id,employer,title,location,salary,type,pic FROM job WHERE location='$location' AND type='$type' AND salary BETWEEN '$salar2[0]' AND '$salar2[1]' AND catagory='$catagory' AND experience <='$exp2[1]' limit $lv";
		$result = mysqli_query($conn, $commentsQuery);
	} elseif (strpos($salar, "-") && strpos($exp, "-")) {
		$salar2 = explode('-', $salar);
		$exp2 = explode('-', $exp);
		//echo "- detected";
		/*echo $salar2[0];
		echo $exp2[0];
		echo $salar2[1];
		echo $exp2[1];*/
		$commentsPerPage = $lv;
		//echo $commentsPerPage;
		$commentsQuery = "SELECT job_id,employer,title,location,salary,type,pic FROM job WHERE location='$location' AND type='$type' AND salary BETWEEN '$salar2[0]' AND '$salar2[1]' AND catagory='$catagory' AND experience BETWEEN '$exp2[0]' AND '$exp2[1]' limit $lv ";
		$result = mysqli_query($conn, $commentsQuery);

		/*$commentsPerPage = $lv;
		$totalCommentsQuery = "SELECT COUNT(*) as t_c FROM job WHERE location='$location' AND type='$type' AND salary BETWEEN '$salar2[0]' AND '$salar2[1]' AND catagory='$catagory' AND experience BETWEEN '$exp2[0]' AND '$exp2[1]' limit '$lv'";
		$resultTotalComments = mysqli_query($conn, $totalCommentsQuery);
		$rowTotalComments = mysqli_fetch_assoc($resultTotalComments);
		$tC = $rowTotalComments['t_c'];
		$np = ceil($tC / $commentsPerPage);
		$_SESSION['nOp'] = ;*/
		//echo "+++++";
		
		//echo $_SESSION['nOp'];
	} elseif (strpos($salar, "-") && strpos($exp, ">")) {
		$salar2 = explode('-', $salar);
		$exp2 = explode('>', $exp);
		//echo "- detected";
		/*echo $salar2[0];
		echo $exp2[0];
		echo $salar2[1];
		echo $exp2[1];*/
		$commentsQuery = "SELECT job_id,employer,title,location,salary,type,pic FROM job WHERE location='$location' AND type='$type' AND salary BETWEEN '$salar2[0]' AND '$salar2[1]' AND catagory='$catagory' AND experience >= '$exp2[1]' limit $lv";
		$result = mysqli_query($conn, $commentsQuery);
	} elseif (strpos($salar, ">") && strpos($exp, "<")) {
		$salar2 = explode('>', $salar);
		$exp2 = explode('<', $exp);
		//echo "> detected";
		/*echo $salar2[1];
		echo $exp2[1];*/
		$commentsQuery = "SELECT job_id,employer,title,location,salary,type,pic FROM job WHERE location='$location' AND type='$type' AND salary >='$salar2[1]' AND catagory='$catagory' AND experience <='$exp2[1]' limit $lv";
		$result = mysqli_query($conn, $commentsQuery);
	} elseif (strpos($salar, ">") && strpos($exp, "-")) {
		$salar2 = explode('>', $salar);
		$exp2 = explode('-', $exp);
		//echo "> detected";
		/*echo $salar2[1];
		echo $exp2[1];*/
		$commentsQuery = "SELECT job_id,employer,title,location,salary,type,pic FROM job WHERE location='$location' AND type='$type' AND salary >='$salar2[1]' AND catagory='$catagory' AND experience BETWEEN '$exp2[0]' AND '$exp2[1]' limit $lv";
		$result = mysqli_query($conn, $commentsQuery);
	} elseif (strpos($salar, ">") && strpos($exp, ">")) {
		$salar2 = explode('>', $salar);
		$exp2 = explode('>', $exp);
		//echo "> detected";
		/*echo $salar2[1];
		echo $exp2[1];*/
		$commentsQuery = "SELECT job_id,employer,title,location,salary,type,pic FROM job WHERE location='$location' AND type='$type' AND salary >='$salar2[1]' AND catagory='$catagory' AND experience >='$exp2[1]' limit $lv";
		$result = mysqli_query($conn, $commentsQuery);
	} else {
		//echo "< NOT detected";
	}
	//}*/

	/*$commentsPerPage = 3;
	$commentsQuery = "select * from job limit $commentsPerPage";
	$resultComments = mysqli_query($conn, $commentsQuery);
	$totalCommentsQuery = "SELECT COUNT(*) as t_c FROM job WHERE location='$location' AND type='$type' ";
	$resultTotalComments = mysqli_query($conn, $totalCommentsQuery);
	$rowTotalComments = mysqli_fetch_assoc($resultTotalComments);
	$tC = $rowTotalComments['t_c'];
	$np = ceil($tC / $commentsPerPage);
	$_SESSION['nOp'] = $np;
	echo "+++++";
	echo $_SESSION['nOp'];*/
} else if (isset($_POST['startingVal'])) {
	$stv = $_POST['startingVal'];
	//$np = $_POST['np'];
	$nextClick = $_POST['nextClick1'];
	 //echo $nextClick;
	 $catagory = $_SESSION['catagory'];
	 $type = $_SESSION['type'];
	 $salar = $_SESSION['salary'];
	 $exp = $_SESSION['exp'];
	 $location = $_SESSION['location'];
	 $email =  $_SESSION['email'];
	 $lv= $_SESSION['resPerPage'];

	/*$commentsQuery = "SELECT job_id,employer,title,location,salary,type FROM job WHERE location='$location' AND type='$type' limit $stv, 3";
	$result = mysqli_query($conn, $commentsQuery);*/

	//{*/ //MySQL Query of Job Search result
	if (strpos($salar, "<") && strpos($exp, "<")) {
		$salar2 = explode('<', $salar);
		$exp2 = explode('<', $exp);
		//echo "< detected";
		/*echo $salar2[1];
		echo $exp2[1];*/
		$commentsQuery = "SELECT job_id,employer,title,location,salary,type,pic FROM job WHERE location='$location' AND type='$type' AND salary <='$salar2[1]' AND catagory='$catagory' AND experience <='$exp2[1]' limit $stv, $lv";
		$result = mysqli_query($conn, $commentsQuery);
	} elseif (strpos($salar, "<") && strpos($exp, "-")) {
		$salar2 = explode('<', $salar);
		$exp2 = explode('-', $exp);
		//echo "< - detected";
		/*echo $salar2[1];
		echo $exp2[1];*/
		$commentsQuery = "SELECT job_id,employer,title,location,salary,type,pic FROM job WHERE location='$location' AND type='$type' AND salary <='$salar2[1]' AND catagory='$catagory' AND experience BETWEEN '$exp2[0]' AND '$exp2[1]' limit $stv, $lv";
		$result = mysqli_query($conn, $commentsQuery);
	} elseif (strpos($salar, "<") && strpos($exp, ">")) {
		$salar2 = explode('<', $salar);
		$exp2 = explode('>', $exp);
		//echo "< > detected";
		/*echo $salar2[1];
		echo $exp2[1];*/
		$commentsQuery = "SELECT job_id,employer,title,location,salary,type,pic FROM job WHERE location='$location' AND type='$type' AND salary <='$salar2[1]' AND catagory='$catagory' AND experience =>'$exp2[1]' limit $stv, $lv";
		$result = mysqli_query($conn, $commentsQuery);
	} elseif (strpos($salar, "-") && strpos($exp, "<")) {
		$salar2 = explode('-', $salar);
		$exp2 = explode('<', $exp);
		//echo "- detected";
		/*echo $salar2[0];
		echo $exp2[0];
		echo $salar2[1];
		echo $exp2[1];*/
		$commentsQuery = "SELECT job_id,employer,title,location,salary,type,pic FROM job WHERE location='$location' AND type='$type' AND salary BETWEEN '$salar2[0]' AND '$salar2[1]' AND catagory='$catagory' AND experience <='$exp2[1]' limit $stv, $lv";
		$result = mysqli_query($conn, $commentsQuery);
	} elseif (strpos($salar, "-") && strpos($exp, "-")) {
		$salar2 = explode('-', $salar);
		$exp2 = explode('-', $exp);
		//echo "- detected";
		/*echo $salar2[0];
		echo $exp2[0];
		echo $salar2[1];
		echo $exp2[1];*/
		$commentsQuery = "SELECT job_id,employer,title,location,salary,type,pic FROM job WHERE location='$location' AND type='$type' AND salary BETWEEN '$salar2[0]' AND '$salar2[1]' AND catagory='$catagory' AND experience BETWEEN '$exp2[0]' AND '$exp2[1]' limit $stv, $lv";
		$result = mysqli_query($conn, $commentsQuery);
		$commentsPerPage = 3;
		$totalCommentsQuery = "SELECT COUNT(*) as t_c FROM job WHERE location='$location' AND type='$type' AND salary BETWEEN '$salar2[0]' AND '$salar2[1]' AND catagory='$catagory' AND experience BETWEEN '$exp2[0]' AND '$exp2[1]' limit 3";
		$resultTotalComments = mysqli_query($conn, $totalCommentsQuery);
		$rowTotalComments = mysqli_fetch_assoc($resultTotalComments);
		$tC = $rowTotalComments['t_c'];
		$np = ceil($tC / $commentsPerPage);
		$_SESSION['nOp'] = $np;
		//echo "+++++";
		//echo $_SESSION['nOp'];
	} elseif (strpos($salar, "-") && strpos($exp, ">")) {
		$salar2 = explode('-', $salar);
		$exp2 = explode('>', $exp);
		//echo "- detected";
		/*echo $salar2[0];
		echo $exp2[0];
		echo $salar2[1];
		echo $exp2[1];*/
		$commentsQuery = "SELECT job_id,employer,title,location,salary,type,pic FROM job WHERE location='$location' AND type='$type' AND salary BETWEEN '$salar2[0]' AND '$salar2[1]' AND catagory='$catagory' AND experience >= '$exp2[1]' limit $stv, $lv";
		$result = mysqli_query($conn, $commentsQuery);
	} elseif (strpos($salar, ">") && strpos($exp, "<")) {
		$salar2 = explode('>', $salar);
		$exp2 = explode('<', $exp);
		//echo "> detected";
		/*echo $salar2[1];
		echo $exp2[1];*/
		$commentsQuery = "SELECT job_id,employer,title,location,salary,type,pic FROM job WHERE location='$location' AND type='$type' AND salary >='$salar2[1]' AND catagory='$catagory' AND experience <='$exp2[1]' limit $stv, $lv";
		$result = mysqli_query($conn, $commentsQuery);
	} elseif (strpos($salar, ">") && strpos($exp, "-")) {
		$salar2 = explode('>', $salar);
		$exp2 = explode('-', $exp);
		//echo "> detected";
		/*echo $salar2[1];
		echo $exp2[1];*/
		$commentsQuery = "SELECT job_id,employer,title,location,salary,type,pic FROM job WHERE location='$location' AND type='$type' AND salary >='$salar2[1]' AND catagory='$catagory' AND experience BETWEEN '$exp2[0]' AND '$exp2[1]' limit $stv, $lv";
		$result = mysqli_query($conn, $commentsQuery);
	} elseif (strpos($salar, ">") && strpos($exp, ">")) {
		$salar2 = explode('>', $salar);
		$exp2 = explode('>', $exp);
		//echo "> detected";
		/*echo $salar2[1];
		echo $exp2[1];*/
		$commentsQuery = "SELECT job_id,employer,title,location,salary,type,pic FROM job WHERE location='$location' AND type='$type' AND salary >='$salar2[1]' AND catagory='$catagory' AND experience >='$exp2[1]' limit $stv, $lv";
		$result = mysqli_query($conn, $commentsQuery);
	} else {
		//echo "< NOT detected";
	}
	//}*/
}


?>

<?php

while ($row = mysqli_fetch_array($result)) {

	$jobId = $row['job_id'];

?>

	<li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">


		<a href="../jobDesc.php?jobID=<?php echo $jobId ?>" target="_blank" style="width: 80%"></a>

		<div class="job-listing-logo">
			<img src="uploads/<?php echo $row['pic'] ?>" alt="Free Website Template by Free-Template.co" class="img-fluid">
		</div>

		<div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4" style="width: 75%!important">
			<div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
				<h2><?php echo $row['title'] ?> </h2>
				<!--<input type="text" id="jobID" name="" value="<?php /*echo $row['job_id'] */ ?>"> -->
				<h6><?php echo $row['job_id'] ?> </h6>
				<strong> <?php echo $row['employer'] ?> </strong>
			</div>
			<div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
				<i class="fas fa-map-marker-alt"></i> <label for="">&nbsp; <?php echo $row['location'] ?></label><br>
				<i class="fas fa-donate"></i> <label for="">&nbsp; $<?php echo $row['salary'] ?></label>

			</div>
			<div class="job-listing-meta">
				<span class="badge badge-info" style="margin-top: 4px"><?php echo $row['type'] ?></span>
			</div>
			<div>
				<form onsubmit="return false">
					<?php
					$commentsQuery1 = "SELECT appliedJobs FROM seekerappliedjobs WHERE email='$email' ";
					$result1 = mysqli_query($conn, $commentsQuery1);

					while ($row = mysqli_fetch_array($result1)) {
						$res1 = $row['appliedJobs'];
						$subR = explode(',', $res1);
						$count = count($subR);
						for ($x = 0; $x < ($count - 1); $x++) {
							$r = explode(';', $subR[$x]);
							if ($r[0] == $jobId) {
								$matchJob = "true";
								break;
							} else {
								$matchJob = "false";
							}
						}
					}

					?>

					<?php if ($matchJob == "true") { ?>
						<button class="btn btn-primary btn-sm active" style="width: 100%" id="<?php echo $jobId ?>" value="<?php echo $jobId ?>" type="submit" disabled> Applied</button>

					<?php } else { ?>
						<button class="btn btn-primary btn-sm active" style="width: 100%" id="<?php echo $jobId ?>" value="<?php echo $jobId ?>" type="submit"> Apply</button>
					<?php } ?>






				</form>
			</div>

		</div>
	</li>
<?php }

?>