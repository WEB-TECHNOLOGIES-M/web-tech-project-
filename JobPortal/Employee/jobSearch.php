<?php

session_start();

include "includes/db_connect.php";

/*if (!isset($_SESSION["nOp"])) {
	$_SESSION["nOp1"]= '';
}else{
	$_SESSION["nOp1"]= $_SESSION["nOp"];
}


$_SESSION["nOp"]= $_REQUEST['nOp'];*/
$_SESSION["nOp"] = '';

//$_SESSION["email"] = "zrsaimun@gmail.com";

if (!isset($_SESSION["email"])) {
	header("Location: ../logout.php");
	//$_SESSION["tempAppliedJobs"]='';
	//$email='';
}else{
	$email = $_SESSION["email"];
}



$catagory = $checked_count = $type = $salary = $exp = $location = "";
$np = 3;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (!empty($_POST['search-categories'])) {
		$catagory = $_POST['search-categories'];
	}
	if (!empty($_POST['search-keyword'])) {
		$exp = $_POST['search-keyword'];
	}

	if (!empty($_POST['salary'])) {
		$salary = $_POST['salary'];
	}
	if (!empty($_POST['type'])) {
		$type = $_POST['type'];
		echo $type;
	}
	if (!empty($_POST['search-location'])) {
		$location = $_POST['search-location'];
	}
}


$commentsPerPage = 3;
$a = 1;

$commentsQuery = "select * from job limit $commentsPerPage";
$resultComments = mysqli_query($conn, $commentsQuery);

$totalCommentsQuery = "SELECT COUNT(*) as t_c FROM job";
$resultTotalComments = mysqli_query($conn, $totalCommentsQuery);
$rowTotalComments = mysqli_fetch_assoc($resultTotalComments);
$tC = $rowTotalComments['t_c'];

$np = ceil($tC / $commentsPerPage);


