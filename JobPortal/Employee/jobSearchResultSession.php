<?php

session_start();
//$_SESSION['nOp']='';

$err = "d";
$matchJob = "false";
?>



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
		$commentsPerPage = $lv;
		$totalCommentsQuery = "SELECT COUNT(*) as t_c FROM job WHERE location='$location' AND type='$type' AND salary <='$salar2[1]' AND catagory='$catagory' AND experience <='$exp2[1]' limit $lv";
		$resultTotalComments = mysqli_query($conn, $totalCommentsQuery);
		$rowTotalComments = mysqli_fetch_assoc($resultTotalComments);
		$tC = $rowTotalComments['t_c'];
		$np = ceil($tC / $commentsPerPage);
		$_SESSION['nOp'] = $np;
		//echo "+++++";
		echo $_SESSION['nOp'];
	} elseif (strpos($salar, "<") && strpos($exp, "-")) {
		$salar2 = explode('<', $salar);
		$exp2 = explode('-', $exp);
		//echo "< - detected";
		/*echo $salar2[1];
		echo $exp2[1];*/
		/*$commentsQuery = "SELECT job_id,employer,title,location,salary,type FROM job WHERE location='$location' AND type='$type' AND salary <='$salar2[1]' AND catagory='$catagory' AND experience BETWEEN '$exp2[0]' AND '$exp2[1]' limit $lv";
		$result = mysqli_query($conn, $commentsQuery);*/

		$commentsPerPage = $lv;
		//echo $commentsPerPage;
		$totalCommentsQuery ="SELECT job_id,employer,title,location,salary,type FROM job WHERE location='$location' AND type='$type' AND salary <='$salar2[1]' AND catagory='$catagory' AND experience BETWEEN '$exp2[0]' AND '$exp2[1]' limit $lv";
		$resultTotalComments = mysqli_query($conn, $totalCommentsQuery);
		$rowTotalComments = mysqli_fetch_assoc($resultTotalComments);
		$tC = $rowTotalComments['t_c'];
		$np = ceil($tC / $commentsPerPage);
		$_SESSION['nOp'] = $np;
		echo $_SESSION['nOp'];
	} elseif (strpos($salar, "<") && strpos($exp, ">")) {
		$salar2 = explode('<', $salar);
		$exp2 = explode('>', $exp);
		//echo "< > detected";
		/*echo $salar2[1];
		echo $exp2[1];*/
		/*$commentsQuery = "SELECT job_id,employer,title,location,salary,type FROM job WHERE location='$location' AND type='$type' AND salary <='$salar2[1]' AND catagory='$catagory' AND experience =>'$exp2[1]' limit $lv";
		$result = mysqli_query($conn, $commentsQuery);*/

		$commentsPerPage = $lv;
		//echo $commentsPerPage;
		$totalCommentsQuery ="SELECT job_id,employer,title,location,salary,type FROM job WHERE location='$location' AND type='$type' AND salary <='$salar2[1]' AND catagory='$catagory' AND experience =>'$exp2[1]' limit $lv";
		$resultTotalComments = mysqli_query($conn, $totalCommentsQuery);
		$rowTotalComments = mysqli_fetch_assoc($resultTotalComments);
		$tC = $rowTotalComments['t_c'];
		$np = ceil($tC / $commentsPerPage);
		$_SESSION['nOp'] = $np;
		echo $_SESSION['nOp'];
	} elseif (strpos($salar, "-") && strpos($exp, "<")) {
		$salar2 = explode('-', $salar);
		$exp2 = explode('<', $exp);
		//echo "- detected";
		/*echo $salar2[0];
		echo $exp2[0];
		echo $salar2[1];
		echo $exp2[1];*/
		/*$commentsQuery = "SELECT job_id,employer,title,location,salary,type FROM job WHERE location='$location' AND type='$type' AND salary BETWEEN '$salar2[0]' AND '$salar2[1]' AND catagory='$catagory' AND experience <='$exp2[1]' limit $lv";
		$result = mysqli_query($conn, $commentsQuery);*/

		$commentsPerPage = $lv;
		//echo $commentsPerPage;
		$totalCommentsQuery ="SELECT job_id,employer,title,location,salary,type FROM job WHERE location='$location' AND type='$type' AND salary BETWEEN '$salar2[0]' AND '$salar2[1]' AND catagory='$catagory' AND experience <='$exp2[1]' limit $lv";
		$resultTotalComments = mysqli_query($conn, $totalCommentsQuery);
		$rowTotalComments = mysqli_fetch_assoc($resultTotalComments);
		$tC = $rowTotalComments['t_c'];
		$np = ceil($tC / $commentsPerPage);
		$_SESSION['nOp'] = $np;
		echo $_SESSION['nOp'];

	} elseif (strpos($salar, "-") && strpos($exp, "-")) {
		$salar2 = explode('-', $salar);
		$exp2 = explode('-', $exp);
		//echo "- detected";
		/*echo $salar2[0];
		echo $exp2[0];
		echo $salar2[1];
		echo $exp2[1];*/
		$commentsQuery = "SELECT job_id,employer,title,location,salary,type FROM job WHERE location='$location' AND type='$type' AND salary BETWEEN '$salar2[0]' AND '$salar2[1]' AND catagory='$catagory' AND experience BETWEEN '$exp2[0]' AND '$exp2[1]' limit $lv";
		$result = mysqli_query($conn, $commentsQuery);

		$commentsPerPage = $lv;
		//echo $commentsPerPage;
		$totalCommentsQuery = "SELECT COUNT(*) as t_c FROM job WHERE location='$location' AND type='$type' AND salary BETWEEN '$salar2[0]' AND '$salar2[1]' AND catagory='$catagory' AND experience BETWEEN '$exp2[0]' AND '$exp2[1]' limit $lv";
		$resultTotalComments = mysqli_query($conn, $totalCommentsQuery);
		$rowTotalComments = mysqli_fetch_assoc($resultTotalComments);
		$tC = $rowTotalComments['t_c'];
		$np = ceil($tC / $commentsPerPage);
		$_SESSION['nOp'] = $np;
		//echo $_SESSION['nOp'];
		//echo "+++++";
		echo $_SESSION['nOp'];
		
	} elseif (strpos($salar, "-") && strpos($exp, ">")) {
		$salar2 = explode('-', $salar);
		$exp2 = explode('>', $exp);
		//echo "- detected";
		/*echo $salar2[0];
		echo $exp2[0];
		echo $salar2[1];
		echo $exp2[1];*/
		/*$commentsQuery = "SELECT job_id,employer,title,location,salary,type FROM job WHERE location='$location' AND type='$type' AND salary BETWEEN '$salar2[0]' AND '$salar2[1]' AND catagory='$catagory' AND experience >= '$exp2[1]' limit $lv";
		$result = mysqli_query($conn, $commentsQuery);*/

		$commentsPerPage = $lv;
		//echo $commentsPerPage;
		$totalCommentsQuery ="SELECT job_id,employer,title,location,salary,type FROM job WHERE location='$location' AND type='$type' AND salary BETWEEN '$salar2[0]' AND '$salar2[1]' AND catagory='$catagory' AND experience >= '$exp2[1]' limit $lv";
		$resultTotalComments = mysqli_query($conn, $totalCommentsQuery);
		$rowTotalComments = mysqli_fetch_assoc($resultTotalComments);
		$tC = $rowTotalComments['t_c'];
		$np = ceil($tC / $commentsPerPage);
		$_SESSION['nOp'] = $np;
		echo $_SESSION['nOp'];

	} elseif (strpos($salar, ">") && strpos($exp, "<")) {
		$salar2 = explode('>', $salar);
		$exp2 = explode('<', $exp);
		//echo "> detected";
		/*echo $salar2[1];
		echo $exp2[1];*/
		/*$commentsQuery = "SELECT job_id,employer,title,location,salary,type FROM job WHERE location='$location' AND type='$type' AND salary >='$salar2[1]' AND catagory='$catagory' AND experience <='$exp2[1]' limit $lv";
		$result = mysqli_query($conn, $commentsQuery);*/

		$commentsPerPage = $lv;
		//echo $commentsPerPage;
		$totalCommentsQuery ="SELECT job_id,employer,title,location,salary,type FROM job WHERE location='$location' AND type='$type' AND salary >='$salar2[1]' AND catagory='$catagory' AND experience <='$exp2[1]' limit $lv";
		$resultTotalComments = mysqli_query($conn, $totalCommentsQuery);
		$rowTotalComments = mysqli_fetch_assoc($resultTotalComments);
		$tC = $rowTotalComments['t_c'];
		$np = ceil($tC / $commentsPerPage);
		$_SESSION['nOp'] = $np;
		echo $_SESSION['nOp'];

	} elseif (strpos($salar, ">") && strpos($exp, "-")) {
		$salar2 = explode('>', $salar);
		$exp2 = explode('-', $exp);
		//echo "> detected";
		/*echo $salar2[1];
		echo $exp2[1];*/
		/*$commentsQuery = "SELECT job_id,employer,title,location,salary,type FROM job WHERE location='$location' AND type='$type' AND salary >='$salar2[1]' AND catagory='$catagory' AND experience BETWEEN '$exp2[0]' AND '$exp2[1]' limit $lv";
		$result = mysqli_query($conn, $commentsQuery);*/

		$commentsPerPage = $lv;
		//echo $commentsPerPage;
		$totalCommentsQuery = "SELECT job_id,employer,title,location,salary,type FROM job WHERE location='$location' AND type='$type' AND salary >='$salar2[1]' AND catagory='$catagory' AND experience BETWEEN '$exp2[0]' AND '$exp2[1]' limit $lv";
		$resultTotalComments = mysqli_query($conn, $totalCommentsQuery);
		$rowTotalComments = mysqli_fetch_assoc($resultTotalComments);
		$tC = $rowTotalComments['t_c'];
		$np = ceil($tC / $commentsPerPage);
		$_SESSION['nOp'] = $np;
		echo $_SESSION['nOp'];

	} elseif (strpos($salar, ">") && strpos($exp, ">")) {
		$salar2 = explode('>', $salar);
		$exp2 = explode('>', $exp);
		//echo "> detected";
		/*echo $salar2[1];
		echo $exp2[1];*/
		/*$commentsQuery = "SELECT job_id,employer,title,location,salary,type FROM job WHERE location='$location' AND type='$type' AND salary >='$salar2[1]' AND catagory='$catagory' AND experience >='$exp2[1]' limit $lv";
		$result = mysqli_query($conn, $commentsQuery);*/

		$commentsPerPage = $lv;
		//echo $commentsPerPage;
		$totalCommentsQuery = "SELECT job_id,employer,title,location,salary,type FROM job WHERE location='$location' AND type='$type' AND salary >='$salar2[1]' AND catagory='$catagory' AND experience >='$exp2[1]' limit $lv";
		$resultTotalComments = mysqli_query($conn, $totalCommentsQuery);
		$rowTotalComments = mysqli_fetch_assoc($resultTotalComments);
		$tC = $rowTotalComments['t_c'];
		$np = ceil($tC / $commentsPerPage);
		$_SESSION['nOp'] = $np;
		echo $_SESSION['nOp'];

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
} 


?>


