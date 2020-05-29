<html style="background-color: white">
<?php
        session_start();

        include_once "inc/adminheader.php";
        include "inc/db.php";

        $msg="";
        if(isset($_SESSION['msg'])){
            $msg=$_SESSION['msg'];
        }

        $catagory=$type=$salary=$experience=$location=$keyword=$employer="";
        $catstring=$typestring=$salstring=$expstring=$locstring=$keystring=$empstring="";
        $page=0;

        error_reporting(0);
        if($_GET['catagory']!=""){
            $catagory=$_GET['catagory'];
            $catstring="AND catagory = " . "'$catagory'";
        }

        if($_GET['type']!=""){
            $type=$_GET['type'];
            $typestring="AND type = " . "'$type'";
        }

        if($_GET['salary']!=""){
            $salary=$_GET['salary'];
            $salstring="AND salary " . "$salary";
        }

        if($_GET['experience']!=""){
            $experience=$_GET['experience'];
            $expstring="AND experience " . "$experience";
        }

        if($_GET['location']!=""){
            $location=$_GET['location'];
            $locstring="AND location LIKE " . "'%$location%'";
        }

        if($_GET['keyword']!=""){
            $keyword=$_GET['keyword'];
            $tempkey = str_replace(" ","%",$keyword);
            $keystring="AND title LIKE " . "'%$tempkey%'";
        }

        if($_GET['employer']!=""){
            $employer=$_GET['employer'];
            $empstring="AND employer LIKE " . "'%$employer%'";
        }
        error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);


        /* $user=$_SESSION['username'];
        */
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

            /* if(isset($_POST['edit'])){
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
    }
    ?>

<style>
tr.jobResults {
    background-color: #e6e6e6;
}

tr.jobResults:nth-child(odd) {
    background-color: white;
}

td.jobResults {
    padding: 15px 50px 15px 50px;
}

/* tr.jobResults:nth-child(1){
            padding: 50px 50px 25px 50px;
        } */
</style>


