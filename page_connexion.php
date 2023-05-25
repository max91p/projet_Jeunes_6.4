<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="./style/page_connexion.css">
	
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
		<form action="verification_connexion.php" method="post">
		<p>  <span class="roseG">Connectez vous </span></p>
			<p>Email <br><input  size="50" placeholder="arthur.martin@gmail.com"name="email" type="email"></p>
			<p>Mot de passe  <br><input size="50"  placeholder="****" name="mdp" type="password"></p>
			<div class="centre"><input  class="submit "type="submit" value="Se connecter"> 
		</form>
		<p>Vous avez pas de compte ? <a style="color:blue" href="page_creation_compte.php"> <span class="rose">Inscrivez-vous</a></p> </div> </div>
	</main>
</body>

</html>
