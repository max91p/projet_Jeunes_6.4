<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" href="./style/creer_demande.css">
    <title>Créer une demande de référence</title>
</head>
<body>
    <?php
        use PHPMailer\PHPMailer\PHPMailer; 
        use PHPMailer\PHPMailer\SMTP; 
        use PHPMailer\PHPMailer\Exception;
        require 'PHPMailer/src/Exception.php'; 
        require 'PHPMailer/src/PHPMailer.php'; 
        require 'PHPMailer/src/SMTP.php';
		if(isset($_POST["submit"])) {
            $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $id="";
            $id .= $caracteres[rand(10,strlen($caracteres)-1)];
            for ($i = 0; $i < 9; $i++) {
                $id .= $caracteres[rand(0,strlen($caracteres)-1)];
            }
			enregistrer_demande($id);
            envoyer_demande_mail($id);
		}
        function enregistrer_demande($id){
            $milieu=$_POST["milieu"];
            $duree=$_POST["duree"];
            $description=$_POST["description"];
            $savoir_faire=$_POST["savoir_faire"];
            $savoir_etre=$_POST["savoir_etre"];
            $nom_referent=$_POST["nom_referent"];
            $prenom_referent=$_POST["prenom_referent"];
            $email_referent=$_POST["email_referent"];
            $nom_jeune=$_SESSION["nom"];
            $prenom_jeune=$_SESSION["prenom"];
            $email_jeune=$_SESSION["email"];
            $fichier=fopen("references.txt","a");
            $date=date("d/m/Y");
            $texte="$id|$email_jeune|$milieu|$duree|$description|$savoir_faire|$savoir_etre|$nom_referent|$prenom_referent|$email_referent|$date|En attente\n\n\n";
            fwrite($fichier,$texte);
			fclose($fichier);
        }
		function envoyer_demande_mail($id){
            $milieu=$_POST["milieu"];
            $duree=$_POST["duree"];
            $description=$_POST["description"];
            $savoir_faire=$_POST["savoir_faire"];
            $savoir_etre=$_POST["savoir_etre"];
            $nom_referent=$_POST["nom_referent"];
            $prenom_referent=$_POST["prenom_referent"];
            $email_referent=$_POST["email_referent"];
            $nom_jeune=$_SESSION["nom"];
            $prenom_jeune=$_SESSION["prenom"];
            $email_jeune=$_SESSION["email"];
            $mail = new PHPMailer; 
            $mail->CharSet = "UTF-8";
            // Server settings 
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;    //Enable verbose debug output 
            $mail->isSMTP();                            // Set mailer to use SMTP 
            $mail->Host = 'smtp-mail.outlook.com';           // Specify main and backup SMTP servers 
            $mail->SMTPAuth = true;                     // Enable SMTP authentication 
            $mail->Username = 'jeunes64@outlook.fr';       // SMTP username 
            $mail->Password = 'InfoProjet64';         // SMTP password 
            $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted 
            $mail->Port = 587;                          // TCP port to connect to 
            $mail->setFrom('jeunes64@outlook.fr', 'Jeunes 6.4'); 
            $mail->addReplyTo('jeunes64@outlook.fr', 'Jeunes 6.4');
            $mail->addAddress($email_referent);
            $mail->isHTML(true);
            $mail->Subject = "Jeunes 6.4 : Demande de référence pour $prenom_jeune $nom_jeune"; 
            $bodyContent = "Bonjour $prenom_referent $nom_referent,<br><br>$prenom_jeune $nom_jeune vous demande d'être son référent pour son expérience dans le milieu \"$milieu\" via la plateforme Jeunes 6.4.<br><br>
            JEUNES 6.4 est un dispositif de valorisation de l’engagement des jeunes en Pyrénées-Atlantiques soutenu par l’Etat, le Conseil général, le conseil régional, les CAF Béarn-Soule et Pays Basque, la MSA, l’université de Pau et des pays de l’Adour, la CPAM.<br><br>
            Cliquez sur ce lien pour valider la demande de référence de $prenom_jeune $nom_jeune : localhost/projet/PreIng%202/projet_Jeunes_6.4/consulter_reference_referent.php/?reference_id=$id<br>
            (Pour ouvrir cette page dans localhost, tapez le chemin vers le fichier consulter_reference_referent.php et rajouter /?reference_id=$id derrière)<br><br>
            Cordialement,<br><br>L'équipe de Jeunes 6.4"; 
            $mail->Body= $bodyContent;
            $res=$mail->send();
            header("Location: accueil_compte.html", true);
            exit();
        }
	?>
	<header>
        <div id="logo">
		    <a href=page_accueil2.html><img src="./media/logo.png" alt="Logo site"></a>
			
		</div>
		<div id="texte"><p>Je donne de la valeur à mon engagement</p></div>
		
		<div id="bouton">
			<a href="voir_profil.php">Jeune</a>
		</div>
	</header>
	<main>
        <a href="accueil_compte.html"><img id="home" src="./media/home.png" alt="home"></a>
        <div id="title" >Décrivez votre expérience et mettez en avant ce que vous en avez retiré.</div>
        <form method="post">
            <table style="width:100%;table-layout: fixed;" cellspacing=4>
                <colgroup>
                    <col span="1" style="width: 50%;">
                    <col span="1" style="width: 25%;">
                    <col span="1" style="width: 25%;">
                </colgroup>
                <tr>
                    <td>
                        <div class="subtitle">Mon engagement :</div>

                        <div class="form">
                            <label for="milieu">Milieu de l'engagement :</label>
                            <input id="milieu" name="milieu" type="text">
                        </div>
                        <div class="form">
                            <label for="duree">Durée de l'engagement :</label>
                            <input id="duree" name="duree" type="text">
                        </div>
                        <div class="form">
                            <label for="description">Description de l'engagement :</label>
                            <textarea style="height:100px;" id="description" name="description" type="text"></textarea>
                        </div>
                    </td>
                    <td>
                        <div class="subtitle">Mes savoir-faire :</div>
                        <textarea style="height:273px;" name="savoir_faire" type="text"></textarea>
                    </td>
                    <td>
                        <div class="subtitle">Mes savoir-être :</div>
                        <textarea style="height:273px;" name="savoir_etre" type="text"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="subtitle">Mon référent :</div>
                        <div class="form">
                            <label for="nom_referent">Nom :</label>
                            <input id="nom_referent" name="nom_referent" type="text">
                        </div>
                        <div class="form">
                            <label for="prenom_referent">Prénom :</label>
                            <input id="prenom_referent" name="prenom_referent" type="text">
                        </div>
                        <div class="form">
                            <label for="email_referent">Email :</label>
                            <input id="email_referent" name="email_referent" type="email">
                        </div>
                    </td>
                </tr>
            </table>
            <br>
            <div id="submit">
                <input type="submit" name="submit" value="Valider">
            </div>
        </form>
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