<?php
include('connection.php');

session_start();
$id= $_SESSION['id'];

if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $t_name = $_POST["t_name"];
        $t_date = $_POST["date"];
        $e_date = $_POST["e_date"];
        $desc = $_POST["desc"];
        $errors ="";
        if(empty($t_name))
        {
            $errors="Task name cannot be empty";
        }
        elseif(empty($t_date))
        {
            $errors= "Task date cannot be empty";
        }
        elseif(empty($e_date))
        {
            $errors="Expiry date cannot be empty";
        }
        elseif(empty($desc))
        {
            $errors="Description cannot be empty";
        }
        else 
        {
            $sql ="INSERT INTO todo_list(task_name, today, task_expire, description, done,user_id)
                    VALUES('$t_name', '$t_date','$e_date','$desc', '0', '$id') ";

                    $result = pg_query($conn, $sql);
                    if (!$result) 
                    {
                    die("Error in SQL query: " . pg_last_error());
                    }
                    else 
                    {
                        echo "data entered correctly";
                           
                    }
        }
    }
   
    //search query
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        
            if(!empty($_GET["search"]))
            {
                $query= $_GET["search"];
                $resultS= pg_query($conn,"SELECT task_name ,description,task_expire
                FROM todo_list 
                WHERE task_name LIKE '%$query%'
                OR description LIKE '%$query%'");


                if(pg_num_rows($resultS)>0)
                {
                    while($res=pg_fetch_array($resultS))
                    {
                        echo"<p style='
                        color:rgb(245, 120, 71);'>" . " Task name:  " . $res['task_name']. " Task description:  " .
                        $res['description'] . "expires:  " . $res['task_expire'] . "</p>";
                    }
                }
                else
                {
                    echo "no results";
                }
            }
            else
            {
                echo "Do you want to search through your tasks?";
            }
    }

?>



<html>
    <head>
        <link rel="stylesheet" type="text/css" href="todo_stye.css">
        <link href="picker.css" rel="stylesheet">

        <script src="picker.js"></script>

        <title>ToDo List</title>
     
    </head>

    <body>
    <div class="back_btn">
                <button class="form-btn dx1"  name="submit"><a href="welcome.php"> Back to homepage  </a></button> <br>
    </div>

    <div class="searchL">
        <form class="searchF" action="todo.php" method="GET">
                <input type="text" placeholder="Find your task" name="search">
        <button type="submit"><img src="s.png"></button>
        </form>
    </div>

    <div class="container">
            <div class="heading">
                <h2 style="font-style: 'Hervetica';"> New task </h2>
            </div>
        <div class="formT">

            <form method="post" action="todo.php" class="input_form"> 
                <?php if (isset($errors)) { ?>
                <p>
                <?php echo $errors; ?></p>
                <?php } ?>
                
                <label for="t_name"> Name of task: </label>
                        <input type="text" id="myInput" class="t_name" name="t_name" 
                        placeholder="Task name" required>
                        <br> <br>
                        

                    <label for="date">Date(today): </label>
                        <select class="date" name="date">
                            <option><?php echo date('Y/m/d');?> </option>
                    </select>
                        <br> <br>
                        
                    <label for="e_date"> Expiry task date: </label>
                    <input class="date-input-native" id="date" 
                    type="date" name="e_date" min="2019-01-01" max="2022-01-01">
                    <div id="picker" hidden></div>

                    
                 
                        <br> <br>
                        

                    <label for="desc"> Description </label>
                        <textarea class="desc" id="desc" name="desc"
                         placeholder="Descibe your task" reqired > 
                        </textarea>
                        
                         <br> <br>

		        <button type="submit" name="submit" id="add_btn" class="add_btn"> Add Task</button>
            </form>
        </div>
    </div>
        
<div>
    <table class="task_list">
	    <thead>
            <tr>
                <th>Number</th>
                <th>Task name</th>
                <th>Today</th>
                <th>Expiring</th>
                <th>About task</th>
                <th>Status</th>
                <th style="width: 60px;">DELETE</th>
                <th>Done task</th>
            </tr>
	    </thead>

            <tbody>
                <?php 
                // select all tasks if page is visited or refreshed
                $sql1="SELECT * FROM todo_list WHERE $id= user_id ";
                $result1 = pg_query($conn, $sql1);
                //$tasks =pg_query($conn, );

                $i = 1; 
                $green='';
                while ($row=pg_fetch_assoc($result1)) { ?>
                    <tr>
                        <td> <?php echo $i; ?> </td>
                        <td class="task"> <?php echo $row['task_name']; ?> </td>
                        <td class="task"> <?php echo $row['today']; ?> </td>
                        <td class="task"> <?php echo $row['task_expire']; ?> </td>
                        <td class="task"> <?php echo $row['description']; ?> </td>
                        <td class="task"> <?php echo $row['done']; ?> </td>

                        <td class="delete"> 
                            <a href="todo.php?del_task=<?php echo $row['id']; ?>">X</a> 
                        </td>
                        <td class="check">
                        
                        <a href="todo.php?check=<?php echo $row['id']; ?>">
                        <span style="background-color:<?php $green ?>;">
                        &#10084; </a> </span></td>

                    </tr>
                <?php $i++; } ?>	
            </tbody>
        </table>
</div>
    <?php
    // delete task
    if (isset($_GET['del_task'])) 
    {
        $id = $_GET['del_task'];
        pg_query($conn, "DELETE FROM todo_list WHERE id=$id");
        //header('Location:todo.php');
        echo "task succesfully deleted";
    }

    //task done !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    if (isset($_GET['check'])) 
    {
        $done =1;
        $id = $_GET['check'];
       
        pg_query($conn, "UPDATE todo_list SET done=$done WHERE id=$id");
        echo "task succesfully done";
        $green='green';
    
    }
    else
    {
        $green='pink';
    }
 
    

    ?>


<script type="text/javascript">

//calendar

/*
(function(){

'use strict';

var dayNamesShort = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'];
var monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
var icon = '<svg viewBox="0 0 512 512"><polygon points="268.395,256 134.559,121.521 206.422,50 411.441,256 206.422,462 134.559,390.477 "/></svg>';

var root = document.getElementById('picker');
var dateInput = document.getElementById('date');
var altInput = document.getElementById('alt');
var doc = document.documentElement;

function format ( dt ) {
  return Picker.prototype.pad(dt.getDate()) + ' ' + monthNames[dt.getMonth()].slice(0,3) + ' ' + dt.getFullYear();
}

function show ( ) {
  root.removeAttribute('hidden');
}

function hide ( ) {
  root.setAttribute('hidden', '');
  doc.removeEventListener('click', hide);
}

function onSelectHandler ( ) {

  var value = this.get();

  if ( value.start ) {
    dateInput.value = value.start.Ymd();
    altInput.value = format(value.start);
    hide();
  }
}

var picker = new Picker(root, {
  min: new Date(dateInput.min),
  max: new Date(dateInput.max),
  icon: icon,
  twoCalendars: false,
  dayNamesShort: dayNamesShort,
  monthNames: monthNames,
  onSelect: onSelectHandler
});

root.parentElement.addEventListener('click', function ( e ) { e.stopPropagation(); });

dateInput.addEventListener('change', function ( ) {

  if ( dateInput.value ) {
    picker.select(new Date(dateInput.value));
  } else {
    picker.clear();
  }
});

altInput.addEventListener('focus', function ( ) {
  altInput.blur();
  show();
  doc.addEventListener('click', hide, false);
});

}()); */
</script>
        
    </body>
</html>
    



