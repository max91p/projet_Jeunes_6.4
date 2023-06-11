<?php
    session_start();
    //importation de la bibliothèque PHPMailer
    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\SMTP; 
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/src/Exception.php'; 
    require 'PHPMailer/src/PHPMailer.php'; 
    require 'PHPMailer/src/SMTP.php';
    if(isset($_POST["envoyer_mail_consultant"])) {
        $nom_jeune=$_SESSION['nom'];
        $prenom_jeune=$_SESSION['prenom'];
        $liste_ids=$_SESSION['nouv_str_ids']; //Liste des id des références sélectionnées
        $nom_consultant=$_POST['nom_consultant'];
        $prenom_consultant=$_POST['prenom_consultant'];
        $email_consultant=$_POST['email_consultant'];
        envoyer_references_mail($liste_ids,$email_consultant,$prenom_consultant,$nom_consultant,$prenom_jeune,$nom_jeune);
        header("Location: accueil_compte.html", true);
        exit();

    }
    function envoyer_references_mail($liste_id,$email,$prenom_consultant,$nom_consultant,$prenom_jeune,$nom_jeune){
        //envoi du mail au consultant
        $mail = new PHPMailer; //Initialise la variable comme objet de la classe PHPMailer
        $mail->CharSet = "UTF-8";
        //Paramètres du serveur 
        $mail->isSMTP();
        $mail->Host = 'smtp-mail.outlook.com';           // Précise l'hote
        $mail->SMTPAuth = true;                     // Autorise l'authentification SMTP
        $mail->Username = 'jeunes64@outlook.fr';       //L'addresse mail expéditeur
        $mail->Password = 'InfoProjet64';         //Le mot de passe de l'addresse mail expéditeur
        $mail->SMTPSecure = 'tls';                  //Chiffrement
        $mail->Port = 587;                          //Port sur lequel se connecter
        $mail->setFrom('jeunes64@outlook.fr', 'Jeunes 6.4'); //Adresse mail et le nom de l'expéditeur
        $mail->addReplyTo('jeunes64@outlook.fr', 'Jeunes 6.4');
        $mail->addAddress($email); //Adresse mail du destinataire
        $mail->isHTML(true); //Mail au format html
        $mail->Subject = "Jeunes 6.4 : Références de $prenom_jeune $nom_jeune"; //Objet du mail
        $bodyContent = "Bonjour $prenom_consultant $nom_consultant,<br><br>
		$prenom_jeune $nom_jeune vous envoie ses références via la plateforme Jeunes 6.4.<br><br>
        JEUNES 6.4 est un dispositif de valorisation de l’engagement des jeunes en Pyrénées-Atlantiques soutenu par l’Etat, le Conseil général, le conseil régional, les CAF Béarn-Soule et Pays Basque, la MSA, l’université de Pau et des pays de l’Adour, la CPAM.<br><br>
        Cliquez sur ce lien pour consulter les références de $prenom_jeune $nom_jeune : localhost/projet/PreIng%202/projet_Jeunes_6.4/consulter_liste_demande_consultant.php/?references_id=$liste_id<br>
        (Pour ouvrir cette page dans localhost, tapez le chemin vers le fichier consulter_liste_demande_consultant.php et rajouter /?references_id=$liste_id derrière)<br><br>
        Cordialement,<br><br>L'équipe de Jeunes 6.4"; 
        $mail->Body= $bodyContent;//Contenu du mail
        $res=$mail->send();//Envoi du mail
    }
?>
