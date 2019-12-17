<?php
    include('connection.php');
    session_start();

    if(!isset($_SESSION['id']))
    {
        header('Location:login.php');
    }
    $id = $_SESSION['id'];


    $sql= "SELECT * FROM users
    WHERE id = '$id'
    ";

     $result = pg_query($conn, $sql);

     $row=pg_fetch_assoc($result);

        $user= $row['name'];
        $last_name = $row['last_name'];
        $email= $row['email'];
        $pass = $row['password'];
        $adress = $row['address'];
        $telephone = $row['telephone'];

        if(!empty($_POST))
        {
            $newUser= $_POST['name'];
            $newLastN = $_POST['last_name'];
            $newEmail = $_POST['email'];
            $newPass=$_POST['password'];
            $newAdress=$_POST['adress'];
            $newPhone = $_POST['phone'];

            $sql1 = "
            UPDATE users
            SET name = '$newUser', last_name = '$newLastN', email= '$newEmail', password= '$newPass',
            address = '$newAdress', telephone= '$newPhone'
            WHERE id = $id
            ";
            $result = pg_query($conn, $sql1);

            if(!$result)
            {
                echo "SQl not good";
            }
            else
            {
                echo "<center><p> <span style='margin-top:250px;'>updated your profile succesfully </span> </p> </center>";
                
            }

        }
        else 
        {
            echo "<center>  <span style='margin-top:250px;'><p> You must enter your new informations  </span>  </p> </center>";
        }



?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <style>
            .error
                {
                    color: red;
                }

        </style>
    </head>

    <body>

    <?php



if(!isset($_SESSION['id']))
{
    header('Location:login.php');
}
$id = $_SESSION['id'];


$sql= "SELECT * FROM users
    WHERE id = '$id'
    ";
$result = pg_query($conn, $sql);

$row=pg_fetch_assoc($result);

if(!$result)
{
    echo "<p>" . "Error" . error($conn) . "</p>";
}
else
{
    if(pg_num_rows($result)== 0)
    {
        echo "no user in database";
    }
    else
   


?>        
  



       
    <div class="back_btn">
            <button class="form-btn dx1"  name="submit"><a href="welcome.php"> Back to homepage  </a></button> <br>
    </div>
    
    <div class="container">
        <h1> Edit your profile </h1>
        
            <form method="POST" action="edit.php">



                    <label for="name"> Name: </label>
                        <input type="text" class="name" name="name" 
                        placeholder=<?php echo $row['name']?> required > <br> <br>

                    <label for="lastname">Last Name: </label>
                        <input type="text" class="last_name" name="last_name" 
                        placeholder="<?php echo $row['last_name']?>" required>  <br> <br>

                    <label for="email"> Email: </label>
                        <input type="email" class="email" name="email" 
                        placeholder="<?php echo $row['email']?>" required > <br> <br>

                    <label for="password"> Password: </label>
                        <input type="password" class="password" name="password" 
                        placeholder="Update your Password" reqired>
                         <br> <br>

                    <label for="adress"> Adress: </label>
                        <input type="adress" class="adress" name="adress" 
                        placeholder="<?php echo $row['address']?>" required> <br> <br>

                    <label for="telephone"> Telephone: </label>
                        <input type="number" class="phone" name="phone" 
                        placeholder="<?php echo $row['telephone']?>"required> <br> <br>
                    <button class="form-btn dx" type="submit" name="submit"> UPDATE  </button>
    </div>

    </form>

    </body>
    <?php
        }
        ?>
</html>