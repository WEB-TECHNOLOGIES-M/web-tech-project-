<html style="background-color: white">
<?php
    include_once "inc/homeheader.php";
?>

    <body style="color: black; font-family: Verdana;">
        <table width="100%" style="padding: 50px; color: black; font-family: Verdana;">
            <tr>
                <td width="50%">

                </td>
                <td width="50%" style="font-size: 20px;">

                    <form action="sekreg.php" method="POST">

                    <div style="background-color: #e6e6e6; padding: 50px; color:black; max-width: 500px;">
                    <label style="font-size: 25px">Register as a Job Seeker!</label>
                    <br><br><br>
                    <table width="100%";>
                        <tr>
                            <td width="100px"><label style="color:black">Full Name: &nbsp</label></td>
                            <td style="display: flex;"><input type="text" width="100%" name="fname" maxlength="50" required style="font-size:20px; flex: 1;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="right" ><br><input type="submit" name="homereg" value="Proceed" style="font-size: 20px;"></td>
                        </tr>
                    </table>
                    </div>

                    </form>

                </td>
            </tr>
        </table>
    </body>
</html>