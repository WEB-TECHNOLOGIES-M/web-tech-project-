<html style="background-color: white">
<?php
    session_start();
    /*session_destroy();
    session_start();*/
    include_once "inc/homeheader.php";
    include "inc/db.php";

    error_reporting(0);
    $uname=$pass="";
    $uerr=$perr="";
    $msg="";
    if(isset($_GET['msg'])){
        if($_GET['msg']=="na"){
            $msg="Not Approved";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['uname'])) {
        $uerr = "Username cannot be empty!";
      } else {
        $uname = $_POST['uname'];
        }
        
        if (empty($_POST['pass'])) {
        $perr = "Password cannot be empty!";
      } else {
        $pass = $_POST['pass'];
        }
        
        if($uerr==""&&$perr==""){
            
            $sql = "SELECT * FROM login WHERE email='$uname';";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

            if(mysqli_num_rows($result)==1){
                if(password_verify($_POST['pass'],$row['password'])){
                    if($row['usertype']=="admin")
                    {
                        $_SESSION['user']=$row['ID'];
                        $_SESSION['email']=$row['email'];
                        $_SESSION['usertype']="admin";
                        $_SESSION['username']=$row['username'];
                        header("Location: admin.php");
                    }
    
                    elseif($row['usertype']=="seeker")
                    {
                        $_SESSION['user']=$row['ID'];
                        $_SESSION['email']=$row['email'];
                        $_SESSION['usertype']="seeker";
                        $_SESSION['username']=$row['username'];
                        header("Location: Employee/EmployeeProfile.php");
                    }
                    
                    elseif($row['usertype']=="employer")
                    {
                        $_SESSION['user']=$row['ID'];
                        $_SESSION['email']=$row['email'];
                        $_SESSION['usertype']="employer";
                        $_SESSION['username']=$row['username'];
                        header("Location: employer.php");
                    }

                    else{
                        echo "Unknown usertype";
                    }
    
                }
                else {
                    $perr="Password does not match";
                }
            }
            else {
                $uerr="Username not found";
            }
        }
    }

?>

<style>
    label{
        font-size: 20;
    }
    input{
        padding-left: 10px;
        padding-right: 10px;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

</style>


    <body style="color: black; font-family: Verdana;">
        <table width="100%" style="padding: 50px; color: black; font-family: Verdana;">
           <tr>
               <td align="center" style="color: red">
                   <?php echo $msg; ?>
               </td>
            </tr>
            <tr>
                <td width="50%" align="center">

                    <form action="" method="POST">

                    <div align="left" style="background-color: #e6e6e6; padding: 50px; color:black; max-width: 750px; padding-left: 100px; padding-right: 100px;">
                    <label style="font-size: 25px">Log In</label>
                    <br><br><br>
                    <table width="100%">
                        
                        <!-- username -->
                        <tr>
                            <td><label style="color:black">Username: &nbsp</label></td>
                            <td style="display: flex;"><input type="text" width="100%" name="uname" maxlength="100" required style="font-size:20px; flex: 1;" value="<?php echo $uname ?>"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="font-size: 15px; color: red;"><?php echo $uerr ?></td>
                        </tr>
                        <!-- password -->
                        <tr>
                            <td><label style="color:black">Password: &nbsp</label></td>
                            <td style="display: flex;"><input type="password" width="100%" name="pass" maxlength="50" required style="font-size:20px; flex: 1;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="font-size: 15px; color: red;"><?php echo $perr ?></td>
                        </tr>
                        
                        <tr>
                            <td></td>
                            <td align="right" ><br><input type="submit" name="login" value="Login" style="font-size: 20px;"></td>
                        </tr>
                    </table>
                    </div>

                    </form>

                </td>
            </tr>
        </table>
    </body>
</html>