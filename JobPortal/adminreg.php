<html style="background-color: white">
<?php
    session_start();

    include_once "inc/homeheader.php";
    include "inc/db.php";
    
    $nerr=$uerr=$perr=$cperr=$emerr="";
    
    $fname=$uname=$pass=$cpass=$fpass=$email="";

    error_reporting(0);


    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['homereg'])){
            $fname=$_POST['fname'];
        }
        elseif(isset($_POST['adminreg'])){
            if(!empty($_POST['fname'])){
                $fname=$_POST['fname'];
            }
            else{
                $nerr="No name given!";
            }

            if(!empty($_POST['uname'])){
                $uname=$_POST['uname'];
                $sqlUserCheck = "SELECT * FROM login WHERE username = '$uname'";
                $result = mysqli_query($conn, $sqlUserCheck);

                while ($row = mysqli_fetch_assoc($result)) {
                    $uNameInDB = $row['username'];
                }
                if ($uNameInDB == $uname) {
                    $uerr = "UserName already exists!";
                    $uname="";
                } 
                else {
                    $uname=$_POST['uname'];
                }
            }
            else{
                $uerr="No username given!";
            }
            if(!empty($_POST['email'])){
                $email=$_POST['email'];
                $sqlUserCheck = "SELECT * FROM login WHERE email = '$email'";
                $result = mysqli_query($conn, $sqlUserCheck);

                while ($row = mysqli_fetch_assoc($result)) {
                    $emailInDB = $row['email'];
                }
                if ($emailInDB == $email) {
                    $emerr = "Email already exists!";
                } 
                else {
                    $email=$_POST['email'];
                }
            }
            else {
                $emerr="No email given!";
            }
            

            if(!empty($_POST['pass'])){
                $pass=$_POST['pass'];
                if(!empty($_POST['cpass'])){
                    $cpass=$_POST['cpass'];
                    if($pass==$cpass){
                        $fpass=password_hash($pass,PASSWORD_DEFAULT);
                    }
                    else{
                        $cperr="Passwords do not match!";
                    }
                }
                else {
                    $cperr="Re enter password!";
                }
            }
            else {
                $perr="No password given!";
            }

            if($nerr==""&&$uerr==""&&$perr==""&&$cperr==""&&$emerr==""){
                $sql1 = "INSERT INTO login (username, email, password, usertype)
                VALUES ('$uname', '$email', '$fpass', 'admin');";

                mysqli_query($conn, $sql1);

                $lastID=mysqli_insert_id($conn);

                $sql2 = "INSERT INTO admin (userID, name, email)
                VALUES ('$lastID','$fname','$email');";

                mysqli_query($conn, $sql2);
                $_SESSION['adminreg']="Successful";

                header('Location: login.php');

            }
            
            echo mysqli_error($conn);

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
                <td width="50%" align="center">

                    <form action="adminreg.php" method="POST">

                    <div align="left" style="background-color: #e6e6e6; padding: 50px; color:black; max-width: 750px; padding-left: 100px; padding-right: 100px;">
                    <label style="font-size: 25px">Register Admin</label>
                    <br><br><br>
                    <table width="100%">
                        <!-- Name -->
                        <tr>
                            <td><label style="color:black; font-size: 20;">Full Name: &nbsp</label></td>
                            <td style="display: flex;"><input type="text" width="100%" name="fname" maxlength="50" required style="font-size:20px; flex: 1;" value="<?php echo $fname ?>"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="font-size: 15px; color: red;"><?php echo $nerr ?></td>
                        </tr>
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
                        <!-- confirm password -->
                        <tr>
                            <td width="210px"><label style="color:black">Confirm Password: &nbsp</label></td>
                            <td style="display: flex;"><input type="password" width="100%" name="cpass" maxlength="50" required style="font-size:20px; flex: 1;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="font-size: 15px; color: red;"><?php echo $cperr ?></td>
                        </tr>
                        <!-- email -->
                        <tr>
                            <td><label style="color:black">Email: &nbsp</label></td>
                            <td style="display: flex;"><input type="email" width="100%" name="email" maxlength="20" required style="font-size:20px; flex: 1;" value="<?php echo $email ?>"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="font-size: 15px; color: red;"><?php echo $emerr ?></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td align="right" ><br><input type="submit" name="adminreg" value="Register" style="font-size: 20px;"></td>
                        </tr>
                    </table>
                    </div>

                    </form>

                </td>
            </tr>
        </table>
    </body>
</html>