<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="./style/voir_profil.css">
	<title>Profil</title>
</head>
<body>
	<header>
		<div id="logo">
			<a href=page_accueil2.html><img src="./media/logo.png" alt="Logo site"></a>
		</div>
		<div id="texte"><p>Je donne de la valeur à mon engagement</p></div>
		<div id="bouton">
			Jeune
		</div>
	</header>
			<?php

		session_start();
		$username = $_SESSION['email'];
		//session_unset();
		//session_destroy();

// récupération de toutes les lignes du fchier dans un tableau
$data = file('people.csv');

//echo $username;
//débug
//var_dump($_POST);

foreach ($data as $item) {
    //on décide chaque ligne comme étant du csv
    $csv = str_getcsv($item, ';');
	
    //prise en compte si il y a des lignes vides
    if (count($csv) != 5) {
	continue;
    }
    
    if ($username == $csv[3]) {

		$firstname = $csv[0];
		$lastname = $csv[1];
		$birth = $csv[2];
		$username = $csv[3];

		//echo "utilisateur trouvé";
		break;
    }
}
?>
	<main>
		<a href="accueil_compte.html"><img id="home" src="./media/home.png" alt="home"></a>
		<div id="content">
			<div id="up">
				<div id="up-left">Votre compte</div>
				<div id="up-right">
					<a href="page_modifier_compte.php"><img id="edit" src="./media/edit.png" alt="edit"></a>
				</div>
			</div>
			<p class='title'>Nom</p>
			<p><?php echo $lastname?></p>
			<p class='title'>Prénom</p>
			<p><?php echo $firstname?></p>
			<p class='title'>Date de naissance</p>
			<p><?php echo $birth?></p>
			<p class='title'>Email</p>
			<p><?php echo $username?></p>
		</div>
		<div id="bouton_deconnexion">
			<a href="deconnexion.php">Déconnexion</a>
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
