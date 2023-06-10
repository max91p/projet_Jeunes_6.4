<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" href="./style/creer_demande.css">
    <title>Créer une demande de référence</title>
</head>
<body>
<?php
		if (isset($_GET['reference_id'])){
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
                    <div align=left style='vertical-align: middle;'>
                        <a href=page_accueil2.html><img style='max-height: 100px;' src='../media/logo.png' alt='Logo site'></a>
                    </div>
                    <div align=right style='vertical-align: middle;position:absolute;right:40px;top:25px;height:50px;line-height: 50px;'>
                        <a href='voir_profil.php' style='vertical-align: middle;font-size: 30px;'>Jeune</a>
                    </div>
                </header>
                <br>
                <br>
                <main>
                    <a href='../liste_demande.php'><--</a>
                    <table style='width:100%;table-layout: fixed;' cellspacing=4>
                        <colgroup>
                            <col span='1' style='width: 50%;'>
                            <col span='1' style='width: 25%;'>
                            <col span='1' style='width: 25%;'>
                        </colgroup>
                        <tr>
                            <td style='border:2px solid black;margin:0;padding:5px 15px 5px 10px;'><div>
                                Mon engagement :<br>
                                <br>Milieu de l'engagement :<br> <?php echo $ligne_decoupee[2]?>
                                <br><br>Durée de l'engagement :<br><?php echo $ligne_decoupee[3]?>
                                <br><br>Description de l'engagement : <div style='height:100px;overflow-y:scroll'><?php echo $texte_description ?></div>
                            </div></td>
                            <td style='border:2px solid black;margin:0;padding:5px 15px 5px 10px;vertical-align:top;'><div style='height:100%;'>
                                Mes savoir-faire :<br><br>
                                <div id='savoir_faire' style='height:233px;overflow-y:scroll'> <?php echo $texte_savoir_faire ?></div>
                            </div></td>
                            <td style='border:2px solid black;margin:0;padding:5px 15px 5px 10px;vertical-align:top;'><div style='height:100%;'>
                                Mes savoir-être :<br><br>
                                <div id='savoir_etre' style='height:233px;overflow-y:scroll'> <?php echo $texte_savoir_etre ?></div>
                            </div></td>
                        </tr>
                        <tr>
                            <td style='border:2px solid black;margin:0;padding:5px 15px 10px 10px;vertical-align:top;'><div style='height:100%;'>
                                Référent :
                                <br><br>Nom : <br> <?php echo $ligne_decoupee[7] ?>
                                <br><br>Prénom : <br> <?php echo $ligne_decoupee[8] ?>
                                <br><br>Email : <br> <?php echo $ligne_decoupee[9] ?>
                            </div></td>
                            <td style='border:2px solid black;margin:0;padding:5px 15px 5px 10px;vertical-align:top;'><div style='height:100%;'>
                                Savoir-faire validés :<br> <?php echo $texte_savoir_faire_observes ?><br>
                                <div id='savoir_faire_valides' style='height:150px;overflow-y:scroll'></div>
                            </div></td>
                            <td style='border:2px solid black;margin:0;padding:5px 15px 5px 10px;vertical-align:top;'><div style='height:100%;'>
                                Savoir-être validés :<br> <?php echo $texte_savoir_etre_observes ?><br>
                                <div id='savoir_etre_valides' style='height:150px;overflow-y:scroll'></div>
                            </div></td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
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
