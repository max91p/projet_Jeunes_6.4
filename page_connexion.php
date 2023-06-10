<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="./style/page_connexion.css">
	<title>Connexion</title>
	
</head>
<body>
	<?php
		if(isset($_SESSION["email"]) && isset($_SESSION["prenom"]) && isset($_SESSION["nom"])){
			header('Location: accueil_compte.html');
			exit();
		}
	?>
	<header>
		<div id="logo">
		    <a href=page_accueil2.html><img src="./media/logo.png" alt="Logo site"></a>
			
		</div>
		<div id="texte">Je donne de la valeur à mon engagement</div>
		
		<div id="bouton">
			Jeune
		</div>
	</header>
	<main>
		<div id="content"> 
		<fieldset>
			<legend>Connectez-vous</legend>
		<form action="verification_connexion.php" method="post">
			<div class="form">
				<label for="email">Email</label>
				<input type="email" name="email" id="email" placeholder="arthur.martin@gmail.com">
			</div>
			<div class="form">
				<label for="password">Mot de passe</label>
				<input type="password" name="password" id="password" placeholder="*******">
			</div>	
			
			<div id="submit" class="form">
				<input  class="submit "type="submit" value="Se connecter"> 
			</div>
		</form>
		<p>Vous avez pas de compte ? <a href="page_creation_compte.php">Inscrivez-vous</a></p>
		</fieldset>
		</div>
	</main>
</body>
<script>
	// recupère la largeur du navigateur et cache le texte si la largeur est inférieure à 865px
	window.addEventListener('resize', function() {
		var browserWidth = window.innerWidth;

		if (browserWidth < 865) { 
			document.getElementById('texte').style.display = 'none';
		} else {
			document.getElementById('texte').style.display = 'inline-block';
		}
	});
</script>
</html>
