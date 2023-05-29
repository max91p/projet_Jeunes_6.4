<?php
	session_start();
?>
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
    <?php
        $nom_jeune=$_SESSION['nom_jeune'];
        $prenom_jeune=$_SESSION['prenom_jeune'];
        $milieu=$_SESSION['milieu'];
        echo 
				"<header>
					<div align=left style='vertical-align: middle;'>
						<a href=page_accueil2.html><img style='max-height: 100px;' src='media/logo.png' alt='Logo site'></a>
					</div>
					<div align=right style='vertical-align: middle;position:absolute;right:40px;top:25px;height:50px;line-height: 50px;'>
						<a style='vertical-align: middle;font-size: 30px;'>Référent</a>
					</div>
				</header>
				<main>
                    <div style='border:2px solid #ABDA4E;margin:50px;padding-right:20px;padding-left:20px'>
					    <h2>Merci !</h2>
                        <p>Vos ajouts sur cette référence dans le milieu \"$milieu\" ont été envoyés à $prenom_jeune $nom_jeune par mail.<br><br>
                        $prenom_jeune $nom_jeune pourra envoyer ses références à des recruteurs et ils auront accès à votre identité et adresse mail.</p>
                    </div>
				</main>";
	?>
	
</body>

</html>