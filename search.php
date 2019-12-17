<?php
include('connection.php');

session_start();
$id= $_SESSION['id'];

 //search query

    
         // select all tasks if page is visited or refreshed
         $sql2="SELECT * FROM todo_list WHERE $id= user_id ";
         $result2 = pg_query($conn, $sql2);
         //$tasks =pg_query($conn, );

         $i = 1; 
         $have="";

         while ($row=pg_fetch_assoc($result2)) 
         {
             if(strpos($_POST['search'],$row['task_name'] ) !== false)
             {
                 $have=$row['task_name'];
             }
             else
             {
                 echo "no such a task in database";
             }
            $i++;
         }
         echo $have;




?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="todo_stye.css">
    </head>

    <body>
    <div class="search">
        <form class="searchF" action="todo.php" method="POST">
        <input type="text" placeholder="Search your tasks" name="search">
            <button type="submit"><img src="s.png"></button>
        </form>
    </div>

    </body>

</html>