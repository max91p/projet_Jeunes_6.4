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
        $ids_ref_a_envoyer="";
        $liste_demande=$_SESSION['liste_demande'];
        for ($i=0;$i<count($liste_demande);$i++){
            $id=$liste_demande[$i][0];
            if ($liste_demande[$i][13]=="Répondu" && isset($_POST["ref_$id"])){
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
        <div align=left style="vertical-align: middle;">
            <a href=page_accueil2.html><img style="max-height: 100px;" src="logo.png" alt="Logo site"></a>
        </div>
        <div align=right style="vertical-align: middle;position:absolute;right:40px;top:25px;height:50px;line-height: 50px;">
            <a href="voir_profil.php" style="vertical-align: middle;font-size: 30px;">Jeune</a>
        </div>
	</header>
	<main>
        <a href="selection_envoi_ref.php"><--</a>
        <h2 style="text-align:center;">Renseigner les informations du consultant</h2>
        <br>
        <div style="border:2px solid black;margin-right:35%;margin-left:35%;padding :5px;">
            <form action="envoi_ref_consultant.php" method="post">
                <p>Nom <br><input name="nom_consultant" type="text"></p>
                <p>Prénom <br><input name="prenom_consultant" type="text"></p>
                <p>Email <br><input name="email_consultant" type="email"></p>
                <input type="submit" name= 'envoyer_mail_consultant' value="Envoyer">
            </form>
        </div>
	</main>
</body>

</html>
