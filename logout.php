<?php
    session_start();

    if(isset($_SESSION['id']))
    {
        setcookie(session_name(), '', 100);
        unset($_SESSION['id']);
        unset($_COOKIE['']);
        session_destroy();
        pg_close($conn);
        
        echo 'test';
    }
    else 
    {
        echo 'not logged in';
    }

    header('Location: login.php');

    

?>