<body style="color: black; font-family: Verdana;">

    <table align="center" width="1000px" style="padding: 50px; color: black; font-family: Verdana;">
        <tr align="center">
            <td>
                <label align="center"><?php echo $msg; unset($_SESSION['msg']); $msg=""; ?></label>
                <table>
                    <tr>
                        <td>
                            <a href="admin.php">Go Back</a>
                        </td>

                    </tr>
                </table>

            </td>
        </tr>

        <tr>
            <td>
                <div style="background-color: #e6e6e6; padding: 50px; color:black;">
                    <table width="1000px">

                        <form action="" type="GET">
                            <tr>
                                <td colspan=4>Search: &nbsp<input type="text" name="keyword" style="font-size:20px; width: 550px;" value="<?php echo $keyword ?>"></td>
                                <td style="display: flex;">Employer: &nbsp<input type="text" name="employer" style="font-size:20px; flex: 1;" value="<?php echo $employer ?>"></td>
                            </tr>
                            <tr>
                                <td>Catagory</td>
                                <td>Type</td>
                                <td>Salary</td>
                                <td>Experience</td>
                                <td>Location</td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="catagory" style="font-size:20px;">
                                        <option value="" <?php if($catagory==""){echo "selected";} ?>>Any</option>
                                        <option value="accounting"
                                            <?php if($catagory=="accounting"){echo "selected";} ?>>Accounting</option>
                                        <option value="banking" <?php if($catagory=="banking"){echo "selected";} ?>>
                                            Banking</option>
                                        <option value="development"
                                            <?php if($catagory=="development"){echo "selected";} ?>>Development</option>
                                        <option value="insurance" <?php if($catagory=="insurance"){echo "selected";} ?>>
                                            Insurance</option>
                                        <option value="it" <?php if($catagory=="it"){echo "selected";} ?>>IT</option>
                                        <option value="healthcare"
                                            <?php if($catagory=="healthcare"){echo "selected";} ?>>Healthcare</option>
                                        <option value="marketing" <?php if($catagory=="marketing"){echo "selected";} ?>>
                                            Marketing</option>
                                        <option value="management"
                                            <?php if($catagory=="management"){echo "selected";} ?>>Management</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="type" style="font-size:20px;">
                                        <option value="" <?php if($type==""){echo "selected";} ?>>Any</option>
                                        <option value="full-time" <?php if($type=="full-time"){echo "selected";} ?>>
                                            Full-Time</option>
                                        <option value="part-time" <?php if($type=="part-time"){echo "selected";} ?>>
                                            Part-Time</option>
                                        <option value="internship" <?php if($type=="internship"){echo "selected";} ?>>
                                            Internship</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="salary" style="font-size:20px;">
                                        <option value="" <?php if($salary==""){echo "selected";} ?>>Any</option>
                                        <option value="< 10000" <?php if($salary=="< 10000"){echo "selected";} ?>>
                                            < $10000</option>
                                        <option value="BETWEEN 10000 AND 25000"
                                            <?php if($salary=="BETWEEN 10000 AND 25000"){echo "selected";} ?>>$10000 -
                                            $25000</option>
                                        <option value="BETWEEN 25000 AND 50000"
                                            <?php if($salary=="BETWEEN 25000 AND 50000"){echo "selected";} ?>>$25000 -
                                            $50000</option>
                                        <option value="> 50000" <?php if($salary=="> 50000"){echo "selected";} ?>>$50000
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <select name="experience" style="font-size:20px;">
                                        <option value="" <?php if($experience==""){echo "selected";} ?>>Any</option>
                                        <option value="< 1" <?php if($experience=="< 10000"){echo "selected";} ?>>
                                            < 1 year</option>
                                        <option value="BETWEEN 1 AND 3"
                                            <?php if($experience=="BETWEEN 10000 AND 25000"){echo "selected";} ?>>1 - 3
                                            year(s)</option>
                                        <option value="BETWEEN 3 AND 5"
                                            <?php if($experience=="BETWEEN 25000 AND 50000"){echo "selected";} ?>>3 - 5
                                            years</option>
                                        <option value="> 5" <?php if($experience=="> 50000"){echo "selected";} ?>>> 5
                                            years</option>
                                    </select>
                                </td>
                                <td style="display: flex;"><input type="text" name="location" value=""
                                        style="font-size:20px; flex: 1;" placeholder="e.g: Dhaka, Chaittagong, Sylhet"
                                        value="<?php echo $location ?>"></td>
                            </tr>
                            <tr>
                                <td colspan="5" align="center" style="padding-top: 15px;">
                                    <input type="submit" value="Search" style="font-size: 20px;">
                                </td>
                            </tr>
                        </form>

                    </table>
                </div>
            </td>
        </tr>
        <?php
                                        
            $sql = "SELECT * FROM job WHERE 1 ". $catstring . $typestring . $salstring . $expstring . $locstring . $keystring . $empstring;
            $result = mysqli_query($conn,$sql);
            while($rows = mysqli_fetch_assoc($result)){
        ?>
        <tr align="center" class="jobResults">
            <!-- employers -->

            <td class="jobResults" onClick="location.href='jobDesc.php?jobID=<?php echo $rows['ID'] ?>';">
                <!-- <div style="background-color: #e6e6e6; padding: 50px; color:black;"> -->

                <table width="1000px" style="text-align: Left;">
                    <form action="" method="POST">
                        <tr>
                            <td rowspan="3" width="80px" height="80px" style="padding-right: 10px;"><img
                                    src="image/job_logo_1.jpg" alt="N/A"
                                    style="display: block; width: 100%; height: 100%;"></td>
                            <td width=""><b><?php echo $rows['title'] ;?><b></td>
                            <td width="250px"><?php echo ucfirst($rows['location']) ;?></td>
                            <td width="100px"></td>
                        </tr>
                        <tr>
                            <td style="color: #4d4d4d; "><?php echo $rows['employer'] ;?></td>
                            <td>$<?php echo $rows['salary'] ;?></td>
                            <td><input type="submit" id="<?php echo $rows['ID']; ?>"
                                    name="remove[<?php echo $rows['ID']; ?>]" value="Remove"></td>
                        </tr>
                        <tr>
                            <?php
                                $curID = $rows['ID'];
                                $sqlCandidates = "SELECT candidates FROM job WHERE ID = '$curID'";
                                $resultCandidates = mysqli_query($conn, $sqlCandidates);
                                /*$res = mysqli_fetch_assoc($resultCandidates)['candidates'];
                                $splitres = explode(',',$res);*/
                            ?>
                            <td>Vacancy: <?php echo $rows['vacancy'] ;?>  <!-- (<?php //echo count($splitres)-1;?> Applied) --> </td>
                            <td><?php if($rows['catagory']=="it"){
                                    echo "IT";
                                } else{
                                    echo ucfirst($rows['catagory']);
                                }?></td>
                            <td></td>
                        </tr>
                    </form>
                </table>
                </div>
            </td>
            <?php } ?>
        </tr>
    </table>
    
    <!-- display users -->
    <!-- <td width="" style="font-size: 20px;">
                    <div style="background-color: #e6e6e6; padding: 50px; color:black;">
                        
                    </div>
                </td> -->
    <!-- </tr>
    </table> -->
</body>

</html>