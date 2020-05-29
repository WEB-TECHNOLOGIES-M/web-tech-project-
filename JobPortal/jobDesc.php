<html style="background-color: white">
<?php
session_start();

if ($_SESSION['usertype'] == "admin") {
    include_once "inc/adminheader.php";
}
if ($_SESSION['usertype'] == "employer") {
    include_once "inc/empheader.php";
}

include "inc/db.php";

$msg = "";
if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
}

$user = $_SESSION['username'];
/* if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['remove'])){
            //var_dump($_POST['remove']);

            foreach ($_POST['remove'] as $key => $value){
                
                $uID=$key;
                $sql1="DELETE FROM job WHERE ID=$uID";
                mysqli_query($conn, $sql1);
            }
            unset($_POST['remove']);
        }   

        if(isset($_POST['edit'])){
            //var_dump($_POST['edit']);

            foreach ($_POST['edit'] as $key => $value){
                
                $uID=$key;
                $_SESSION['editjobID']=$uID;
                header('Location: emppostjob.php');
                //var_dump($_SESSION['editjobID']);
            }
            unset($_POST['edit']);
        }
    }
    else{
        unset($_SESSION['remove'],$_SESSION['editjobID'],$_SESSION['edit']);
    } */
?>




<body style="color: black; font-family: Verdana;">
    <?php
    if($_GET['jobID']!=""){
        $jobID=$_GET['jobID'];
        $sql = "SELECT * FROM job WHERE job_id= '$jobID'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $picc =$row["pic"];
       
    ?>
    
    <table align="center" width="1000px" style="padding: 50px; color: black; font-family: Verdana;">
        <tr>
            <td colspan="2" align="center">
                <a href="javascript:history.back()">Go Back</a>
            </td>
        </tr>
        <tr>
            <td width=700px>
                <table>
                    <tr>
                        <td width="128px" height="128px" style="padding-right: 20px;"><img src="Employee/uploads/<?php echo $picc ?>" alt="N/A" style="display: block; width: 100%; height: 100%;"></td>
                        <td><label style="font-size: xx-large;"><b><?php echo $row['title'] ?><b></label></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top:25px;"><?php echo $row['description'] ?></td>
                    </tr>

               










                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td width=200px style="padding-top: 50px">
                            Catagory: <?php if($row['catagory']=="it"){
                                echo "IT";
                            } else{
                                echo ucfirst($row['catagory']);
                            }?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 10px">
                            Type: <?php echo ucfirst($row['type']); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 10px">
                            Salary: $<?php echo $row['salary'] ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <?php } ?>
</body>

</html>








