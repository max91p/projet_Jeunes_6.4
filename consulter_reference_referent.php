<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="../style/consulter_reference_referent.css">
	<title>Consulter une référence</title>
	<script>
		console.log("ici");
	</script>
</head>
<body>
    <?php
		//importation de la bibliothèque PHPMailer
		use PHPMailer\PHPMailer\PHPMailer; 
        use PHPMailer\PHPMailer\SMTP; 
        use PHPMailer\PHPMailer\Exception;
        require 'PHPMailer/src/Exception.php'; 
        require 'PHPMailer/src/PHPMailer.php'; 
        require 'PHPMailer/src/SMTP.php';
		if (isset($_GET['reference_id'])){//Si l'url contient le champ reference_id=
			$id=$_GET['reference_id'];//On récupère l'id présent dans l'url
			if (file_exists("references.txt")){
				$fichier=fopen("references.txt","r");
				$trouve=false;
				$contenu_avant=array(); //stocke le contenu avant la référence voulue
				$contenu_apres=array(); //stocke le contenu après la référence voulue
				while ($trouve==false && !feof($fichier)){
					$ligne_entiere="";//va stocker la référence entière
					$fin=false;
					$nb_saut=0;//nombre de ligne contenant seulement un saut de ligne, quand >=2, on passe à la ref suivante
					while ($fin==false && !feof($fichier)){
						$ligne=fgets($fichier);
						if ($ligne=="\n"){ //la ligne contient qu'un saut de ligne
							if ($nb_saut==1){ //Si la ligne précédente ne contenait qu'un saut de ligne
								$fin=true; //La référence est entière
							}else{
								$nb_saut=$nb_saut+1;
							}
						}elseif ($nb_saut==1){ //La ligne précédente contenait qu'un saut de ligne mais pas celle là
							$nb_saut=0;//La référence n'est pas finie
							$ligne_entiere .= "\n$ligne";//ajout du contenu de la ligne à la référence
						}else{
							$ligne_entiere .= "$ligne";//ajout du contenu de la ligne à la référence
						}
					}
					if (strlen($ligne_entiere)>2){ //Si ligne_entiere n'est pas vide ou pas presque vide
						$ligne_decoupee=explode('|',$ligne_entiere); //transforme une chaine de caractères avec les données séparées par '|' en liste
						$id_ligne=$ligne_decoupee[0];
						if ($id_ligne==$id){//Si l'id de la ligne est l'id recherché
							$trouve=true;//On a trouvé la référence qu'on voulait
						}else{
							array_push($contenu_avant,$ligne_entiere);//si ce n'est pas la bonne référence, on rajoute cette référence à la liste contenu_avant
						}
					}
				}
				if ($trouve==false){
					echo 
					"<header>
						<div id='logo'>
							<a href=page_accueil2.html><img src='../media/logo.png' alt='Logo site'></a>
						</div>
						<div id='bouton'>
							Referent
						</div>
					</header>
					<main>
						<br><br><br><br><br><br><div ALIGN=center>Cette référence n'existe pas</div><br>
					</main>";
				}elseif ($ligne_decoupee[11]=="Répondu"){
					header("Location: ../page_accueil2.html", true); //renvoie le référent sur la page d'accueil si il a déjà complété la référence
					exit();
				}else{
					$id_jeune=recup_infos_jeune($ligne_decoupee[1]); //liste avec le format [prenom_jeune,nom_jeune]
					$_SESSION['nom_jeune']=$id_jeune[1];
					$_SESSION['prenom_jeune']=$id_jeune[0];
					$_SESSION['milieu']=$ligne_decoupee[2];
					$texte_description=str_replace("\n","<br>",$ligne_decoupee[4]); //On remplace \n par des <br> pour que ça affiche des sauts de ligne
					echo 
					"<header>
						<div id='logo'>
							<a href=page_accueil2.html><img src='../media/logo.png' alt='Logo site'></a>
						</div>
						<div id='bouton'>
							Referent
						</div>
					</header>
					<main>
						<div id='title'>Vérifiez l’expérience du candidat et les informations donnés.</div>
						<form method='post'>
							<table style='width:100%;table-layout: fixed;' cellspacing=4>
								<colgroup>
									<col span='1' style='width: 50%;'>
									<col span='1' style='width: 25%;'>
									<col span='1' style='width: 25%;'>
								</colgroup>
								<tr>
									<td class='jeune'>
										<div>
											<div class='subtitle_jeune'>Candidat :</div>
											<div class='rose'>Nom :</div>
										 	<div class='texte'>$id_jeune[1]</div>
											<div class='rose'>Prénom :</div> 
											<div class='texte'>$id_jeune[0]</div>
											<div class='rose'>Email :</div>
											<div class='texte'>$ligne_decoupee[1]</div>
										</div>
									</td>
								</tr>
								<tr>
									<td class='referent'>
										<div>
											<div class='subtitle_referent'>Référent :</div>
											<div class='vert'>Nom :</div>
											<input name='nom_referent' type='text' value='$ligne_decoupee[7]'>
											<div class='vert'>Prénom :</div>
											<input name='prenom_referent' type='text' value='$ligne_decoupee[8]'>
											<div class='vert'>Email :</div>
											<input name='email_referent' type='text' value='$ligne_decoupee[9]'>
										</div>
									</td>
								</tr>
								<tr>
									<td class='jeune'>
										<div>
											<div class='subtitle_jeune'>Mon engagement :</div>
											<div class='rose'>Milieu de l'engagement :</div>
											<div class='texte'>$ligne_decoupee[2]</div>
											<div class='rose'>Durée de l'engagement :</div>
											<div class='texte'>$ligne_decoupee[3]</div>
											<div class='rose'>Description de l'engagement :</div>
											<div id='description'>$texte_description</div>
										</div>
									</td>
									<td class='jeune'>
										<div>
											<div class='subtitle_jeune'>Savoir-faire observés :</div>
											<textarea style='height:245px;' name='savoir_faire_observes' type='text'></textarea>
										</div>
									</td>
									<td class='jeune'>
										<div>
											<div class='subtitle_jeune'>Savoir-être observés:</div>
											<textarea style='height:245px;' name='savoir_etre_observes' type='text'></textarea>
										</div>
									</td>
								</tr>
								<tr>
									<td  colspan='3' class='referent'>
										<div class='subtitle_referent'>Commentaires</div>
										<textarea style='height:100px;' name='commentaires' type='text'></textarea>
									</td>
								</tr>
							</table>
							<br>
							<div id='submit'>
								<input type='submit' name='submit' value='Valider'>
							</div>
							<br>
						</form>
					</main>"; //Affichage du html
					//On récupère le reste du fichier
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
				}
				fclose($fichier);
			}else{//Si le fichier références.txt n'existe pas, il n'existe aucune référence
				echo 
					"<header>
						<div id='logo'>
							<a href=page_accueil2.html><img src='../media/logo.png' alt='Logo site'></a>
						</div>
						<div id='bouton'>
							Referent
						</div>
					</header>
					<main>
						<br><br><br><br><br><br><div ALIGN=center>Il n'existe aucune référence</div><br>
					</main>";
			}
		}
		if(isset($_POST["submit"])) { //Le référent valide la référence
			//On récupère les données du formulaire
			$ligne_decoupee[7]=$_POST['nom_referent'];
			$ligne_decoupee[8]=$_POST['prenom_referent'];
			$ligne_decoupee[9]=$_POST['email_referent'];
			$savoir_faire_observes=$_POST['savoir_faire_observes'];
			$savoir_etre_observes=$_POST['savoir_etre_observes'];
			$commentaires=$_POST['commentaires'];
			$fichier=fopen("references.txt","w");//On réouvre le fichier en écrasant le contenu
			for ($x = 0; $x< count($contenu_avant);$x++){//On réécrit le contenu présent avant la référence cherchée
				fwrite($fichier,$contenu_avant[$x]);
				fwrite($fichier,"\n\n");
			}
			for ($x=0;$x<count($ligne_decoupee)-1;$x++){//On écrit le contenu de la référence
				fwrite($fichier,"$ligne_decoupee[$x]|");
			}
			fwrite($fichier,"Répondu|$savoir_faire_observes|$savoir_etre_observes|$commentaires\n\n\n");//On rajoute les ajouts faits par le référent
			for ($x = 0; $x< count($contenu_apres);$x++){//On réécrit le contenu présent après la référence cherchée
				fwrite($fichier,$contenu_apres[$x]);
				fwrite($fichier,"\n\n");
			}
			fclose($fichier);
			envoyer_demande_mail($ligne_decoupee,$id_jeune[0],$id_jeune[1]);//Envoi le mail de confirmation au jeune
			header("Location: ../page_remerciement_referent.php", true);//Envoi sur la page de remerciement
			exit();
		}
		function envoyer_demande_mail($liste_infos,$prenom_jeune,$nom_jeune){
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
            $mail->addAddress($liste_infos[1]); //Adresse mail du destinataire
            $mail->isHTML(true); //Mail au format html
            $mail->Subject = "Jeunes 6.4 : Référence répondue : $liste_infos[2]"; //Objet du mail
            $bodyContent = "Bonjour $prenom_jeune $nom_jeune,<br><br>
			$liste_infos[8] $liste_infos[7] a confirmé votre référence dans le milieu \"$liste_infos[2]\".<br>
			Vous pouvez consulter les changements sur votre compte sur le site de Jeunes 6.4.<br><br>
            Cordialement,<br><br>L'équipe de Jeunes 6.4"; 
            $mail->Body= $bodyContent;//Contenu du mail
            $res=$mail->send();//Envoi du mail
        }
		function recup_infos_jeune($email){
			//récupère le nom et prénom du jeune dans le fichier people.csv grâce à l'adresse mail du jeune
			$fichier_compte=fopen("people.csv","r");
			$infos_jeune=array("Erreur","Erreur");//Si le jeune n'est pas trouvé, à la place de son nom et prénom sera affiché Erreur
			$trouve=false;
			while(feof($fichier_compte) == false and !$trouve) {//On parcoure tant que le fichier est pas fini et qu'on a pas trouvé l'adresse mail du jeune dans le fichier
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