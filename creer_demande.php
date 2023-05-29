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
            $nom_jeune=$_SESSION["nom_jeune"];
            $prenom_jeune=$_SESSION["prenom_jeune"];
            $email_jeune=$_SESSION["email_jeune"];
            $fichier=fopen("references.txt","a");
            $date=date("d/m/Y");
            $texte="$id|$nom_jeune|$prenom_jeune|$email_jeune|$milieu|$duree|$description|$savoir_faire|$savoir_etre|$nom_referent|$prenom_referent|$email_referent|$date|En attente\n\n\n";
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
            $nom_jeune=$_SESSION["nom_jeune"];
            $prenom_jeune=$_SESSION["prenom_jeune"];
            $email_jeune=$_SESSION["email_jeune"];
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
		<div align=left style="vertical-align: middle;">
            <a href=page_accueil2.html><img style="max-height: 100px;" src="media/logo.png" alt="Logo site"></a>
		</div>
		<div align=right style="vertical-align: middle;position:absolute;right:40px;top:25px;height:50px;line-height: 50px;">
			<a href="voir_profil.php" style="vertical-align: middle;font-size: 30px;">Jeune</a>
		</div>
	</header>
	<br>
	<br>
	<main>
        <a href="accueil_compte.html"><--</a>
        <h5>Décrivez votre expérience et mettez en avant ce que vous en avez retiré.</h5>
        <form method="post">
            <table style="width:100%;table-layout: fixed;" cellspacing=4>
                <colgroup>
                    <col span="1" style="width: 50%;">
                    <col span="1" style="width: 25%;">
                    <col span="1" style="width: 25%;">
                </colgroup>
                <tr>
                    <td style="border:2px solid black;margin:0;padding:5px 15px 5px 10px;"><div>
                        Mon engagement :<br>
                        <br>Milieu de l'engagement : <input style="width:100%;" name="milieu" type="text">
                        <br><br>Durée de l'engagement :<input style="width:100%;" name="duree" type="text">
                        <br><br>Description de l'engagement : <textarea style="width:100%;height:100px;" name="description" type="text"></textarea>
                    </div></td>
                    <td style="border:2px solid black;margin:0;padding:5px 15px 5px 10px;vertical-align:top;"><div style="height:100%;">
                        Mes savoir-faire :<br><br>
                        <textarea style="width:100%;height:233px;" name="savoir_faire"></textarea>
                    </div></td>
                    <td style="border:2px solid black;margin:0;padding:5px 15px 5px 10px;vertical-align:top;"><div style="height:100%;">
                        Mes savoir-être :<br><br>
                        <textarea style="width:100%;height:233px;" name="savoir_etre"></textarea>
                    </div></td>
                </tr>
                <tr>
                    <td style="border:2px solid black;margin:0;padding:5px 15px 10px 10px;vertical-align:top;"><div style="height:100%;">
                        Référent :
                        <br><br>Nom : <input style="width:100%;" name="nom_referent" type="text">
                        <br><br>Prénom : <input style="width:100%;" name="prenom_referent" type="text">
                        <br><br>Email :<input style="width:100%;" name="email_referent" type="text">
                    </div></td>
                </tr>
            </table>
            <br>
            <div style="text-align:center;">
            <input style="font-size:20px;" type="submit" name="submit" value="Valider">
            </div>
            <br>
            <br>
            <br>
            <br>
        </form>
	</main>
</body>

</html>