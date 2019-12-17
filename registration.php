<?php
    include('connection.php');

    $name=$email=$pass=$last_name=$adress=$telephone="";
    $nameO=$emailO=$passO=$last_nameO=$adressO=$telephoneO="";

   

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $valid_form = TRUE;
        
                if(empty($_POST["name"]))
                    {
                        $nameO = "Name cannot be empty";
                        $valid_form = FALSE;
                    } 
                elseif(preg_match('/^[a-z]*$/i', $_POST["name"]) == FALSE)
                    {
                        $nameO = "You can insert only letters"; 
                        $valid_form = FALSE;
                    }
                else
                    {
                        $name = $_POST["name"];
                    } 
                

                
                if(empty($_POST["last_name"]))
                    {
                        $last_nameO = "Lastname cannot be empty";
                        $valid_form = FALSE;
                    } 
                elseif(preg_match('/^[a-z]*$/i', $_POST["last_name"]) == FALSE)
                    {
                        $last_nameO = "You can insert only letters"; 
                        $valid_form = FALSE;
                    }
                else
                    {
                        $last_name = $_POST["last_name"];
                    }
                    
                    
                if(empty($_POST["email"]))
                    {
                        $emailO = "Email cannot be empty";
                        $valid_form = FALSE;
                    }
                else
                    {
                        $email = $_POST["email"];
                    }
                


                if(empty($_POST["password"]))
                    {
                    $passO="Password field cannot be empty"; 
                    $valid_form = FALSE;
                    }
                else
                    {
                        $pass=md5($_POST['password']);
                    }

                    
                if(empty($_POST["adress"]))
                    {
                        $adressO = "Address field cannot be empty";
                        $valid_form = FALSE;
                    }
                else
                    {
                        $adress = $_POST["adress"];
                    }
                    

                if(empty($_POST["phone"]) == TRUE)
                    {
                        $telephoneO = "Telephone field cannot be empty";
                        $valid_form = FALSE;
                    }
                elseif(is_numeric($_POST["phone"]) == FALSE)
                    {
                        $telephoneO = "You can insert only numbers";
                        $valid_form = FALSE;
                    }
                else
                    {
                        $telephone = $_POST["phone"];
                    }
                    
        if($valid_form)
        {
                    $sql ="INSERT INTO users(name, last_name,email, password, address, telephone,
                    confirmed, role_id)
                    VALUES('$name', '$last_name','$email','$pass', '$adress', '$telephone',0,2) ";

                    $result = pg_query($conn, $sql);
                   

                    if (!$result) 
                    {
                    die("Error in SQL query: " . pg_last_error());
                    }
                    else 
                    {
                        echo "data entered correctly";
                        session_start();
                        if(!isset($_SESSION['id']))
                            {
                                header('Location: login.php');
                                echo 'user not loged in';
                            }
                            else
                            {
                                header('Location:welcome.php');
                            }
                        
                    }         
        }

    }
?>

<html>
    <head>
    <link rel="stylesheet" type="text/css" href="style.css">
        <style>
            .error
            {
                color:red;
            }
        </style>

       
       
    </head>

    <body>  
        <br>
    <div class="back_btn">
            <button class="form-btn dx1"  name="submit"><a href="login.php"> Back to login  </a></button> <br>
    </div>
       
    <div class="container">
        <h1> Registration </h1>
            <form method="POST" action="registration.php">
                    <label for="name"> Name: </label>
                        <input type="text" class="name" name="name" 
                        placeholder="Insert your name" required>
                        <span class="error"><?php echo $nameO; ?></span> <br> <br>

                    <label for="lastname">Last Name: </label>
                        <input type="text" class="last_name" name="last_name" 
                        placeholder="Insert your last name" required>
                        <span class="error"><?php echo $last_nameO; ?></span> <br> <br>

                    <label for="email"> Email: </label>
                        <input type="email" class="email" name="email" 
                        placeholder="Insert your e-mail" required >
                        <span class="error"><?php echo $emailO; ?></span> <br> <br>

                    <label for="password"> Password: </label>
                        <input type="password" class="password" name="password"
                         placeholder="Insert Password" reqired >
                         <br> <br>

                    <label for="adress"> Adress: </label>
                        <input type="adress" class="adress" name="adress" 
                        placeholder="Insert your adress" required> 
                        <span class="error"><?php echo $adressO; ?></span><br> <br>

                    <label for="telephone"> Telephone: </label>
                        <input type="number" class="phone" name="phone" 
                        placeholder="Insert your phone number" required>
                        <span class="error"><?php echo $telephoneO; ?></span> <br> <br>

                    <button class="form-btn dx" type="submit" id="redirect" name="submit"> REGISTER </button>
    </div>

    </form>

    </body>
</html>
