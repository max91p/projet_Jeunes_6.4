<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="./style/page_creation_compte.css">
	<title>Création Compte</title>
</head>
<body>
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
			<legend>Créez un compte</legend>
		<form action="page_sauvegarde_compte.php" method="post">
            <div class="form">
				<label for="lastname">Nom</label>
				<input id="lastname" name="lastname" type="text" placeholder="Martin" required>
			</div>
            <div class="form">
				<label for="firstname">Prénom</label>
				<input id="firstname" name="firstname" type="text" placeholder="Arthur" required>
			</div>
            <div class="form">
				<label for="birth">Date de naissance</label>
				<input id="birth" name="birth" type="date" required>
			</div>
			<div class="form">
				<label for="email">Email</label>
				<input id="email" name="username" type="email" placeholder="arthur.martin@gmail.com" required>
			</div>
			<div class="form">
				<label for="password">Mot de passe</label>
				<input id="password" name="password" type="password" placeholder="*******">
			</div>
			<div id="submit" class="form"> 
				<input type="submit" value="Créer un compte">
			</div>
		</form>
			<p>Vous avez déjà un compte ? <a href="page_connexion.php">Connectez-vous</a></p>
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
