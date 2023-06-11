<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" href="../style/voir_demande_repondu.css">
    <title>Voir mes références</title>
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
					if ($id_ligne==$id){
						$trouve=true;
					}
				}
			}
			if ($trouve==false){
				echo "Erreur sur l'ID";
			}else{
                // 0         1         2       3         4            5            6             7               8               9          10    11             12                    13                14  
		        //"$id|$email_jeune|$milieu|$duree|$description|$savoir_faire|$savoir_etre|$nom_referent|$prenom_referent|$email_referent|$date|$statut|$savoir_faire_valides|$savoir_etre_valides|$commentaires\n\n\n";
                $texte_description=str_replace("\r\n","<br>",$ligne_decoupee[4]);
                $texte_savoir_faire=str_replace("\n","<br>",$ligne_decoupee[5]);
                $texte_savoir_etre=str_replace("\n","<br>",$ligne_decoupee[6]);
                $texte_savoir_faire_observes=str_replace("\n","<br>",$ligne_decoupee[12]);
                $texte_savoir_etre_observes=str_replace("\n","<br>",$ligne_decoupee[13]);
                $texte_commentaires=str_replace("\r\n","<br>",$ligne_decoupee[14]);
                echo 
                "<header>
                    <div id='logo'>
                        <a href=page_accueil2.html><img src='../media/logo.png' alt='Logo site'></a>
                    </div>
                    <div id='bouton'>
                        <a href='voir_profil.php'>Jeune</a>
                    </div>
                </header>
                <main>
                    <a href='../liste_demande.php'><img id='arrow'src='../media/arrow.png' alt='arrow'></a>
                    <table style='width:100%;table-layout: fixed;' cellspacing=4>
                        <colgroup>
                            <col span='1' style='width: 50%;'>
                            <col span='1' style='width: 25%;'>
                            <col span='1' style='width: 25%;'>
                        </colgroup>
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
                                    <div class='subtitle_jeune'>Mes savoir-faire :</div>
                                    <div id='savoir_faire'>$texte_savoir_faire</div>
                                </div>
                            </td>
                            <td class='jeune'>
                                <div>
                                    <div class='subtitle_jeune'>Mes savoir-être :</div>
                                    <div id='savoir_etre'>$texte_savoir_etre</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class='referent'>
                                <div>
                                    <div class='subtitle_referent'>Référent :</div>
                                    <div class='vert'>Nom :</div>
                                    <div class='texte'>$ligne_decoupee[7]</div>
                                    <div class='vert'>Prénom :</div>
                                    <div class='texte'>$ligne_decoupee[8]</div>
                                    <div class='vert'>Email :</div>
                                    <div class='texte'>$ligne_decoupee[9]</div>
                                </div>
                            </td>
                            <td class='referent'>
                                <div>
                                    <div class='subtitle_referent'>Savoir-faire validés :</div>
                                    <div id='savoir_faire_valides'>$texte_savoir_faire_observes</div>
                                </div>
                            </td>
                            <td class='referent'>
                                <div>
                                    <div class='subtitle_referent'>Savoir-être validés :</div>
                                    <div id='savoir_etre_valides'>$texte_savoir_etre_observes</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
							<td  colspan='3' class='referent'>
                                <div class='subtitle_referent'>Commentaires :</div>
								<div id='commentaires'>$texte_commentaires</div>
							</td>
						</tr>
                    </table>
                    <p>Envoyé le <span id='date_envoi'>$ligne_decoupee[10]</span><br>Statut : <span id='statut'>$ligne_decoupee[11]</span></p>
                    <br>
                </main>";
			}
			fclose($fichier);
		}
	?>
	
</body>

</html>