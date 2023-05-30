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
		<form action="modification_compte.php" method="post">
            <p>Nom <input value=<?php echo $lastname; ?> name="lastname" type="text"></p>
            <p>Prénom <input value=<?php echo $firstname; ?> name="firstname" type="text"></p>
            <p>Date de naissance <input value=<?php echo $birth; ?> name="birth" type="date"></p>
	<!--<p>Email <input value="martin.dupont@gmail.com" name="email" type="email"></p>-->
			<p>Mot de passe <input value=<?php echo $password; ?> name="password" type="password"></p>
			<input type="submit" value="Enregistrer">
		</form>
	</main>
</body>

</html>