?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link rel="stylesheet" href="../css/Employee/jobSearch.css">
	<link rel="stylesheet" href="../css/Employee/bootstrap.css">
	<link rel="stylesheet" href="../css/Employee/fonts.css">
	<script src="https://kit.fontawesome.com/8a7775d0b9.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

	<script>
		$(document).ready(function() {

			var np1
			var i = 2;
			var j = 0;
			var nextClick = 0;
			var resPerPage = 3;
			$("#prevBtn").hide();
			$("#nextBtn").hide();
			$("#resPerPage").hide();


			$('#searchBTN').click(function() {

				//alert($('#search-location').val());
				//alert($('#search-categories').val());
				//alert($('input[name="type"]:checked').length);
				//alert($('#search-categories').val());
				//alert($('#search-categories').val());
				/*if ($('#search-location').val()== '') {
					alert("cat null");
				}
				else{
					alert("cat not null");
				}
				*/
				nextClick = 0;
				resPerPage = 3;
				i = 2;
				j = 0;
				$("#err").html('');

				if ($('#search-location').val() == '' || $('#search-categories').val() == '' || $('input[name="type"]:checked').length == 0 || $('input[name="salary"]:checked').length == 0 || $('input[name="exp"]:checked').length == 0) {
					alert("Fill up all The Requirments!!");
				} else {
					
					var location = document.getElementById('search-location').value.toLowerCase();
					var type = document.querySelector('input[name="type"]:checked').value;
					var catagory = document.getElementById('search-categories').value;
					var salary = document.querySelector('input[name="salary"]:checked').value;
					var exp = document.querySelector('input[name="exp"]:checked').value;

					//alert(type);

					var email = '<?php echo $email ?>';
					$("#prevBtn").show();
					$("#nextBtn").show();
					$("#resPerPage").show();
					$("#resPerPage").val("Result Per Page");
					document.getElementById('prevBtn').disabled = true;

					/*salary: document.querySelector('input[name="salary"]:checked').value.toLowerCase()*/

					var postData = 'location=' + location + '&type=' + type + '&catagory=' + catagory + '&salary=' + salary + '&exp=' + exp + '&email=' + email + '&resPerPage=' + 3;

					$.ajax({
						url: "jobSearchResultSession.php",
						type: "POST",
						data: postData,
						success: function(data, status, xhr) {
							//if success then just output the text to the status div then clear the form inputs to prepare for new data

							np1 = data;
							alert(np1);
							if (np1 == 0) {
								$("#prevBtn").hide();
								$("#nextBtn").hide();
								$("#resPerPage").hide();
								$("#err").html(" No Matching Job Found");
								//alert("No MAtching Job");
							}
							if (nextClick == (np1 - 1)) {
								//document.getElementById('nextBtn').disabled = true;
								$("#prevBtn").hide();
								$("#nextBtn").hide();
							} else {
								document.getElementById('nextBtn').disabled = false;
							}
							/*$("#status_text").html(data);
							$('#name').val('');
							$('#percentage').val('');*/
						},
						error: function(jqXHR, status, errorThrown) {
							//if fail show error and server status
							alert("errr");
							/*$("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);*/
						}
					});





					$('#searchResult').load('jobSearchResult.php', {
						location: location,
						type: type,
						catagory: document.getElementById('search-categories').value,
						salary: document.querySelector('input[name="salary"]:checked').value,
						email: email,
						resPerPage: 3,
						exp: document.querySelector('input[name="exp"]:checked').value
					});
					return false;
				}
			});

			$('#resPerPage').change(function() {
				
				nextClick = 0;
				i = 2;
				j = 0;
				var email = '<?php echo $email ?>';
				$("#prevBtn").show();
				$("#nextBtn").show();
				document.getElementById('prevBtn').disabled = true;


				//alert("sdsds");
				/*salary: document.querySelector('input[name="salary"]:checked').value.toLowerCase()*/
				if (document.getElementById('search-location').value == null) {
					var location = '';
					alert("no loc");
				} else {
					location = document.getElementById('search-location').value;
					//alert(location);
				}
				if (document.querySelector('input[name="type"]:checked').value == null) {
					var type = '';
					alert("no loc");
				} else {
					type = document.querySelector('input[name="type"]:checked').value;
					//alert(type);
				}

				resPerPage = document.getElementById('resPerPage').value;
				//alert("ddddd");
				//alert(resPerPage);
				var location = document.getElementById('search-location').value.toLowerCase();

				var type = document.querySelector('input[name="type"]:checked').value;
				var catagory = document.getElementById('search-categories').value;
				var salary = document.querySelector('input[name="salary"]:checked').value;
				var exp = document.querySelector('input[name="exp"]:checked').value;
				var email = '<?php echo $email ?>';

				var postData = 'location=' + location + '&type=' + type + '&catagory=' + catagory + '&salary=' + salary + '&exp=' + exp + '&email=' + email + '&resPerPage=' + resPerPage;

				$.ajax({
					url: "jobSearchResultSession.php",
					type: "POST",
					data: postData,
					success: function(data, status, xhr) {
						//if success then just output the text to the status div then clear the form inputs to prepare for new data

						np1 = data;
						alert(np1);
						if (nextClick == (np1 - 1)) {
							//document.getElementById('nextBtn').disabled = true;
							$("#prevBtn").hide();
							$("#nextBtn").hide();
						} else {
							document.getElementById('nextBtn').disabled = false;
						}
						/*$("#status_text").html(data);
						$('#name').val('');
						$('#percentage').val('');*/
					},
					error: function(jqXHR, status, errorThrown) {
						//if fail show error and server status
						alert("errr");
						/*$("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);*/
					}
				})





				$('#searchResult').load('jobSearchResult.php', {
					location: location,
					type: type,
					catagory: document.getElementById('search-categories').value,
					salary: document.querySelector('input[name="salary"]:checked').value,
					email: email,
					resPerPage: resPerPage,
					exp: document.querySelector('input[name="exp"]:checked').value
				});
				return false;
			});







			$('#prevBtn').click(function() {
				nextClick--;
				document.getElementById('nextBtn').disabled = false;
				j = j - resPerPage;
				if (nextClick == 0) {
					document.getElementById('prevBtn').disabled = true;
					document.getElementById('nextBtn').disabled = false;
				}
				/*$("#nextBtn").show();
				alert(j);*/

				$('#searchResult').load('jobSearchResult.php', {
					startingVal: j,
					np: <?php echo $np ?>,
					nextClick1: nextClick
				});
			});

			$('#nextBtn').click(function() {
				//alert("noppp");
				//alert(np1);
				document.getElementById('prevBtn').disabled = false;



				/*if ('<%=Session["nOp"] == null%>') {
					alert('null session');
				}else{
					var np1= '<%=Session["nOp"]>';
				}*/

				nextClick++;

				if (nextClick == (np1 - 1)) {
					document.getElementById('nextBtn').disabled = true;
				}
				j = j + resPerPage;
				/*$("#prevBtn").show();
				alert(j);
				if (j == 9) {
					$("#nextBtn").hide();

				}*/

				$('#searchResult').load('jobSearchResult.php', {
					startingVal: j,
					np: <?php echo $np ?>,
					nextClick1: nextClick
				});
			});


		});
	</script>






</head>

