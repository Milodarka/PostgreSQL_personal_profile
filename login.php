<?php
   
    include('connection.php');


    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $user=$_POST['user'];
        $pass=$_POST['password'];

        if(empty($user) || empty($pass))
        {
            echo "you must enter your data";
        }
        else
        {
            $sql= "SELECT * FROM users
                    WHERE name = '$user'
                    ";

            $result = pg_query($conn, $sql);

            if(!$result)
            {
                echo "Sql code is not good";
            }
            else
            {
                if(pg_num_rows($result) == 0)
                {
                    echo"This user doesent exist in database";
                }
                else 
                {
                    $row=pg_fetch_assoc($result);
                    

                   // $sql1= "SELECT * FROM users
                   // WHERE password = '$pass'
                   // ";

                   // $result1 = pg_query($conn, $sql1);

                    //da li se razlikuju pasvodi
                    if(md5($pass) != $row['password'])
                    {
                        echo "Your password doesent match";
                        header('Location:login.php');
                        die();
                    }
                    else 
                    {
                        session_start();
                        $_SESSION['id'] = $row['id'];
                        header('Location:welcome.php');
                       // setcookie('login', "logged", time()+60); 

                    }
                    /*if(!isset($_SESSION['id']))
                        {
                            session_destroy();
                            header('Location: login.php');
                            
                        }
                    else 
                    {
                        header('Location:welcome.php');
                    } */
                }
            }
        }
    }


?>


<html>
    <head>
        <link rel="stylesheet" type="text/css" href="login_stil.css">
    </head>
     
    <body>
        <div class="body"></div>
            <div class="grad"></div>
            <div class="header">
                <div>Login<span> Form </span></div>
            </div>
            <br>
        
            <div class="login">
                <form method="POST" action="login.php">
                        <input type="text" placeholder="username"id="name" name="user">
                        <br>
                        <input type="password" placeholder="password" id="pass" name="password"><br> <br>
                        <input type="submit" id="sub" value="Login" name="submit">
                        
                </form>
                <button class="dgme"><a href="registration.php" target='_blank'>  Or register </a> </button>  
            </div>

     </body>
     <script type="text/javascript">

       

</script>


</html>