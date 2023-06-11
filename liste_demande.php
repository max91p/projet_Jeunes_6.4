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
            var id=table.getAttribute("id");//Récupération de l'id de la référence cliquée
            var td_statut=document.querySelector("#"+id+" > tbody > tr > td:nth-child(2)>span");//Récupération du span contenant le statut de la référence
            var statut=td_statut.innerHTML; //Récupération du texte du span contenant le statut
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
			";//Affichage du html
		$liste_demande_total=array(); //Va contenir la liste entière des références du jeune
		if (file_exists("references.txt")){
			$fichier=fopen("references.txt","r");
			$email_jeune=$_SESSION["email"];
			while (!feof($fichier)){
				$ligne_entiere="";//va stocker la référence entière
				$fin=false;
				$nb_saut=0;//nombre de ligne contenant seulement un saut de ligne, quand >=2, on passe à la ref suivante
				while ($fin==false && !feof($fichier)){
					$ligne=fgets($fichier);
					if ($ligne=="\n" || $ligne=="\r\n"){//la ligne contient qu'un saut de ligne
						if ($nb_saut==1){ //Si la ligne précédente ne contenait qu'un saut de ligne
							$fin=true; //La référence est entière
						}else{
							$nb_saut=$nb_saut+1;
						}
					}elseif ($nb_saut==1){//La ligne précédente contenait qu'un saut de ligne mais pas celle là
						$nb_saut=0;//La référence n'est pas finie
						$ligne_entiere .= "\n$ligne";//ajout du contenu de la ligne à la référence
					}else{
						$ligne_entiere .= "$ligne";//ajout du contenu de la ligne à la référence
					}
				}
				if (strlen($ligne_entiere)>2){ //Si ligne_entiere n'est pas vide ou pas presque vide
					$ligne_decoupee=explode('|',$ligne_entiere); //transforme une chaine de caractères avec les données séparées par '|' en liste
					$id_ligne=$ligne_decoupee[0];
					$email_ligne=$ligne_decoupee[1];
					$couleur="grey"; //Couleur du statut
					if ($email_ligne==$email_jeune){
						if ($ligne_decoupee[11]=="Répondu"){
							$couleur="green";
						}
						array_push($liste_demande_total,$ligne_decoupee);
						echo 
						"<table id='$id_ligne' class='reference' onclick='clic_ref(this)'>
							<tr>
								<td>Milieu : $ligne_decoupee[2]<br>Référent(e) : <span class='nom_referent_liste_ref'>$ligne_decoupee[8] $ligne_decoupee[7]</span><br>Date d'envoi : <span class='date_experience_ref_liste'>$ligne_decoupee[10]</span></td>
								<td style='vertical-align:top;width:190px;text-align:right;'>Statut : <span style='color:$couleur;'>$ligne_decoupee[11]</span></td>
							</tr>
						</table>
						<br>"; //Affichage de la référence en HTML
					}
				}
			}
			if (count($liste_demande_total)==0){ //Aucune référence pour le jeune connecté
				echo "<div ALIGN=center>Vous n'avez aucune demande de référence</div><br></main>";
			}
			fclose($fichier);
		}else{//Le fichier existe pas, donc il n'y a aucune référence existante
			echo "<div ALIGN=center>Vous n'avez aucune demande de référence</div><br></main>";
		}
		$_SESSION['liste_demande']=$liste_demande_total;
	?>
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