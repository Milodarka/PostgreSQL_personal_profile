<?php
session_start();
if(isset($_SESSION['id']))
{
    header('Location:welcome.php');
}
else{
header('Location:login.php');
}

?>