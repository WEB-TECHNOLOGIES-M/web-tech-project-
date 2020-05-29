<?php 




$sal = "f<1000";



if (strpos($sal,"<")) {
  $sal2= explode('<',$sal);
  echo $sal2[0];
  echo "<br>";
  echo $sal2[1];
    
}else{
  echo "fucc u";
}


/*document.getElementById("status_text").innerHTML = "Password pattern Doesnt MATCH";
          document.getElementById("status_text").style.color = "#ff0000";
        }






        if (new_pass!="") {
          if (PasswordPattern) {
            
          }else{
            document.getElementById("status_text").innerHTML = "Password pattern Doesnt MATCH";
                  document.getElementById("status_text").style.color = "#ff0000";
                }
          }
        

*/








/*$res = "dv00125;24-05-2020,tg00135;19-03-2019,dbbl0325;25-09-2020,";
$subR = explode(',',$res);
$count = count($subR);


for ($x = 0; $x <($count-1); $x++) {
    $r= explode(';',$subR[$x]);
    echo "jobid: " . $r[0] . "<br> date: " . $r[1] . "<br>";

}
*/
















/*$res = "2010-2012;manager;jobDescriptionnnnnnn)2015-2017;manager;jobDescriptionnnnnnn)2019-2052;manager;jobDescriptionnnnnnn)";

$subR = explode(')',$res);
$count = count($subR);


for ($x = 0; $x <($count-1); $x++) {
    $r= explode(';',$subR[$x]);
    echo "year: " . $r[0] . "<br> desig: " . $r[1] . " <br> desc " . $r[2] . "<br>";

}

while ($row = mysqli_fetch_array($result)) {
  $subR = explode(')',$res);
  $count = count($subR);

  for ($x = 0; $x <($count-1); $x++) { 
    $r= explode(';',$subR[$x]); ?>
    <div class="timeline-item">
      <div class="timeline-period">
        <span><?php echo $r[0] ?></span></div>
      <div class="timeline-main">
        <h5 class="timeline-title"><?php echo $r[1] ?></h5>
        <p><?php echo $r[2] ?></p>
      </div>
    </div>

<?php }
}*/










/*$y= "2012";
$d= "bsc";
$i= "aiub";

echo $hst = "(".$y.";".$d.";".$i.")";*/








/*name
p_title
gender
age
cgpa
salary
exp
website
aboutMe
phone
address
city
twitter
facebook
google
linkedin
email

$.ajax({
          url: "updateMyProfile.php",
          type: "POST",
          data: postData,
          success: function(data, status, xhr) {
            //if success then just output the text to the status div then clear the form inputs to prepare for new data
            $("#status_text").html(data);
          },
          error: function(jqXHR, status, errorThrown) {
            //if fail show error and server status
            $("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);
          }
        })


      });*/




				/*if ('<%=Session["nOp"] == null%>') {
					alert('null session');
				}else{
					var np1= '<%=Session["nOp"]>';
				}*/
				/*var nOp = '<?php echo isset($_SESSION['nOp'])?$_SESSION['nOp']:"5"; ?>'
        alert(nOp);*/
        

        /**
         * 
         * 
         * if (document.getElementById('search-location').value == null) {
					var location = '';
					alert("no loc");
				} else {
					location = document.getElementById('search-location').value;
					alert("yes loc");
					alert(location);
				}
				if (document.querySelector('input[name="type"]:checked').value == null) {
					var type = '';
					alert("no ty");
				} else {
					type = document.querySelector('input[name="type"]:checked').value;
					alert("no ty");
					alert(type);
				}
				if (document.getElementById('search-categories').value == null) {
					var catagory = '';
					alert("no cat");
				} else {
					catagory = document.getElementById('search-categories').value;
					alert("no cat");
					alert(catagory);
				}
				if (document.querySelector('input[name="salary"]:checked').value == null) {
					var salary = '';
					alert("no sal");
				} else {
					salary = document.querySelector('input[name="salary"]:checked').value;
					alert("no sal");
					alert(salary);
				}
				if (document.querySelector('input[name="exp"]:checked').value == null) {
					var exp = '';
					alert("no exp");
				} else {
					exp = document.querySelector('input[name="exp"]:checked').value;
					alert("no exp");
					alert(exp);
				}
         */







































?>


