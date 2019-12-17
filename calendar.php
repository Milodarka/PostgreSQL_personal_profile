<?php
include('connection.php');
if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $t_name = $_POST["t_name"];
        $t_date = $_POST["date"];
        $e_date = $_POST["e_date"];
        $desc = $_POST["desc"];
        
        if(empty($t_name))
        {
            echo"Task name cannot be empty";
        }
        elseif(empty($t_date))
        {
            echo "Task date cannot be empty";
        }
        elseif(empty($e_date))
        {
            echo "Expiry date cannot be empty";
        }
        elseif(empty($desc))
        {
            echo"Description cannot be empty";
        }
        else 
        {
      
            echo  $t_name . $t_date . $e_date . $desc;
        }
    }   

?>