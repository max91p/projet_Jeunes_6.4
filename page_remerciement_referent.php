<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="./style/page_remerciment_referent.css">


</head>
<body style="margin: 0;">
    <?php
        $nom_jeune=$_SESSION['nom_jeune'];
        $prenom_jeune=$_SESSION['prenom_jeune'];
        $milieu=$_SESSION['milieu'];
        echo 	
				"<header>
					<div id='logo'>
						<a href=page_accueil2.html><img src='./media/logo.png' alt='Logo site'></a>
						
					</div>
					<div id='texte'>Je confirme la valeur de ton engagement</div>
					
					<div id='bouton'>
						<a>Referent </a>
					</div>
				</header>
				<main>
					<div id='content'>
					<fieldset>
					    <h2>Merci !</h2>
                        <p>Vos ajouts sur cette référence dans le milieu \"$milieu\" ont été envoyés à $prenom_jeune $nom_jeune par mail.<br><br>
                        $prenom_jeune $nom_jeune pourra envoyer ses références à des recruteurs et ils auront accès à votre identité et adresse mail.</p>
                    </div>

					</fieldset>
				</div>
				</main> ";
				?>
	
</body>

</html>
