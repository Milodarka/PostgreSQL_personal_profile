<?php
session_start();
include('connection.php');
include('header.php');
    if(!isset($_SESSION['id']))
    {
        header('Location: login.php');
        echo 'user not loged in';
    }
    $id = $_SESSION['id'];


    $sql= "SELECT * FROM users
        WHERE id = '$id'
        ";
    $result = pg_query($conn, $sql);
    $row=pg_fetch_assoc($result);
?>
<html>
            <head>
            <link rel="stylesheet" type="text/css" href="myCss/css_welcome.css">
    
            </head>
            <body>
                <p> W E L C O M E <?php echo $row['name'];?> </p>
                <div class="box-circle-transform"></div>
            </body>
</html>