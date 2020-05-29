<html style="background-color: white">
<?php
    session_start();

    include_once "inc/empheader.php";
    include "inc/db.php";

    //error_reporting(0);
    $msg="";
    if(isset($_SESSION['msg'])){
        $msg=$_SESSION['msg'];
    }

    $user=$_SESSION['username'];
    $userID=$_SESSION['user'];
    $sqlapprove="SELECT * FROM employer WHERE userID = '$userID'";
    $resapporve=mysqli_query($conn,$sqlapprove);
    $rowapprove=mysqli_fetch_assoc($resapporve);

    if($rowapprove['approval']==0){
        
        header('Location: logout.php?msg=na');
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
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
    }
?>




<body style="color: black; font-family: Verdana;">
    
    <table align="center" width="1000px" style="padding: 50px; color: black; font-family: Verdana;">
        <tr align="center">
            <td>
            <label align="center"><?php echo $msg; unset($_SESSION['msg']); $msg=""; ?></label>
                <table>
                    <tr>
                        <td style="padding-right: 20px">
                            <a href="emppostjob.php">Post a Job</a>
                        </td>
                        <td style="padding-left: 20px">
                            <a href="empJob.php">View Jobs</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr align="center">
            <!-- employers -->

            <td>
                <div style="background-color: #e6e6e6; padding: 50px; color:black;">
                    <?php
                                    
                    $sql = "SELECT * FROM job WHERE employer='$user'";
                    $result = mysqli_query($conn,$sql);
                
                    ?>
                    <table width="1000px" style="text-align: center;">
                        <form action="" method="POST">
                            <tr>
                                <td colspan="9"><b>Posted Jobs</b></td>
                            </tr>
                            <tr><td><br></td></tr>
                            <tr>
                                <th>JobID</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Catagory</th>
                                <th>Location</th>
                                <th>Experience</th>
                                <th>Vacancy</th>
                                <th>Salary</th>
                                <th>Candidates</th>
                            </tr>
                            <?php
                            while($rows = mysqli_fetch_assoc($result)){
                            ?>
                            <tr onClick="location.href='jobDesc.php?jobID=<?php echo $rows['ID'] ?>';">
                                
                                <td style="vertical-align: top"><?php echo $rows['ID'] ?></td>
                                <td style="vertical-align: top"><?php echo $rows['title'] ?></td>
                                <td style="vertical-align: top"><?php echo $rows['type'] ?></td>
                                <td style="vertical-align: top"><?php echo $rows['catagory'] ?></td>
                                <td style="vertical-align: top"><?php echo $rows['location'] ?></td>
                                <td style="vertical-align: top"><?php echo $rows['experience'] ?></td>
                                <td style="vertical-align: top"><?php echo $rows['vacancy'] ?></td>
                                <td style="vertical-align: top"><?php echo $rows['salary'] ?></td>
                                <td style="vertical-align: top"></td>
                                <td style="vertical-align: top"><input type="submit" id="<?php echo $rows['ID']; ?>" name="remove[<?php echo $rows['ID']; ?>]" value="Remove"></td>
                                <td style="vertical-align: top"><input type="submit" id="<?php echo $rows['ID']; ?>" name="edit[<?php echo $rows['ID']; ?>]" value="Edit"></td>
                            </tr>
                            <?php
                            }

                            
                            ?>


                        </form>
                    </table>
                </div>
            </td>

        </tr>
    </table>
<?php 
    $count=0;
    while($rows = mysqli_fetch_assoc($result)){
        $count++;
        echo $count;
    }
?>

    <!-- display users -->
    <!-- <td width="" style="font-size: 20px;">
                <div style="background-color: #e6e6e6; padding: 50px; color:black;">
                    
                </div>
            </td> -->
    </tr>
    </table>
</body>

</html>