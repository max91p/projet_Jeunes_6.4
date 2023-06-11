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
	<script>
		console.log("ici");
	</script>
</head>
<body style="margin: 0;">
    <?php
		use PHPMailer\PHPMailer\PHPMailer; 
        use PHPMailer\PHPMailer\SMTP; 
        use PHPMailer\PHPMailer\Exception;
        require 'PHPMailer/src/Exception.php'; 
        require 'PHPMailer/src/PHPMailer.php'; 
        require 'PHPMailer/src/SMTP.php';
		$deja_envoye=false;
		if (isset($_GET['reference_id'])){
			$id=$_GET['reference_id'];
			if (file_exists("references.txt")){
				$fichier=fopen("references.txt","r");
				$trouve=false;
				$contenu_avant=array();
				$contenu_apres=array();
				while ($trouve==false && !feof($fichier)){
					$ligne_entiere="";
					$fin=false;
					$nb_saut=0;
					while ($fin==false && !feof($fichier)){
						$ligne=fgets($fichier);
						if ($ligne=="\n"){
							if ($nb_saut==1){
								$fin=true;
							}else{
								$nb_saut=$nb_saut+1;
							}
						}elseif ($nb_saut==1){
							$nb_saut=0;
							$ligne_entiere .= "\n$ligne";
						}else{
							$ligne_entiere .= "$ligne";
						}
					}
					if (strlen($ligne_entiere)>2){
						$ligne_decoupee=explode('|',$ligne_entiere);
						$id_ligne=$ligne_decoupee[0];
						if ($id_ligne==$id){
							$trouve=true;
						}else{
							array_push($contenu_avant,$ligne_entiere);
						}
					}
				}
				if ($trouve==false){
					echo "Cette référence n'existe pas";
				}elseif ($ligne_decoupee[11]=="Répondu"){
					header("Location: ../page_accueil2.html", true); //peut-être renvoyé vers une page qui indique "Référence déjà répondue"
					exit();
				}else{
					$id_jeune=recup_infos_jeune($ligne_decoupee[1]);
					$_SESSION['nom_jeune']=$id_jeune[1];
					$_SESSION['prenom_jeune']=$id_jeune[0];
					$_SESSION['milieu']=$ligne_decoupee[2];
					$texte_description=str_replace("\n","<br>",$ligne_decoupee[4]);
					echo 
					"<header>
						<div align=left style='vertical-align: middle;'>
							<a href=page_accueil2.html><img style='max-height: 100px;' src='../media/logo.png' alt='Logo site'></a>
						</div>
						<div align=right style='vertical-align: middle;position:absolute;right:40px;top:25px;height:50px;line-height: 50px;'>
							<a style='vertical-align: middle;font-size: 30px;'>Référent</a>
						</div>
					</header>
					<main>
						<h5>Vérifiez l’expérience du candidat et les informations donnés.</h5>
						<form method='post'>
							<table style='width:100%;table-layout: fixed;' cellspacing=4>
								<colgroup>
									<col span='1' style='width: 50%;'>
									<col span='1' style='width: 25%;'>
									<col span='1' style='width: 25%;'>
								</colgroup>
								<tr>
									<td style='border:2px solid black;margin:0;padding:5px 15px 10px 10px;vertical-align:top;'><div style='height:100%;'>
										<u>Candidat :</u><br><br>
										Nom :<br> $id_jeune[1] <br><br>
										Prénom : <br> $id_jeune[0] <br><br>
										Email : <br> $ligne_decoupee[1] <br>
									</div></td>
								</tr>
								<tr>
									<td style='border:2px solid black;margin:0;padding:5px 15px 10px 10px;vertical-align:top;'><div style='height:100%;'>
										<u>Référent :</u>
										<br><br>Nom : <input style='width:100%;' name='nom_referent' type='text' value='$ligne_decoupee[7]'>
										<br><br>Prénom : <input style='width:100%;' name='prenom_referent' type='text' value='$ligne_decoupee[8]'>
										<br><br>Email :<input style='width:100%;' name='email_referent' type='text' value='$ligne_decoupee[9]'>
									</div></td>
								</tr>
								<tr>
									<td style='border:2px solid black;margin:0;padding:5px 15px 5px 10px;'><div>
										<u>Mon engagement :</u><br>
										<br>Milieu de l'engagement : <br>$ligne_decoupee[2]
										<br><br>Durée de l'engagement :<br>$ligne_decoupee[3]
										<br><br>Description de l'engagement : <div style='height:100px;overflow-y:scroll'>$texte_description</div>
									</div></td>
									<td style='border:2px solid black;margin:0;padding:5px 15px 5px 10px;vertical-align:top;'><div style='height:100%;'>
										<u>Savoir-faire observés :</u><br><br>
										<textarea style='width:100%;height:233px;' name='savoir_faire_observes'></textarea>
									</div></td>
									<td style='border:2px solid black;margin:0;padding:5px 15px 5px 10px;vertical-align:top;'><div style='height:100%;'>
										<u>Savoir-être observés:</u><br><br>
										<textarea style='width:100%;height:233px;' name='savoir_etre_observes'></textarea>
									</div></td>
								</tr>
								<tr>
									<td  colspan='3' style='border:2px solid black;margin:0;padding:5px 15px 5px 10px;vertical-align:top;'>
										<u>Commentaires</u><br><br>
										<textarea style='width:100%;height:100px;' name='commentaires'></textarea>
									</td>
								</tr>
							</table>
							<br>
							<div style='text-align:center;'>
								<input style='font-size:20px;' type='submit' name='submit' value='Valider'>
							</div>
							<br>
							<br>
							<br>
							<br>
						</form>
					</main>";
				}
				while (!feof($fichier)){
					$ligne_entiere="";
					$fin=false;
					$nb_saut=0;
					while ($fin==false && !feof($fichier)){
						$ligne=fgets($fichier);
						if ($ligne=="\n"){
							if ($nb_saut==1){
								$fin=true;
							}else{
								$nb_saut=$nb_saut+1;
							}
						}elseif ($nb_saut==1){
							$nb_saut=0;
							$ligne_entiere .= "\n$ligne";
						}else{
							$ligne_entiere .= "$ligne";
						}
					}
					if (strlen($ligne_entiere)>2){
						array_push($contenu_apres,$ligne_entiere);
					}
				}
				fclose($fichier);
			}else{
				echo 
					"<header>
						<div align=left style='vertical-align: middle;'>
							<a href=page_accueil2.html><img style='max-height: 100px;' src='../media/logo.png' alt='Logo site'></a>
						</div>
						<div align=right style='vertical-align: middle;position:absolute;right:40px;top:25px;height:50px;line-height: 50px;'>
							<a style='vertical-align: middle;font-size: 30px;'>Référent</a>
						</div>
					</header>
					<main>
						<br><br><br><br><br><br><div ALIGN=center>Il n'existe aucune référence</div><br>
					</main>";
			}
		}
		if(isset($_POST["submit"])) {
			$ligne_decoupee[7]=$_POST['nom_referent'];
			$ligne_decoupee[8]=$_POST['prenom_referent'];
			$ligne_decoupee[9]=$_POST['email_referent'];
			$savoir_faire_observes=$_POST['savoir_faire_observes'];
			$savoir_etre_observes=$_POST['savoir_etre_observes'];
			$commentaires=$_POST['commentaires'];
			$fichier=fopen("references.txt","w");
			for ($x = 0; $x< count($contenu_avant);$x++){
				fwrite($fichier,$contenu_avant[$x]);
				fwrite($fichier,"\n\n");
			}
			for ($x=0;$x<count($ligne_decoupee)-1;$x++){
				fwrite($fichier,"$ligne_decoupee[$x]|");
			}
			fwrite($fichier,"Répondu|$savoir_faire_observes|$savoir_etre_observes|$commentaires\n\n\n");
			for ($x = 0; $x< count($contenu_apres);$x++){
				fwrite($fichier,$contenu_apres[$x]);
				fwrite($fichier,"\n\n\n");
			}
			fclose($fichier);
			envoyer_demande_mail($ligne_decoupee,$id_jeune[0],$id_jeune[1]);
			header("Location: ../page_remerciement_referent.php", true);
			exit();
		}
		function envoyer_demande_mail($liste_infos,$prenom_jeune,$nom_jeune){
			// 0         1         2       3         4            5            6             7               8               9          10    11
			//"$id|$email_jeune|$milieu|$duree|$description|$savoir_faire|$savoir_etre|$nom_referent|$prenom_referent|$email_referent|$date|$statut\n\n\n";
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
            $mail->addAddress($liste_infos[1]);
            $mail->isHTML(true);
            $mail->Subject = "Jeunes 6.4 : Référence répondue : $liste_infos[2]"; 
            $bodyContent = "Bonjour $prenom_jeune $nom_jeune,<br><br>
			$liste_infos[8] $liste_infos[7] a confirmé votre référence dans le milieu \"$liste_infos[2]\".<br>
			Vous pouvez consulter les changements sur votre compte sur le site de Jeunes 6.4.<br><br>
            Cordialement,<br><br>L'équipe de Jeunes 6.4"; 
            $mail->Body= $bodyContent;
            $res=$mail->send();
        }
		function recup_infos_jeune($email){
			$fichier_compte=fopen("people.csv","r");
			$infos_jeune=array();
			$trouve=false;
			while(feof($fichier_compte) == false and !$trouve) {
				$csv = fgets($fichier_compte);
				$user = str_getcsv($csv, ';');
			
				if ($email == $user[3]) {
					$infos_jeune=array($user[0],$user[1]);
					$trouve=true;
				}
			}
			fclose($fichier_compte);
			return $infos_jeune;
		}
	?>
	
</body>

</html>