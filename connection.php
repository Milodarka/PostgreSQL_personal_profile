<?php
    $db_host = '127.0.0.1';
    $db_port = '5432';
    $db_name = 'login';
    $db_user = 'postgres';
    $db_pass = 'mmilenicam';
  
    try {
        $conn = pg_connect(
        "host=".$db_host.
        " port=".$db_port.
        " user=".$db_user.
        " password=".$db_pass.
        " dbname=".$db_name."") or die('Connection to DB failed');
    }
    catch(Exception $e) {
        echo $e->getMessage(); die;
    }
  
//   pg_close($conn);


?>