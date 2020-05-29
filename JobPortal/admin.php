<html style="background-color: white">
<?php
    session_start();

    include_once "inc/adminheader.php";
    include "inc/db.php";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['approve'])){
            //var_dump($_POST['approve']);

            foreach ($_POST['approve'] as $key => $value){
                
                $uID=$key;
                $sql1="UPDATE employer SET approval=1 WHERE userID=$uID";
                mysqli_query($conn,$sql1);
            }
            
        }
        
    }
    
?>




<body style="color: black; font-family: Verdana;">
    <table align="center" width="1000px" style="padding: 50px; color: black; font-family: Verdana;">
        <tr align="center">
            <td>
                <table width="100%">
                    <tr>
                        <td>
                            <a href="adminadmin.php">View Admins</a>
                        </td>
                        <td>
                            <a href="adminemp.php">View Employers</a>
                        </td>
                        <td>
                            <a href="adminsek.php">View Seekers</a>
                        </td>
                        <td>
                            <a href="adminjob.php">View Jobs</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr align="center">
            <!-- approval section -->

            <td>
                <div style="background-color: #e6e6e6; padding: 50px; color:black;">
                    <?php
                                    
                    $sql = "SELECT * FROM employer WHERE approval = 0;";
                    $result = mysqli_query($conn,$sql);
                
                    ?>
                    <table width="1000px" style="text-align: center;">
                        <form action="" method="POST">
                            <tr>
                                <td colspan="4"><b>Pending Applroval</b></td>
                            </tr>
                            <tr>
                                <th>UserName</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Approval</th>
                            </tr>
                            <?php
                            while($rows=mysqli_fetch_assoc($result)){
                            ?>
                            <tr>
                                <td style="vertical-align: top"><?php $userID = $rows['userID'];
                                    $uquery = "SELECT username FROM login WHERE ID = $userID;";
                                    $uresult = mysqli_query($conn,$uquery);
                                    echo mysqli_fetch_assoc($uresult)['username'];
                                    ?></td>
                                <td style="vertical-align: top"><?php echo $rows['name'] ?></td>
                                <td style="vertical-align: top"><?php echo $rows['email'] ?></td>
                                <td style="vertical-align: top"><input type="submit" id="<?php echo $rows['userID']; ?>" name="approve[<?php echo $rows['userID']; ?>]" value="Approve"></td>
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


    <!-- display users -->
    <!-- <td width="" style="font-size: 20px;">
                <div style="background-color: #e6e6e6; padding: 50px; color:black;">
                    
                </div>
            </td> -->
    </tr>
    </table>
</body>

</html>