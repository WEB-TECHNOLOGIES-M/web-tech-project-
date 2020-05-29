<?php 


include "includes/db_connect.php";

if(isset($_POST['new_pass']) || isset($_POST['current_pas'])|| isset($_POST['confirm_pass']) || isset($_POST['email']) )
{
	 $n= $_POST['new_pass'];
	 $c= $_POST['current_pas'];
	 $e= $_POST['email'];
	 echo $n;
	 echo $c;

	
	 $sqlUserCheck = "SELECT username, password ,usertype FROM login WHERE username = '$e'";
	 $result = mysqli_query($conn, $sqlUserCheck);
	 $rowCount = mysqli_num_rows($result);
 
	 if($rowCount < 1){
		 $message = "Something went wrong!!";
	 }
	 else{
		 while($row = mysqli_fetch_assoc($result)){
			 $passInDB = $row['password'];
 
			 if( $passInDB == $c ){
				$sql = "UPDATE login SET password='123' WHERE username='$e' ; ";
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











				