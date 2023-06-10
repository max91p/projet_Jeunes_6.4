<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="../style/consulter_liste_demande_consultant.css">
  
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
        if (isset($_GET['references_id'])){
            $liste_id_references=explode(',',$_GET['references_id']);
            if (file_exists("references.txt")){
				$liste_references=array();
				$fichier=fopen("references.txt","r");
				$toutes_trouve=false;
				while ($toutes_trouve==false && !feof($fichier)){
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
						if (in_array($id_ligne,$liste_id_references)){
							array_push($liste_references,$ligne_decoupee);
							if (count($liste_references)==count($liste_id_references)){
								$toutes_trouve=true;
							}
						}
					}
				}
				if ($toutes_trouve==false){
					echo "Une de ces références n'existe pas";
				}else{
					$email_jeune=$liste_references[0][1];
					$infos_jeune=recup_infos_jeune($email_jeune);
					echo "<main>
						<div class='titre'>Consultez les informations et les références du candidat</div>
					<table >
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
								</div></td>  </div></fieldset>
							<td rowspan='2'>
								<div id='content'>
									<fieldset>
								<u>Références du candidat :</u><br><br>";
					for ($i=0;$i<count($liste_references);$i++){
						$nom_ref=$liste_references[$i][7];
						$prenom_ref=$liste_references[$i][8];
						$date=$liste_references[$i][10];
						$milieu=$liste_references[$i][2];
						echo 	"<fieldset>
									<div class='bleu'>Milieu : </div>$milieu<br><br>
									<div class='bleu'>Référent(e) : </div>$prenom_ref $nom_ref<br><br>
									<div class='bleu'>Date d'envoi : </div>$date
								</div> </fieldset>
							<br> ";
					}
					echo 	"</div></td>
						</tr>
				</main>";
                }
            }
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
