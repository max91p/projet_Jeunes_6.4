<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" href="../style/voir_demande_attente.css">
    <title>Voir mes références</title>
</head>
<body>
    <?php
		if (isset($_GET['reference_id'])){//Si l'url contient le champ reference_id=
			$id=$_GET['reference_id'];//Récupération de l'id de la référence
			$fichier=fopen("references.txt","r");
			$trouve=false;
            //On cherche les détails de la référence dont l'id est $id
			while ($trouve==false && !feof($fichier)){
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
					if ($id_ligne==$id){
						$trouve=true; //On a trouvé la référence, on s'arrête de parcourir le fichier
					}
				}
			}
			if ($trouve==false){//Id introuvé
				echo "Erreur sur l'ID";
			}else{
                //On remplace \n par des <br> pour que ça affiche des sauts de ligne
				$texte_description=str_replace("\r\n","<br>",$ligne_decoupee[4]);
                $texte_savoir_faire=str_replace("\n","<br>",$ligne_decoupee[5]);
                $texte_savoir_etre=str_replace("\n","<br>",$ligne_decoupee[6]);
                echo "
                <header>
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
                        </tr>
                    </table>
                    <br>
                    <p>Envoyé le $ligne_decoupee[10]<br>Statut : <span id='statut'>$ligne_decoupee[11]</span></p>
                    <br>
                </main>";//Affichage du html
			}
			fclose($fichier);
		}
	?>
</body>

</html>