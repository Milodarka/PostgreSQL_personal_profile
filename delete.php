<?php
session_start();
include('connection.php');

if(!isset($_SESSION['id']))
    {
        header('Location:login.php');
    }

    $id = $_SESSION['id'];


    if(!empty($_POST['delete']))
    {
        $sql= "SELECT * FROM users
        WHERE id = '$id'
        ";
        $result = pg_query($conn, $sql);

        if(pg_num_rows($result) > 0)
        {
            $sql1= "DELETE  FROM users
            WHERE id = '$id'
        ";
         $result1 = pg_query($conn, $sql1);
         $id= $_SESSION['id'];
         $sql2= "DELETE  FROM todo_list
         WHERE user_id = '$id'
     ";
      $result2 = pg_query($conn, $sql2);
       

        }
       
        header('Location:registration.php');
    }

?>
<html>
    <head>
    
    <style>
        @import 'https://fonts.googleapis.com/css?family=Dosis|Roboto:300,400';
        * {
            margin: 0;
            padding: 0;
        }
             body 
             {
                background-image: url(back.jpg);
                background-repeat: no-repeat;
                background-size: 1300px 700px;
             }
            .back_btn
                {
                   
                    margin: 50px 300px ;
                    outline: none !important;
                   
                }
               .homepage
               {
                position:absolute;
                float:left;    
                width: 50%;
                height: 60px;
                top: 0;
                border: 0;
                font-family: 'Dosis';
                font-size: 24px;
                text-transform: uppercase;
                cursor: pointer;
                background-color:#FA9268; 
                color:white;
               }

               .delete 
               {
                   float:right;
                   outline: none !important;
                   position: relative;
                    width: 50%;
                    height: 60px;
                    bottom: 0;
                    border: 0;
                    font-family: 'Dosis';
                    font-size: 24px;
                    text-transform: uppercase;
                    color:white;
                    cursor: pointer;
                    background-color: #ff7d00;;

               }
               p 
               {
                   font-size:50px;
                   color:#fa6f1fd0;
                   
               }
               .back_btn a 
               {
                   text-decoration:none;
                   color:white;
               }
            
            </style>
        <head>

    <body>
          
         

        <div class="back_btn">
            
        <form action="delete.php" method="POST">
            <button class="homepage"  name="submit"><a href="welcome.php"> Back to homepage  </a></button> <br>
            <p> Are you sure you want to delete your account? </p>
            <img src="q.png">
            <button class="delete" name="delete" value="delete"> DELETE MY ACCOUNT</buttton>
        </div>
        </form>
        
</body>

</html>