<body>


	<div class="container">

		<div class="outside" style="background: #fff none repeat scroll 0 0;border-radius: 8px;">
			<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" style="padding-top: 15px" autocomplete="off">



				<div class="jobSearch">
					<div class="row-1">
						<div class="search">


							<!--Job Catagory-->
							<div class="jp_rightside_job_categories_wrapper">
								<div class="jp_rightside_job_categories_heading">
									<h4>Catagory</h4>
								</div>
								<div class="jp_rightside_job_categories_content">
									<div class="handyman_sec1_wrapper">
										<div class="content">
											<div class="box">

												<div class="catagory">

													<div class="btn-group bootstrap-select open">
														<select name="search-categories" class="selectpicker" id="search-categories" data-live-search="true" title="Any Category" data-size="5" data-container="body" tabindex="-98">
															<option value="">Any Category</option>
															<option value="accounting">Accountance</option>
															<option value="bangking">Banking</option>
															<option value="developement">Developement</option>
															<option value="insurance">Insurance</option>
															<option value="iT">IT</option>
															<option value="healthcare">Healthcare</option>
															<option value="marketing">Marketing</option>
															<option value="management">Management</option>
														</select>
													</div>
												</div>

											</div>
										</div>

									</div>
									<label for="" class="eg">e.g: IT, Marketing, <br> Banking</label>
								</div>
							</div>
							<!--Job Type-->
							<div class="jp_rightside_job_categories_wrapper" style="margin-left: 10px">
								<div class="jp_rightside_job_categories_heading">
									<h4>Job Type</h4>
								</div>
								<div class="jp_rightside_job_categories_content">
									<div class="handyman_sec1_wrapper">
										<div class="content">
											<div class="box">
												<p style=" margin-bottom: 0px;">
													<input type="radio" id="c1" name="type" value="any-type">
													<label for="c1">Any Type </label>

												</p>
												<p style=" margin-bottom: 0px;">
													<input type="radio" id="c2" name="type" value="full-time">
													<label for="c2">Full-Time </label>
												</p>
												<p style=" margin-bottom: 0px;">
													<input type="radio" id="c3" name="type" value="part-time">
													<label for="c3">Part-Time </label>
												</p>
												<p style=" margin-bottom: 0px;">
													<input type="radio" id="c4" name="type" value="internship">
													<label for="c4">Internship </label>
												</p>

											</div>
										</div>

									</div>
								</div>
							</div>
							<!--Job Salary-->
							<div class="jp_rightside_job_categories_wrapper" style="margin-left: 10px">
								<div class="jp_rightside_job_categories_heading">
									<h4>Job Salary</h4>
								</div>
								<div class="jp_rightside_job_categories_content">
									<div class="handyman_sec1_wrapper">
										<div class="content">
											<div class="box">
												<p style=" margin-bottom: 0px;">
													<input type="radio" id="c1" name="salary" value="f<10000">
													<label for="c1">
														<$10000 </label> </p> <p style=" margin-bottom: 0px;">
															<input type="radio" id="c2" name="salary" value="10000-25000">
															<label for="c2"> $10000 - $25000 </label>
												</p>
												<p style=" margin-bottom: 0px;">
													<input type="radio" id="c3" name="salary" value="25000-50000">
													<label for="c3"> $25000 - $50000 </label>
												</p>
												<p style=" margin-bottom: 0px;">
													<input type="radio" id="c4" name="salary" value="f>50000">
													<label for="c4"> >$50000 </label>
												</p>

											</div>
										</div>

									</div>
								</div>
							</div>
							<!--Job Experience-->
							<div class="jp_rightside_job_categories_wrapper" style="margin-left: 10px">
								<div class="jp_rightside_job_categories_heading">
									<h4>Experience</h4>
								</div>
								<div class="jp_rightside_job_categories_content">
									<div class="handyman_sec1_wrapper">
										<div class="content">
											<div class="box">
												<p style=" margin-bottom: 0px;">
													<input type="radio" id="c1" name="exp" value="f<1">
													<label for="c1">
														<= 1 Year </label> </p> <p style=" margin-bottom: 0px;">
															<input type="radio" id="c2" name="exp" value="1-3">
															<label for="c2"> 1-3 Year </label>
												</p>
												<p style=" margin-bottom: 0px;">
													<input type="radio" id="c3" name="exp" value="3-5">
													<label for="c3"> 3-5 Year </label>
												</p>
												<p style=" margin-bottom: 0px;">
													<input type="radio" id="c4" name="exp" value="f>5">
													<label for="c4"> =>5 Year </label>
												</p>
											</div>
										</div>
									</div>

								</div>
							</div>
							<!--Job Location-->
							<div class="jp_rightside_job_categories_wrapper" style="margin-left: 10px">
								<div class="jp_rightside_job_categories_heading">
									<h4>Job Location</h4>
								</div>
								<div class="jp_rightside_job_categories_content">
									<div class="handyman_sec1_wrapper">
										<div class="content">
											<div class="box">
												<p style=" margin-bottom: .3rem;">

													<input type="text" name="search-location" class="form-control" id="search-location" placeholder="Location" style="width: 85%" list="FavoriteColor">

													<datalist id="FavoriteColor">

														<option value="Bagerhat">
														<option value="Bandarban">
														<option value="Barguna">
														<option value="Barisal">
														<option value="Bhola">
														<option value="Bogra">
														<option value="Brahmanbaria">
														<option value="Chandpur">
														<option value="Chittagong">

														<option value="Comilla">
														<option value="Cox's Bazar">
														<option value="Dhaka">
														<option value="Dinajpur">
														<option value="Faridpur">
														<option value="Feni">
														<option value="Gaibandha">
														<option value="Gazipur">
														<option value="Gopalganj">

														<option value="Jaipurhat">
														<option value="Jamalpur">
														<option value="Jessore">
														<option value="Jhalakati">
														<option value="Jhenaidah">
														<option value="Khagrachari">
														<option value="Khulna">
														<option value="Kishoreganj">
														<option value="Kurigram">
														<option value="Kushtia">
														<option value="Lakshmipur">
														<option value="Lalmonirhat">
														<option value="Madaripur">
														<option value="Magura">
														<option value="Manikganj">
														<option value="Meherpur">
														<option value="Moulvibazar">
														<option value="Munshiganj">
														<option value="Mymensingh">
														<option value="Naogaon">
														<option value="Narail">
														<option value="Narayanganj">
														<option value="Narsingdi">
														<option value="Natore">
														<option value="Nawabganj">
														<option value="Netrakona">
														<option value="Nilphamari">
														<option value="Noakhali">
														<option value="Pabna">
														<option value="Panchagarh">
														<option value="Parbattya Chattagram">
														<option value="Patuakhali">
														<option value="Pirojpur">
														<option value="Rajbari">
														<option value="Rajshahi">
														<option value="Rangpur">
														<option value="Satkhira">
														<option value="Shariatpur">
														<option value="Sherpur">
														<option value="Sirajganj">
														<option value="Sunamganj">
														<option value="Sylhet">
													</datalist>
												</p>
											</div>
										</div>
									</div>
									<label for="" class="eg">e.g: Dhaka, Chaittagong, <br> Sylhet</label>
								</div>
							</div>


						</div>
					</div>
					<div class="row-2">
						<div class="cv" style="margin-bottom: 8px">
							<input class="btn btn-primary btn-lg active" role="button" aria-pressed="true" type="submit" value="Search" id="searchBTN" name="isSubmit" style="padding: 5px"></input>
							<span id="err" style="color: red"></span>

						</div>
					</div>
			</form>

			<div class="row-3">

				<div class="jp_rightside_job_categories_wrapper">
					<div class="jp_rightside_job_categories_heading">
						<h4>Search result</h4>
					</div>
					<div class="jp_rightside_job_categories_content">
						<div class="handyman_sec1_wrapper">
							<select name="search-categories" class="selectpicker" id="resPerPage" data-live-search="true" title="Any Category" data-size="5" data-container="body" tabindex="-98" style="margin-left: 80%">
								<option class="bs-title-option" value="Result Per Page" selected disabled value="">Result Per Page</option>

								<option value="5">5</option>
								<option value="7">7</option>

							</select>
							<div class="content">
								<div class="SerachResult">
									<ul class="job-listings mb-5" id="searchResult">


									</ul>
									<button class="btnpg" type="button" name="btnPrev" id="prevBtn">Previous</button>
									<button class="btnpg" type="button" name="btnNext" id="nextBtn">Next</button>
								</div>


							</div>

						</div>
					</div>
				</div>


			</div>



		</div>













	</div>

	</div>
	</div>


</body>

</html>




<!--
<div class="row pagination-wrap">

			<div class="col-md-6 text-center text-md-right">
				<div class="custom-pagination ml-auto mb-5">
					<a href="#" class="prev">Prev</a>
					<div class="d-inline-block">
						<a href="#" class="active">1</a>
						<a href="#">2</a>
						<a href="#">3</a>
						<a href="#">4</a>
					</div>
					<a href="#" class="next">Next</a>
				</div>
			</div>
		</div>

	-->