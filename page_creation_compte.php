<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<style>
		header{
			width: 100%;
			height: 100px;
			left: 0px;
			top: 0px;
			background: #D9D9D9;
		}
		a{
			 all: unset;
		}
	</style>
</head>
<body style="margin: 0;">
	<header>
		<div align=left style="vertical-align: middle;">
		    <a href=page_accueil2.html><img style="max-height: 100px;" src="logo.png" alt="Logo site"></a>
		</div>
		<div align=right style="vertical-align: middle;position:absolute;right:40px;top:25px;height:50px;line-height: 50px;">
			<a style="vertical-align: middle;font-size: 30px;">Jeune</a>
		</div>
	</header>
	<main>
		<form action="ajout_compte.php" method="post">
            <p>Nom <input name="nom" type="text"></p>
            <p>Prénom <input name="prenom" type="text"></p>
            <p>Date de naissance <input name="naissance" type="date"></p>
			<p>Email <input name="email" type="email"></p>
			<p>Mot de passe <input name="mdp" type="password"></p>
			<input type="submit" value="Envoyer">
		</form>
		<p>Vous avez déjà un compte ? <a style="color:blue" href="page_connexion.php">Connectez-vous</a></p>
	</main>
</body>

</html>
