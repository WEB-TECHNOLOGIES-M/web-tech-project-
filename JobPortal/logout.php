<?php

session_start();

if($_GET['msg']=="na"){
    unset($_SESSION['usertype'],$_SESSION['user'],$_SESSION['email']);
    
    header("Location: login.php?msg=na");
}
else
{
    unset($_SESSION['usertype'],$_SESSION['user'],$_SESSION['email']);
    header("Location: login.php");
}

?>