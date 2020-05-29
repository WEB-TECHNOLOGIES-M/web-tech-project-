<?php 


include "includes/db_connect.php";

if(isset($_POST['name']) || isset($_POST['p_title']) ||isset($_POST['gender'])|| isset($_POST['age']) ||isset($_POST['cgpa'])|| isset($_POST['salary']) ||isset($_POST['exp'])|| isset($_POST['website']) ||isset($_POST['aboutMe'])|| isset($_POST['phone']) ||isset($_POST['address'])|| isset($_POST['city']) ||isset($_POST['twitter'])|| isset($_POST['facebook']) ||isset($_POST['google'])|| isset($_POST['linkedin']))
{
	$name = $_POST['name'];
	$cgpa = $_POST['cgpa'];
	$title = $_POST['p_title'];
	$aboutMe = $_POST['aboutMe'];
	$facebook = $_POST['facebook'];
	$linkedn = $_POST['linkedin'];
	$twitter = $_POST['twitter'];
	$google = $_POST['google'];
	$email = $_POST['email'];
	$gender = $_POST['gender'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$phone = $_POST['phone'];
	$website = $_POST['website'];
	$age = $_POST['age'];
	$salary = $_POST['salary'];
	$experience = $_POST['exp'];
	/*$skill_1 = $_POST['skill_1'];
	$skill_1p = $_POST['skill_1p'];
	$skill_2 = $_POST['skill_2'];
	$skill_2p = $_POST['skill_2p'];
	$skill_3 = $_POST['skill_3'];
	$skill_3p = $_POST['skill_3p'];
	$skill_4 = $_POST['skill_4'];
	$skill_4p = $_POST['skill_4p'];*/

	$sql = "UPDATE seekerinfo
	SET email='$email',cgpa='$cgpa',name='$name',title='$title',aboutMe='$aboutMe',gender='$gender',facebook='$facebook',linkedin='$linkedn',twitter='$twitter',google='$google',address='$address',city='$city',phone='$phone',website='$website',age='$age',salary='$salary',experience='$experience'
	WHERE email = '$email';" ;

	mysqli_query($conn, $sql);
	echo "Profile Updated";
	
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











				