<?php
include('connection.php');
include('header.php');





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
        {
          
?>
<!DOCTYPE HTML>
<!--
	Visualize by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Profile info</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <style>
            li 
            {
                list-style-type: none;
            }
            </style>
	</head>
	<body>

		

				<!-- Header -->
					<header id="header">
						<span class="avatar"><img src="images/avatar.png" alt="" /></span>
						<h1>
                        <?php
                         
                          echo "<ul>";
                              echo "<li>";
                              echo "Name:";
                              echo "</li>";
                                  echo "<li>";
                                  echo $row["name"];
                                  echo "</li>";
                                  
                              echo "</ul>";
              
                              echo "<ul>";
                                  echo "<li>";
                                  echo "Last name";
                                  echo "</li>";
                                  echo "<li>";
                                  echo $row["last_name"];
                                  echo "</li>";
                              echo "</ul>";
                              
              
                              echo "<ul>";
                                  echo "<li>";
                                  echo "E-mail:";
                                  echo "</li>";
                                  echo "<li>";
                                  echo $row["email"];
                                  echo "</li>";
                              echo "</ul>";
                              
              
                              echo "<ul>";
                                  echo "<li>";
                                  echo "Address:"; 
                                  echo "</li>";
                                  echo "<li>";
                                  echo $row["address"];
                                  echo "</li>";
                              echo "</ul>";
                             
              
                              echo "<ul>";
                                  echo "<li>";
                                  echo "Telephone:";
                                  echo "</li>";
                                  echo "<li>";
                                  echo $row["telephone"];
                                  echo "</li>";
                              echo "</ul>";
                              
                          

                        ?>
                        </h1>
                        <?php
                         }
                        }
                        ?>
						<ul class="icons">
							<li><a href="https://twitter.com/" class="icon style2 fa-twitter">
                            <span class="label">Twitter</span></a></li>
							<li><a href="https://facebook.com/" class="icon style2 fa-facebook">
                            <span class="label">Facebook</span></a></li>
							<li><a href="" class="icon style2 fa-instagram">
                            <span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon style2 fa-500px">
                            <span class="label">500px</span></a></li>
							<li><a href="#" class="icon style2 fa-envelope-o">
                            <span class="label">Email</span></a></li>
						</ul>
					</header>

				<!-- Main -->
					<section id="main">

                        <!-- Thumbnails -->
                        <p> My gallery </p>
							<section class="thumbnails">
								<div>
									<a href="images/fulls/01.jpg">
										<img src="images/thumbs/01.jpg" alt="" />
										<h3>Slika1</h3>
									</a>
									<a href="images/fulls/02.jpg">
										<img src="images/thumbs/02.jpg" alt="" />
										<h3>Slika2</h3>
									</a>
								</div>
								<div>
									<a href="images/fulls/03.jpg">
										<img src="images/thumbs/03.jpg" alt="" />
										<h3>Slika3</h3>
									</a>
									<a href="images/fulls/04.jpg">
										<img src="images/thumbs/04.jpg" alt="" />
										<h3>Slika4</h3>
									</a>
									<a href="images/fulls/05.jpg">
										<img src="images/thumbs/05.jpg" alt="" />
										<h3>Slika5</h3>
									</a>
								</div>
								<div>
									<a href="images/fulls/06.jpg">
										<img src="images/thumbs/06.jpg" alt="" />
										<h3>Slika 6</h3>
									</a>
									<a href="images/fulls/07.jpg">
										<img src="images/thumbs/07.jpg" alt="" />
										<h3>Slika 7</h3>
									</a>
								</div>
							</section>

					</section>

				<!-- Footer -->
					<footer id="footer">
						<p>&copy; 2019. All rights reserved. Design: 
                            <a href="https://milenart.portfoliobox.net/skituljart"> SkituljArt </a></p>
					</footer>

			

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.poptrox.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>