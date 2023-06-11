<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" href="../style/consulter_reference_consultant.css">
    <title>Créer une demande de référence</title>
</head>
<body>
<?php
		if (isset($_GET['reference_id'])){
            $liste_id=$_SESSION['liste_id'];
			$id=$_GET['reference_id'];
			$fichier=fopen("references.txt","r");
			$trouve=false;
			while ($trouve==false && !feof($fichier)){
				$ligne_entiere="";
				$fin=false;
				$nb_saut=0;
				while ($fin==false && !feof($fichier)){
					$ligne=fgets($fichier);
                    //gestion des lignes vides
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
					if ($id_ligne==$id){
						$trouve=true;
					}
				}
			}
			if ($trouve==false){
				echo "Erreur sur l'ID";
			}else{
                // 0         1         2       3         4            5            6             7               8               9          10    11
			    //"$id|$email_jeune|$milieu|$duree|$description|$savoir_faire|$savoir_etre|$nom_referent|$prenom_referent|$email_referent|$date|$statut\n\n\n";
				$texte_description=str_replace("\r\n","<br>",$ligne_decoupee[4]);
                $texte_savoir_faire=str_replace("\n","<br>",$ligne_decoupee[5]);
                $texte_savoir_etre=str_replace("\n","<br>",$ligne_decoupee[6]);
                $texte_savoir_faire_observes=str_replace("\n","<br>",$ligne_decoupee[12]);
                $texte_savoir_etre_observes=str_replace("\n","<br>",$ligne_decoupee[13]);
                $texte_commentaires=str_replace("\r\n","<br>",$ligne_decoupee[14]);

            }
        }
            ?>

    <header>
        <div id="logo">
            <a href=page_accueil2.html><img src="../media/logo.png" alt="Logo site"></a>
        </div>
        <div id="texte">Je donne de la valeur à ton engagement</div>
        <div id="bouton">
            Consultant
        </div>
    </header>
                <main>
                    <a href='../consulter_liste_demande_consultant.php/?references_id=<?php echo $liste_id;?>'><img id="arrow"src="../media/arrow2.png" alt="arrow"></a>
                    <table style='width:100%;table-layout: fixed;' cellspacing=4>
                        <colgroup>
                            <col span='1' style='width: 50%;'>
                            <col span='1' style='width: 25%;'>
                            <col span='1' style='width: 25%;'>
                        </colgroup>
                        <tr>
                            <td class="jeune">
                                <div>
                                    <div class="subtitle_jeune">Mon engagement :</div>
                                    <div class="rose">Milieu de l'engagement :</div>
                                    <div class="texte"><?php echo $ligne_decoupee[2]?></div>
                                    <div class="rose">Durée de l'engagement :</div>
                                    <div class="texte"><?php echo $ligne_decoupee[3]?></div>
                                    <div class="rose">Description de l'engagement :</div>              
                                    <div id="description"><?php echo $texte_description ?></div>
                                </div>
                            </td>
                            <td class="jeune">
                                <div>
                                    <div class="subtitle_jeune">Mes savoir-faire :</div>
                                    <div id='savoir_faire'> <?php echo $texte_savoir_faire ?></div>
                                </div>
                            </td>
                            <td class="jeune">
                                <div>
                                    <div class="subtitle_jeune">Mes savoir-être :</div>
                                    <div id='savoir_etre'> <?php echo $texte_savoir_etre ?></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="referent">
                                <div>
                                    <div class="subtitle_referent">Référent :</div>
                                    <div class="vert">Nom :</div>
                                    <div class="texte"><?php echo $ligne_decoupee[7] ?></div>
                                    <div class="vert">Prénom :</div>
                                    <div class="texte"><?php echo $ligne_decoupee[8] ?></div>
                                    <div class="vert">Email :</div>
                                    <div class="texte"><?php echo $ligne_decoupee[9] ?></div>
                                </div>
                            </td>
                            <td class="referent">
                                <div>
                                    <div class="subtitle_referent">Savoir-faire validés :</div> 
                                    <div id='savoir_faire_valides'><?php echo $texte_savoir_faire_observes ?></div>
                                </div>
                            </td>
                            <td class="referent">
                                <div>
                                    <div class="subtitle_referent">Savoir-être validés :</div> 
                                    <div id='savoir_etre_valides'><?php echo $texte_savoir_etre_observes ?></div>
                                </div>
                            </td>
                        </tr>
                    </table>
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
