<html style="background-color: white">
<?php
    session_start();

    include_once "inc/adminheader.php";
    include "inc/db.php";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['remove'])){
            //var_dump($_POST['remove']);

            foreach ($_POST['remove'] as $key => $value){
                
                $uID=$key;
                $sql1="DELETE FROM employer WHERE userID=$uID";
                mysqli_query($conn,$sql1);
            }
            unset($_POST['remove']);
        }
        
    }
    
?>




<body style="color: black; font-family: Verdana;">
    <table align="center" width="1000px" style="padding: 50px; color: black; font-family: Verdana;">
        <tr align="center">
            <td>
                <table>
                    <tr>
                        <td>
                            <a href="admin.php">Go Back</a>
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
                                    
                    $sql = "SELECT * FROM employer";
                    $result = mysqli_query($conn,$sql);
                
                    ?>
                    <table width="1000px" style="text-align: center;">
                        <form action="" method="POST">
                            <tr>
                                <td colspan="4"><b>Employers</b></td>
                            </tr>
                            <tr>
                                <th>UserName</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Remove</th>
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
                                <td style="vertical-align: top"><input type="submit" id="<?php echo $rows['userID']; ?>" name="remove[<?php echo $rows['userID']; ?>]"
                                        value="Remove"></td>
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