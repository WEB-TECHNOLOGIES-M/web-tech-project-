<html style="background-color: white">
<?php
    session_start();

    include_once "inc/empheader.php";
    include "inc/db.php";
    
    $msg="";
    $terr=$typeerr=$locerr=$caterr=$experr=$vacerr=$salerr=$descerr="";
    $title=$type=$loc=$catagory=$exp=$vac=$salary=$desc="";
    $user="";

    //var_dump($_SESSION['editjobID']);
    if(isset($_SESSION['editjobID'])){
        if(!empty($_SESSION['editjobID'])){
            $jobID=$_SESSION['editjobID'];

            $editsql="SELECT * FROM job WHERE ID=$jobID;";
            $editresult=mysqli_query($conn, $editsql);

            while($editrows=mysqli_fetch_assoc($editresult)){
                
                $title=$editrows['title'];
                $type=$editrows['type'];
                $loc=$editrows['location'];
                $catagory=$editrows['catagory'];
                $exp=$editrows['experience'];
                $vac=$editrows['vacancy'];
                $salary=$editrows['salary'];
                $desc=$editrows['description'];
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['jobpost'])){

            if(!empty($_POST['title'])){
                $title=$_POST['title'];
            }
            else {
                $terr="No title given!";
            }
            
            if(!empty($_POST['type'])){
                $type=$_POST['type'];
            }
            else {
                $typeerr="No type given!";
            }
            if(!empty($_POST['location'])){
                $loc=$_POST['location'];
            }
            else {
                $locerr="No location given!";
            }
            if(!empty($_POST['catagory'])){
                $catagory=$_POST['catagory'];
            }
            else {
                $caterr="No catagory given!";
            }
            if(!empty($_POST['exp'])){
                $exp=$_POST['exp'];
            }
            else {
                $experr="No experience given!";
            }
            if(!empty($_POST['vacancy'])){
                $vac=$_POST['vacancy'];
            }
            else {
                $vacerr="No vacancy given!";
            }
            if(!empty($_POST['salary'])){
                $salary=$_POST['salary'];
            }
            else {
                $salerr="No salary given!";
            }
            if(!empty($_POST['desc'])){
                $desc=$_POST['desc'];
            }
            else {
                $descerr="No description given!";
            }
            

            if($terr==""&&$typeerr==""&&$locerr==""&&$caterr==""&&$experr==""&&$vacerr==""&&$salerr==""&&$descerr==""){
                
                if(!empty($jobID)){
                    $user=$_SESSION['username'];
                    $sql2 = "UPDATE job SET employer='$user',title='$title',type='$type',location='$loc',catagory='$catagory',experience='$exp',vacancy='$vac',salary='$salary',description='$desc' WHERE ID='$jobID';";

                    mysqli_query($conn, $sql2);
                    $_SESSION['jobpost']="Successful";


                    $title=$type=$loc=$catagory=$exp=$vac=$salary=$desc="";
                    $_SESSION['msg']="Job Updated!";
                    unset($_SESSION['editjobID']);
                    header('Location: employer.php');
                }
                else{
                    $user=$_SESSION['username'];
                    $sql2 = "INSERT INTO job (employer,title,type,location,catagory,experience,vacancy,salary,description)
                    VALUES ('$user','$title','$type','$loc','$catagory','$exp','$vac','$salary','$desc');";

                    mysqli_query($conn, $sql2);
                    $_SESSION['jobpost']="Successful";

                    //header('Location: login.php');
                    $title=$type=$loc=$catagory=$exp=$vac=$salary=$desc="";
                    $msg="Job Posted!";
                    $msg="";
                }
            }
        }
    }
    
    echo mysqli_error($conn);

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
            <tr align="center">
                <td>
                    <table>
                        <tr>
                            <td>
                                <a href="employer.php">Go Back</a>
                            </td>
                            
                        </tr>
                    </table>
                </td>
            </tr>    
            <tr>
                <td width="50%" align="center">

                    <form action="" method="POST">
                    <label><?php echo $msg; $msg = "";  ?></label>
                    <div align="left" style="background-color: #e6e6e6; padding: 50px; color:black; max-width: 750px; padding-left: 100px; padding-right: 100px;">
                    <label style="font-size: 25px"><?php if(!empty($jobID)){echo "Edit the Job";} else{echo "Post a job!";}?></label>
                    <br><br><br>
                    <table width="100%">
                        <!-- Title -->
                        <tr>
                            <td><label style="color:black; font-size: 20;">Title: &nbsp</label></td>
                            <td style="display: flex;"><input type="text" width="100%" name="title" maxlength="50" required style="font-size:20px; flex: 1;" value="<?php echo $title ?>"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="font-size: 15px; color: red;"><?php echo $terr ?></td>
                        </tr>
                        <!-- Type -->
                        <tr>
                            <td><label style="color:black">Type: &nbsp</label></td>
                            <td style="display: flex;">
                                <table align="center" width="100%">
                                    <tr>
                                        <td><input type="radio" name="type" value="part-time" style="width:20px; height:20px; vertical-align: text-bottom;" <?php if(!empty($type)){if($type=="part-time"){echo "checked";}} else{echo "checked";}?>><label>Part time</label></td>
                                        <td><input type="radio" name="type" value="full-time" style="width:20px; height:20px; vertical-align: text-bottom;" <?php if(!empty($type)){if($type=="full-time"){echo "checked";}}?>><label>Full time</label></td>
                                        <td><input type="radio" name="type" value="internship" style="width:20px; height:20px; vertical-align: text-bottom;" <?php if(!empty($type)){if($type=="internship"){echo "checked";}}?>><label>Internship</label></td>
                                    </tr>
                                </table>    
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="font-size: 15px; color: red;"><?php echo $typeerr ?></td>
                        </tr>
                        <!-- Location -->
                        <tr>
                            <td><label style="color:black">Location: &nbsp</label></td>
                            <td style="display: flex;"><input type="text" width="100%" name="location" maxlength="200" required style="font-size:20px; flex: 1;" value="<?php echo $loc ?>"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="font-size: 15px; color: red;"><?php echo $locerr ?></td>
                        </tr>
                        <!-- Catagory -->
                        <tr>
                            <td width="210px"><label style="color:black">Catagory: &nbsp</label></td>
                            <td style="display: flex;"><select name="catagory" required style="font-size:20px;">
                                <option value="accounting" <?php if($catagory=="accounting"){echo "selected";} elseif($catagory==""){echo "selected";} ?>>Accounting</option>
                                <option value="banking" <?php if($catagory=="banking"){echo "selected";} ?>>Banking</option>
                                <option value="development" <?php if($catagory=="development"){echo "selected";} ?>>Development</option>
                                <option value="insurance" <?php if($catagory=="insurance"){echo "selected";} ?>>Insurance</option>
                                <option value="it" <?php if($catagory=="it"){echo "selected";} ?>>IT</option>
                                <option value="healthcare" <?php if($catagory=="healthcare"){echo "selected";} ?>>Healthcare</option>
                                <option value="marketing" <?php if($catagory=="marketing"){echo "selected";} ?>>Marketing</option>
                                <option value="management" <?php if($catagory=="management"){echo "selected";} ?>>Management</option>
                             </select>                                  
                            </td>
                            <!-- <td style="display: flex;"><input type="text" width="100%" name="catagory" maxlength="50" required style="font-size:20px; flex: 1;"></td> -->
                        </tr>
                        <tr>
                            <td></td>
                            <td style="font-size: 15px; color: red;"><?php echo $caterr ?></td>
                        </tr>
                        <!-- Experience -->
                        <tr>
                            <td><label style="color:black">Experience: &nbsp</label></td>
                            <td style="display: flex;"><input type="number" width="100%" name="exp" maxlength="2" required style="font-size:20px; flex: 1;" value="<?php echo $exp ?>"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="font-size: 15px; color: red;"><?php echo $experr ?></td>
                        </tr>
                        <!-- Vacancy -->
                        <tr>
                            <td><label style="color:black">Vacancy: &nbsp</label></td>
                            <td style="display: flex;"><input type="number" width="100%" name="vacancy" maxlength="5" required style="font-size:20px; flex: 1;" value="<?php echo $vac ?>"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="font-size: 15px; color: red;"><?php echo $vacerr ?></td>
                        </tr>
                        <!-- Salary -->
                        <tr>
                            <td><label style="color:black">Salary: &nbsp</label></td>
                            <td style="display: flex;"><input type="text" width="100%" name="salary" maxlength="20" style="font-size:20px; flex: 1;" required value="<?php echo $salary ?>"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="font-size: 15px; color: red;"><?php echo $salerr ?></td>
                        </tr>
                        <!-- Description -->
                        <tr>
                            <td><label style="color:black">Description: &nbsp</label></td>
                            <td style="display: flex;"><textarea rows="6" width="100%" name="desc" maxlength="100" style="font-size:20px; flex: 1;" required><?php echo $desc;?></textarea></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="font-size: 15px; color: red;"><?php echo $descerr ?></td>
                        </tr>
                        


                        <tr>
                            <td></td>
                            <td align="right" ><br><input type="submit" name="jobpost" value="Post" style="font-size: 20px;"></td>
                        </tr>
                    </table>
                    </div>

                    </form>

                </td>
            </tr>
        </table>
    </body>
</html>