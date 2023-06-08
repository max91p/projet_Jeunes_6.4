<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="./style/infos_consultant.css">

</head>
<body style="margin: 0;">
    <?php
        use PHPMailer\PHPMailer\PHPMailer; 
        use PHPMailer\PHPMailer\SMTP; 
        use PHPMailer\PHPMailer\Exception;
        require 'PHPMailer/src/Exception.php'; 
        require 'PHPMailer/src/PHPMailer.php'; 
        require 'PHPMailer/src/SMTP.php';
        $ids_ref_a_envoyer="";
        $liste_demande=$_SESSION['liste_demande'];
        for ($i=0;$i<count($liste_demande);$i++){
            $id=$liste_demande[$i][0];
            if ($liste_demande[$i][11]=="Répondu" && isset($_POST["ref_$id"])){
                $selection=$_POST["ref_$id"];
                if ($selection=="on"){
                    $ids_ref_a_envoyer .= "$id,";
                }
            }
        }
        if (strlen($ids_ref_a_envoyer)==0){
            header("Location: selection_envoi_ref.php", true);
            exit();
        }
        $_SESSION['nouv_str_ids']=substr($ids_ref_a_envoyer,0,strlen($ids_ref_a_envoyer)-1);
        
    ?>
	<header>
		<div id="logo">
		    <a href=page_accueil2.html><img src="./media/logo.png" alt="Logo site"></a>
			
		</div>
		<div id="texte">Je donne de la valeur à mon engagement</div>
		
		<div id="bouton">
			<a href="voir_profil.php">Jeune</a>
		</div>
	</header>
	<main>
        <a href="selection_envoi_ref.php"></a>
        <div id="content">
        <fieldset>
			<legend>Renseigner les informations du consultant </legend>
       
  
            <form action="envoi_ref_consultant.php" method="post">
                <div class="form">
                    <label for="nom_consultant">Nom</label>
                    <input id="nom_consultant" name="nom_consultant" type="text"  required>
                </div>

                <div class="form">
                    <label for="prenom_consultant">Prénom</label>
                    <input id="prenom_consultant" name="prenom_consultant" type="text" required>
                </div>
               
                <div class="form">
                    <label for="email_consultant">Email</label>
                    <input id="email_consultant" name="email_consultant" type="email" required>
                </div>

                <div id="submit" class="form"> 
                    <input type="submit"  name= 'envoyer_mail_consultant'value="Envoyer">
                </div>
            
            </form>
        </div>
	</main>
</body>

</html>
