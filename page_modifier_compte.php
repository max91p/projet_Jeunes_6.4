<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="./style/page_modifier_compte.css">
	<title>Modifier mon compte</title>
</head>
<body>
	<header>
		<div id="logo">
		    <a href="page_accueil2.html"><img src="./media/logo.png" alt="Logo site"></a>
		</div>
		<div id="texte">Je donne de la valeur à mon engagement</div>
		<div id="bouton">
			<a href="voir_profil.php">Jeune</a>
		</div>
	</header>
	<main>
		<a href='voir_profil.php'><img id='arrow' src='./media/arrow.png' alt='arrow'></a>
<?php

	session_start();
	$username = $_SESSION['email'];

	// récupération de toutes les lignes du fchier dans un tableau
	$data = file('people.csv');

	foreach ($data as $item) {
		//on décode chaque ligne comme étant du csv
		$csv = str_getcsv($item, ';');
	
		if ($username == $csv[3]) {

			$lastname = $csv[1];
			$firstname = $csv[0];
			$birth = $csv[2];
			$username = $csv[3];
			$password = $csv[4];
			break;
		}
	}
?>
	<div id="content">
		<fieldset>
		<legend>Modifier mon compte</legend>
		<form action="modification_compte.php" method="post">
            <div class="form">
				<label for="lastname">Nom</label>
				<input id="lastname" value="<?php echo $lastname; ?>" name="lastname" type="text" >
			</div>
            <div class="form">
				<label for="firstname">Prénom</label>
				<input id="firstname" value="<?php echo $firstname; ?>" name="firstname" type="text">
			</div>
            <div class="form">
				<label for="birth">Date de naissance</label>
				<input id="birth" value="<?php echo $birth; ?>" name="birth" type="date">
			</div>
			<div class="form">
				<label for="password">Mot de passe</label>
				<input id="password" name="password" type="password">
			</div>
			<div id="submit" class="form"> 
				<input type="submit" value="Enregistrer">
			</div>
		</form>
		</fieldset>
	</div>
	</main>
</body>

</html>
