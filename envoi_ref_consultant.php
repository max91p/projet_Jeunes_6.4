<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\SMTP; 
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/src/Exception.php'; 
    require 'PHPMailer/src/PHPMailer.php'; 
    require 'PHPMailer/src/SMTP.php';
    if(isset($_POST["envoyer_mail_consultant"])) {
        $nom_jeune=$_SESSION['nom_jeune'];
        $prenom_jeune=$_SESSION['prenom_jeune'];
        $liste_ids=$_SESSION['nouv_str_ids'];
        $nom_consultant=$_POST['nom_consultant'];
        $prenom_consultant=$_POST['prenom_consultant'];
        $email_consultant=$_POST['email_consultant'];
        envoyer_demande_mail($liste_ids,$email_consultant,$prenom_consultant,$nom_consultant,$prenom_jeune,$nom_jeune);
        header("Location: accueil_compte.html", true);
        exit();

    }
    function envoyer_demande_mail($liste_id,$email,$prenom_consultant,$nom_consultant,$prenom_jeune,$nom_jeune){
	    // 0        1         2              3           4      5         6            7            8             9             10               11         12      13
		//"$id|$nom_jeune|$prenom_jeune|$email_jeune|$milieu|$duree|$description|$savoir_faire|$savoir_etre|$nom_referent|$prenom_referent|$email_referent|$date|$statut\n\n\n";
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
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "Jeunes 6.4 : Références de $prenom_jeune $nom_jeune"; 
        $bodyContent = "Bonjour $prenom_consultant $nom_consultant,<br><br>
		$prenom_jeune $nom_jeune vous envoie ses références via la plateforme Jeunes 6.4.<br><br>
        JEUNES 6.4 est un dispositif de valorisation de l’engagement des jeunes en Pyrénées-Atlantiques soutenu par l’Etat, le Conseil général, le conseil régional, les CAF Béarn-Soule et Pays Basque, la MSA, l’université de Pau et des pays de l’Adour, la CPAM.<br><br>
        Cliquez sur ce lien pour consulter les références de $prenom_jeune $nom_jeune : localhost/projet/PreIng%202/projet_Jeunes_6.4/liste_references_consultant.php/?references_id=$liste_id<br>
        (Pour ouvrir cette page dans localhost, tapez le chemin vers le fichier liste_references_consultant.php et rajouter /?references_id=$liste_id derrière)<br><br>
        Cordialement,<br><br>L'équipe de Jeunes 6.4"; 
        $mail->Body= $bodyContent;
        $res=$mail->send();
    }
?>