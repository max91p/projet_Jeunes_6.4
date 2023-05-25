<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="./style/page_creation_compte.css">
	
</head>
<body style="margin: 0;">
<header>
		<div id="logo">
		    <a href=page_accueil2.html><img style="max-height: 100px;" src="logo.png" alt="Logo site"></a>
			
		</div>
		<div id="texte">Je donne de la valeur à mon engagement</div>
		
		<div id="bouton">
			<a href="voir_profil.php">Jeune</a>
		</div>
	</header>
	<main>
		<div class="gauche  "> <fieldset>
		<form action="ajout_compte.php" method="post">
			<p>  <span class="rose">Créez un compte  </span></p>
            <p>Nom  <br><input size="50" placeholder="Martin" name="nom" type="text"></p>
            <p>Prénom <br><input size="50" placeholder="Arthur" name="prenom" type="text"></p>
            <p>Date de naissance <br><input  name="naissance" type="date"></p>
			<p>Email <br><input  size="50" placeholder="arthur.martin@gmail.com" name="email" type="email"></p>
			<p>Mot de passe <br><input size="50"  placeholder="****" name="mdp" type="password"></p>
			<div class="centre"> <input class="submit" type="submit" value="Créer un compte"> 
		</form>
		<p>Vous avez déjà un compte ? <a style="color:rgb(240, 9, 124)" href="page_connexion.php">Connectez-vous</a></p>
		</div>  
		</div>
		</fieldset>
	</main>
</body>

</html>
