<?php 


include "includes/db_connect.php";

if(isset($_POST['new_pass']) || isset($_POST['current_pas'])|| isset($_POST['confirm_pass']) || isset($_POST['email']) )
{
	 $n= $_POST['new_pass'];
	 $c= $_POST['current_pas'];
	 $e= $_POST['email'];


	
	 $sqlUserCheck = "SELECT email, password FROM login WHERE email = '$e'";
	 $result = mysqli_query($conn, $sqlUserCheck);
	 $rowCount = mysqli_num_rows($result);
 
	 if($rowCount < 1){
		 $message = "Something went wrong!!";
	 }
	 else{
		 while($row = mysqli_fetch_assoc($result)){
			 $passInDB = $row['password'];
 
			 if(password_verify($c,$passInDB)){
				$fpass=password_hash($n,PASSWORD_DEFAULT);
				$sql = "UPDATE login SET password='$fpass' WHERE email='$e' ; ";
				mysqli_query($conn, $sql);
				echo "Password has been Changed";
			 }
			 else{
				 echo "Invalid Current Password";
			 }
		 }
	 }

















	 











	
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











				