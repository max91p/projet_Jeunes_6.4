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
		if (isset($_GET['reference_id'])){
			$id=$_GET['reference_id'];
			$fichier=fopen("references.txt","r");
			$trouve=false;
			while ($trouve==false && !feof($fichier)){
				$ligne_entiere="";
				$fin=false;
				$nb_saut=0;
				while ($fin==false){
					$ligne=fgets($fichier);
					if ($ligne=="\n"){
						if ($nb_saut==1){
							$fin=true;
						}else{
							$nb_saut=$nb_saut+1;
						}
					}elseif ($nb_saut==1){
						$nb_saut=0;
						$ligne_entiere .= "/n$ligne";
					}else{
						$ligne_entiere .= "$ligne";
					}
				}
				$ligne_decoupee=explode('|',$ligne_entiere);
				$id_ligne=$ligne_decoupee[0];
				if ($id_ligne==$id){
					$trouve=true;
				}
			}
			fclose($fichier);
			if ($trouve==false){
				echo "Erreur sur l'ID";
			}else{
				//"$id|$nom_jeune|$prenom_jeune|$email_jeune|$milieu|$duree|$description|$savoir_faire|$savoir_etre|$nom_referent|$prenom_referent|$email_referent\n\n\n";
				$texte_description=str_replace("\n","<br>",$ligne_decoupee[6]);
				echo 
				"<header>
					<div align=left style='vertical-align: middle;'>
						<a href=page_accueil2.html><img style='max-height: 100px;' src='../logo.png' alt='Logo site'></a>
					</div>
					<div align=right style='vertical-align: middle;position:absolute;right:40px;top:25px;height:50px;line-height: 50px;'>
						<a href='voir_profil.php' style='vertical-align: middle;font-size: 30px;'>Jeune</a>
					</div>
				</header>
				<main>
					<h5>Vérifiez l’expérience du candidat et les infomations donnés.</h5>
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
									Nom :<br> $ligne_decoupee[1] <br><br>
									Prénom : <br> $ligne_decoupee[2] <br><br>
									Email : <br> $ligne_decoupee[3] <br>
								</div></td>
							</tr>
							<tr>
								<td style='border:2px solid black;margin:0;padding:5px 15px 10px 10px;vertical-align:top;'><div style='height:100%;'>
									<u>Référent :</u>
									<br><br>Nom : <input style='width:100%;' name='nom_referent' type='text' value='$ligne_decoupee[9]'>
									<br><br>Prénom : <input style='width:100%;' name='prenom_referent' type='text' value='$ligne_decoupee[10]'>
									<br><br>Email :<input style='width:100%;' name='email_referent' type='text' value='$ligne_decoupee[11]'>
								</div></td>
							</tr>
							<tr>
								<td style='border:2px solid black;margin:0;padding:5px 15px 5px 10px;'><div>
									<u>Mon engagement :</u><br>
									<br>Milieu de l'engagement : <br>$ligne_decoupee[4]
									<br><br>Durée de l'engagement :<br>$ligne_decoupee[5]
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
		}
		if(isset($_POST["submit"])) {
			//compléter info sur la référence dans le fichier -> demander à Emma le moyen qu'elle a trouvé pour ne pas avoir à réecrire tout le fichier
			//changer le statut de la référence pour le jeune
			//Bonus : envoyer un mail au jeune pour lui informer que sa référence a été validé
		}
	?>
	
</body>

</html>