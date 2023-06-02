<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="./style/liste_demande.css">
	<title>Liste des demandes de références</title>
    <script>
        function clic_ref(table){
            var id=table.getAttribute("id");
            var td_statut=document.querySelector("#"+id+" > tbody > tr > td:nth-child(2)>span");
            var statut=td_statut.innerHTML;
			console.log(statut);
            if (statut=="Répondu"){
                location.href='voir_demande_repondu.php/?reference_id='+id;
            }else{
                location.href='voir_demande_attente.php/?reference_id='+id;
            }
        }
    </script>
</head>
<body>
	<?php
		echo 
		"<header>
			<div id='logo'>
				<a href='page_accueil2.html'><img src='./media/logo.png' alt='Logo site'></a>
			</div>
			<div id='texte'>Je donne de la valeur à mon engagement</div>
			<div id='bouton'>
				<a href='voir_profil.php'>Jeune</a>
			</div>
		</header>
		<main>
			<div id='content'>
				<div id='title'>Vos références</div>
			
				<div id='right'>
					<div class='lien'>
						<a href='selection_envoi_ref.php'>Envoyer des références</a>
					</div>
					<div class='lien'>
						<a href='selection_exporter_ref.php'>Exporter des références</a>
					</div>
				</div>
			</div>

			<a href='accueil_compte.html'><img id='home' src='./media/home.png' alt='home'></a>
			";
		$liste_demande_total=array();
		if (file_exists("references.txt")){
			$fichier=fopen("references.txt","r");
			$nom_jeune=$_SESSION["nom_jeune"];
			$prenom_jeune=$_SESSION["prenom_jeune"];
			$email_jeune=$_SESSION["email_jeune"];
			while (!feof($fichier)){
				$ligne_entiere="";
				$fin=false;
				$nb_saut=0;
				while ($fin==false && !feof($fichier)){
					$ligne=fgets($fichier);
					if ($ligne=="\n" || $ligne=="\r\n"){
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
					$nom_ligne=$ligne_decoupee[1];
					$prenom_ligne=$ligne_decoupee[2];
					$email_ligne=$ligne_decoupee[3];
					if ($nom_ligne==$nom_jeune && $prenom_ligne==$prenom_jeune && $email_ligne==$email_jeune){
						array_push($liste_demande_total,$ligne_decoupee);
						echo 
						"<table id='$id_ligne' onclick='clic_ref(this)' style='border:2px solid black; align:center;margin-right:30%;margin-left:30%;width:40%;padding:5px;'>
							<tr style='font-size:20px;'>
								<td>Milieu : <span class='milieu_experience_liste'>$ligne_decoupee[4]</span><br>Référent(e) : <span class='nom_referent_liste_ref'>$ligne_decoupee[10] $ligne_decoupee[9]</span><br>Date d'envoi : <span class='date_experience_ref_liste'>$ligne_decoupee[12]</span></td>
								<td style='vertical-align:top;text-align:right;'>Statut : <span class='statut_ref'>$ligne_decoupee[13]</span></td>
							</tr>
						</table>
						<br>";
					}
				}
			}
			if (count($liste_demande_total)==0){
				echo "<div ALIGN=center>Vous n'avez aucune demande de référence</div><br></main>";
			}
			fclose($fichier);
		}else{
			echo "<div ALIGN=center>Vous n'avez aucune demande de référence</div><br></main>";
		}
		$_SESSION['liste_demande']=$liste_demande_total;
	?>
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