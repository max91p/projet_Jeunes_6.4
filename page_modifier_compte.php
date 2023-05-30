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
<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	session_start();
	$username = $_SESSION['email'];
	//session_unset();
	//session_destroy();

	echo 'username' . $username;
	var_dump($username);

	// récupération de toutes les lignes du fchier dans un tableau
	$data = file('people.csv');

	//echo $username;
	//débug
	//var_dump($_POST);

	foreach ($data as $item) {
		//on décode chaque ligne comme étant du csv
		$csv = str_getcsv($item, ';');
		//var_dump($csv);
		if ($username == $csv[3]) {

			$lastname = $csv[0];
			$firstname = $csv[1];
			$birth = $csv[2];
			$username = $csv[3];
			$password = $csv[4];
			//echo "utilisateur trouvé";
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
				<input id="password" value="<?php echo $password; ?>" name="password" type="password">
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