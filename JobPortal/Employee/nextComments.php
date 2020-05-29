
<?php

include "includes/db_connect.php";

if(isset($_POST['limitVal'])){
	$lv = $_POST['limitVal'];
	$commentsQuery = "select * from comments limit $lv";
	$resultComments = mysqli_query($conn, $commentsQuery);
}
else if(isset($_POST['searchVal'])) {
	$sv = $_POST['searchVal'];
	$commentsQuery = "select * from comments where comment_text like '%$sv%'";
	$resultComments = mysqli_query($conn, $commentsQuery);
}
else if(isset($_POST['startingVal'])){
	$stv = $_POST['startingVal'];
	$np = $_POST['np'];
	$nextClick = $_POST['nextClick1'];
	echo $nextClick;
	
		$commentsQuery = "select * from comments limit $stv, 3";
		$resultComments = mysqli_query($conn, $commentsQuery);	
	
}
while($row = mysqli_fetch_assoc($resultComments)){
	echo "<b>".$row['user_id'].": </b>".$row['comment_text']. "<br><br>";


	/*if ($nextClick == ($np-1) ) {

		?>

			<script>
			document.getElementById("nextBtn").style.display = "none";
			</script>
		
		<?php
		
	}
	if ($nextClick == 0 ) {

		?>

			<script>
			document.getElementById("prevBtn").style.display = "none";
			</script>
			<script>
			document.getElementById("nextBtn").style.display = "block";
			</script>
		
		<?php
		
	}*/

}

?>