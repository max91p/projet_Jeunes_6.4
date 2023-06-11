<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="../style/consulter_liste_demande_consultant.css">
  	<script>
        	function clic_ref(table){
            		var id=table.getAttribute("id");
            		location.href='../consulter_reference_consultant.php/?reference_id='+id; //renvoi sur la pag suivante pour voir les détails de la référence
        	}
	</script>
</head>
<body >
<header>
		<div id="logo">
			<a href=page_accueil2.html><img src="../media/logo.png" alt="Logo site"></a>
			
		</div>
			<div id="texte">Je donne de la valeur à ton engagement</div>
	
			<div id="bouton">
				<a>Consultant</a>
			</div>
		</header>
	<br><br>
    <?php
        if (isset($_GET['references_id'])){ //Si l'url contient le champ references_id=
            $liste_id_references=explode(',',$_GET['references_id']); //transforme la chaine de caractères en liste, pour former une liste d'id
			$_SESSION["liste_id"]=$_GET['references_id']; //Pour la page d'après
            if (file_exists("references.txt")){
				$liste_references=array(); //va contenir les références correspondant aux id mis dans l'url
				$fichier=fopen("references.txt","r");
				$toutes_trouve=false;
				while ($toutes_trouve==false && !feof($fichier)){
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
						if (in_array($id_ligne,$liste_id_references)){ //Si l'id de cette référence est dans celle présente dans l'url
							array_push($liste_references,$ligne_decoupee); //On rajoute cette référence à la liste liste_references
							if (count($liste_references)==count($liste_id_references)){ //Si on a trouvé toutes les références indiquées dans l'url
								$toutes_trouve=true;
							}
						}
					}
				}
				if ($toutes_trouve==false){//Si on a pas trouvé toutes les références
					echo "Une de ces références n'existe pas";
				}else{
					$email_jeune=$liste_references[0][1];
					$infos_jeune=recup_infos_jeune($email_jeune);//liste avec le format [prenom_jeune,nom_jeune]
					echo "<main>
						<div class='titre'>Consultez les informations et les références du candidat</div>
					<table>
						<colgroup>
							<col span='1' style='width: 50%;'>
							<col span='1' style='width: 50%;'>
						</colgroup>
						<tr>
							<td>
								<div id='content'>
								<fieldset>
									<u>Informations du candidat :</u><br><br><br>
									<div class='bleu'>Nom : </div> $infos_jeune[1] <br><br><br>
									<div class='bleu'>Prénom : </div> $infos_jeune[0] <br><br><br>
									<div class='bleu'>Email : </div> $email_jeune <br>
								</fieldset></div></td>
							<td rowspan='2'>
								<div id='content'>
									<fieldset>
								<u>Références du candidat :</u><br><br>"; //Affichage du html
					for ($i=0;$i<count($liste_references);$i++){ //Affichage de chacune des références de l'url
						$nom_ref=$liste_references[$i][7];
						$prenom_ref=$liste_references[$i][8];
						$date=$liste_references[$i][10];
						$milieu=$liste_references[$i][2];
						$id_ligne=$liste_references[$i][0];
						echo 	"<fieldset id='$id_ligne' onclick='clic_ref(this)'>
									<div class='bleu'>Milieu : </div>$milieu<br><br>
									<div class='bleu'>Référent(e) : </div>$prenom_ref $nom_ref<br><br>
									<div class='bleu'>Date d'envoi : </div>$date
								</fieldset>
							<br> ";
					}
					echo 	"</fieldset></div></td>
						</tr>
					</table>
				</main>"; //Fin du html
                }
            }
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
