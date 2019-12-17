<html>
<head>
<style>
	.error
	{
		color: red;
	}
</style>
</head>

<body>
	<?php
		$ime = $prezime = $email = $website = $komentar = $pol = $pravila = "";
		$imeO = $prezimeO = $emailO = $websiteO = $komentarO = "*";
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			if(empty($_POST["ime"]) == TRUE)
			{
				$imeO = "Ime ne sme biti prazan string";
			}
			elseif(preg_match('/^[a-z]*$/i', $_POST["ime"]) == FALSE)
			{
				$imeO = "Ime može sadržati samo slova"; 
			}
			else
			{
				$ime = $_POST["ime"];
			}
			
			if(empty($_POST["prezime"]) == TRUE)
			{
				$prezimeO = "Prezime ne sme biti prazan string";
			}
			elseif(preg_match('/^[a-z]*$/i', $_POST["prezime"])== FALSE)
			{
				$prezimeO = "Prezime može sadržati samo slova"; 
			}
			else
			{
				$prezime = $_POST["prezime"];
			}
			
			if(empty($_POST["email"]) == TRUE)
			{
				$emailO = "E-mail ne sme biti prazan string";
			}
			elseif(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == FALSE)
			{
				$emailO = "E-mail nije dobro unet";
			}
			else
			{
				$email = $_POST["email"];
			}
			
			if(empty($_POST["website"]) == TRUE)
			{
				$websiteO = "Website ne sme biti prazan string";
			}
			elseif(filter_var($_POST["website"], FILTER_VALIDATE_URL) == FALSE)
			{
				$websiteO = "Neispravno unet website";
			}
			else
			{
				$website = $_POST["website"];
			}
			
			if(strlen($_POST["komentar"]) < 15)
			{
				$komentarO = "Komentar mora biti duži od 15 karaktera";
			}
			else
			{
				$komentar = $_POST["komentar"];
			}
			
			$pol = $_POST["pol"];
			
			if(isset($_POST["pravila"]) == TRUE)
			{
				$pravila = "Prihvaćena pravila";
			}
			else
			{
				$pravila = "Pravila nisu prihvaćena";
			}
			
			
		}
		
	?>
	
	<h2>PHP validacija forme</h2>
	<form method="post" action="validacijaForme.php" >
	
		Ime: 
		<input type="text" name="ime">
		<span class="error"><?php echo $imeO; ?></span>
		<br><br>
		
		Prezime:
		<input type="text" name="prezime">
		<span class="error"><?php echo $prezimeO; ?></span>
		<br><br>
		
		E-mail:
		<input type="text" name="email">
		<span class="error"><?php echo $emailO; ?></span>
		<br><br>
		
		Website:
		<input type="text" name="website">
		<span class="error"><?php echo $websiteO; ?></span>
		<br><br>
		
		Komentar:
		<textarea name="komentar">
		</textarea>
		<span class="error"><?php echo $komentarO ?></span>
		<br><br>
		
		Pol:
		<input type="radio" name="pol" value="ženski">Ženski
		<input type="radio" name="pol" value="muški">Muški
		<input type="radio" name="pol" value="drugo" checked>Drugo
		<br><br>
		
		Prihvatate pravila korišćenja:
		<input type="checkbox" name="pravila" value="DA">
		<br><br>
		
		<input type="submit" name="submit" value="Potvrdi">
	</form>
	
	<?php
	echo "<h2>Vaši podaci</h2>";
	echo "Korisnik: " . $ime . " " . $prezime;
	echo "<br>";
	echo "Korisnički mail: " . $email;
	echo "<br>";
	echo "Website korisnika: " . $website;
	echo "<br>";
	echo "Komentar korisnika: " . $komentar;
	echo "<br>";
	echo "Pol korisnika: " . $pol;
	echo "<br>";
	echo "Prihvaćena pravila korišćenja: " . $pravila;
	echo "<br>";
	
	
	?>
	
	
	
	
	
	
	
</body>
</html>