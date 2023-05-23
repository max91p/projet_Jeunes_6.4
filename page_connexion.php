<!DOCTYPE html>
<html lang="fr">
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

	<?php
session_start();
echo $_SESSION['error'];
$_SESSION['message'] = '';
?>

	<main>
		<form action="verification_connexion.php" method="post">
			<p>Email <input name="email" type="email" id="email"></p>
			<p>Mot de passe <input name="password" type="password" id="password"></p>
			<input type="submit" value="connexion">
		</form>
		<p>Vous avez pas de compte ? <a style="color:blue" href="page_creation_compte.php">Inscrivez-vous</a></p>
	</main>
</body>

</html>
